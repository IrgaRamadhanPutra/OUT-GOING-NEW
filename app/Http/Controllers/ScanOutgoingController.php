<?php

namespace App\Http\Controllers;

use App\Models\Ekanban\Ekanban_outgoing_tbl;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Http;

class ScanOutgoingController extends Controller
{
    //

    public function index_out_going()
    {
        return view('scan-out-going.index');
    }
    public function get_datatables_outtrans(Request $request)
    {
        $data = DB::connection('ekanban')->table('ekanban_outgoing_trans')
            ->select(
                'id',
                'ekanban_no',
                'item_code',
                'part_name',
                'part_no',
                'seq',
                'created_by',
                'creation_date',
                'qty',
                'sloc',
                'branch'
            )
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                return '
                <a href="#"
                    data-toggle="tooltip"
                    row-id="' . $data->id . '"
                    data-item_code="' . $data->item_code . '"
                    data-placement="top"
                    title="Delete"
                    class="dropdown-item delete"
                    style="display: flex; justify-content: center; align-items: center; height: 100%;">
                    <i class="fa-solid fa-trash" style="color: red; font-size: 1.5em;"></i>
                </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function validasi_po(Request $request)
    {
        $po_no = $request->poValue;

        // Ambil konfigurasi dari config/services.php
        $url    = config('services.sap_api.url'); // URL dasar
        $client = config('services.sap_api.client');
        $user   = config('services.sap_api.username');
        $pass   = config('services.sap_api.password');

        // Bangun URL penuh dengan query parameters
        $fullUrl = $url . 'sap-client=' . $client . '&sap-user=' . $user . '&sap-password=' . $pass . '&PO_NO=' . $po_no;
        // dd($fullUrl); // Cek URL yang sudah dibentuk
        // $fullUrl = "http://149.129.247.175:8001/sap/zapi/ZMM_TCH_PO_LIST?sap-client=300&sap-user=tch-support&sap-password=Tchsuper99@&PO_NO=5711006158";
        try {
            // Kirim GET request dengan header Authorization manual
            $response = Http::withBasicAuth($user, $pass)
                ->timeout(180) // Set timeout to 180 seconds
                ->get($fullUrl);

            // Mendekode respons JSON ke dalam array asosiatif
            $responseBody = json_decode($response->body(), true);
            // Cek response
            dd($response); // Debug response body

            // Jika berhasil, tampilkan data
            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'status' => 'success',
                    'data'   => $data
                ]);
            } else {
                // Jika gagal, kirim pesan error
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengambil data PO dari SAP.',
                    'detail' => $response->body()
                ], $response->status());
            }
        } catch (\Exception $e) {
            // Tangani error koneksi atau lainnya
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghubungi SAP.',
                'exception' => $e->getMessage()
            ], 500);
        }
    }
    public function store_data_trans(Request $request)
    {
        // Ambil itemcode dan seq dari request
        $itemcode = $request->input('itemcode');
        $seq = $request->input('seq');

        // Ambil data dari tabel ekanban_wipprinted_log_tbl di database ekanban
        $get_data_print_kanban = DB::connection('ekanban')->table('ekanban_wipprinted_log_tbl')
            ->where('item_code', $itemcode)
            ->where('seq', $seq)
            ->select(
                'ekanban_no',
                'item_code',
                'part_name',
                'part_no',
                'kanban_qty',
                'from_sloc'
            )
            ->first(); // Ambil hanya satu data
        // dd($get_data_print_kanban);
        // Jika data tidak ditemukan, return error
        if (!$get_data_print_kanban) {
            return response()->json([
                'success' => false,
                'message' => 'Data kanban tidak ditemukan!'
            ]);
        }

        // Simpan data ke tabel ekanban_outgoing_trans di database ekanban
        $entry_id = DB::connection('ekanban')->table('ekanban_outgoing_trans')->insertGetId([
            'ekanban_no'   => $get_data_print_kanban->ekanban_no,
            'item_code'    => $get_data_print_kanban->item_code,
            'part_name'    => $get_data_print_kanban->part_name,
            'part_no'      => $get_data_print_kanban->part_no,
            'qty'          => $get_data_print_kanban->kanban_qty,
            'seq'          => $seq,
            'created_by'   => Auth::user()->user, // Ambil user yang login
            'creation_date' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'), // Format Jakarta
            'sloc'         => $get_data_print_kanban->from_sloc,
            'branch'       => '1701'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function delete_outgoing_datatables(Request $request)
    {
        // Mengambil data dari request
        $id = $request->id;
        $itemcode_database = $request->itemcode_database;


        try {
            // Memulai transaksi
            DB::beginTransaction();

            // Menghapus baris dari database chuter out
            $delete_out_trans = DB::connection('ekanban')->table('ekanban_outgoing_trans')->where('id', $id)
                ->where('item_code', $itemcode_database)
                ->delete();

            // Commit the transaction
            DB::connection('ekanban')->commit();

            // Mengembalikan response sukses
            return response()->json([
                'message' => 'Data has been deleted and updated successfully.',
            ]);
        } catch (\Exception $e) {
            // Rollback and handle failure
            DB::connection('ekanban')->rollback();

            // Mengembalikan response error
            return response()->json([
                'error' => 'Request failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function post_bpb(Request $request)
    {
        // dd($request);
        $get_user = Auth::user()->user;

        $tanggal = Carbon::now()->format('Ymd'); // Misal: 20250421
        $tahun   = Carbon::now()->format('Y');   // Misal: 2025

        $prefixTanggal = "BPB-$tanggal";        // Untuk format akhir
        $prefixTahun   = "BPB-$tahun";          // Untuk cari berdasarkan tahun

        // Cari BPB terakhir dalam tahun yang sama (bukan pertanggal)
        $lastBPB = Ekanban_outgoing_tbl::where('bpb_no', 'like', "$prefixTahun%")
            ->select('bpb_no')
            ->orderBy('bpb_no', 'desc')
            ->first();

        if ($lastBPB) {
            // Ambil 5 digit terakhir dari BPB
            preg_match('/BPB-\d{8}-(\d{5})$/', $lastBPB->bpb_no, $matches);

            if (isset($matches[1])) {
                $lastNumber = (int) $matches[1];
                $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '00001';
            }
        } else {
            // Jika belum ada BPB untuk tahun ini, mulai dari 00001
            $newNumber = '00001';
        }

        // Gabungkan tanggal dengan urutan
        $bpb_new = "$prefixTanggal-$newNumber";

        // Ambil data dari tabel sementara berdasarkan pengguna
        $get_data_temporary = DB::connection('ekanban')
            ->table('ekanban_outgoing_trans')
            ->where('created_by', $get_user)
            ->get();

        // Cek jika tidak ada data
        if ($get_data_temporary->isEmpty()) {
            return response()->json([
                'message' => 'No data found in Trans Out !',
            ], 400);
        }

        // Mulai transaction
        DB::connection('ekanban')->beginTransaction();

        try {
            // get data po input
            $po_no = $request->input('input1');
            // Simpan ID untuk penghapusan setelah proses selesai
            $ids_to_delete = [];

            // Simpan data ke `ekanban_outgoing_tbl`
            foreach ($get_data_temporary as $data) {
                DB::connection('ekanban')->table('ekanban_outgoing_tbl')->insert([
                    'po_no'         => $po_no,
                    'bpb_no'        => $bpb_new,
                    'ekanban_no'    => $data->ekanban_no,
                    'item_code'     => $data->item_code,
                    'part_name'     => $data->part_name,
                    'part_no'       => $data->part_no,
                    'seq'           => $data->seq,
                    'qty'           => $data->qty,
                    'created_by'    => $get_user,
                    'creation_date' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                    'sloc'          => $data->sloc,
                    'branch'        => $data->branch
                ]);

                // Simpan ID untuk dihapus nanti
                $ids_to_delete[] = $data->id;
            }

            // Hapus data di `ekanban_outgoing_trans` setelah diproses
            DB::connection('ekanban')->table('ekanban_outgoing_trans')
                ->whereIn('id', $ids_to_delete)
                ->delete();

            // Commit transaction jika semua berhasil
            DB::connection('ekanban')->commit();

            return response()->json([
                'message' => 'Data post successfully',
                'bpb_no'  => $bpb_new, // Kirim BPB NO ke frontend
            ], 200);
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            DB::connection('ekanban')->rollBack();

            return response()->json([
                'message' => 'Failed to process data: ' . $e->getMessage(),
            ], 500);
        }
    }
}
