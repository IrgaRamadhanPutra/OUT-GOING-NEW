<?php

namespace App\Http\Controllers;

use App\Models\Ekanban\Ekanban_outgoing_tbl;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BpbGenerateController extends Controller
{
    //
    public function index_bpb()
    {
        return view('bpb-outgoing.index');
    }

    public function get_datatables_bpb(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::connection('ekanban')->table('ekanban_outgoing_tbl')->select(
                'bpb_no',  // Selecting unique bpb_no
                // DB::raw('MAX(id) as id'),  // Get the maximum id for the unique bpb_no
                DB::raw('MAX(po_no) as po_no'),
                DB::raw('MAX(created_by) as created_by'),
                DB::raw('MAX(creation_date) as creation_date')
            )
                ->whereNotNull('bpb_no')
                ->groupBy('bpb_no')
                ->orderBy('creation_date', 'desc')
                ->get();

            // dd($data);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="#" data-toggle="tooltip" style="color: rgb(0, 0, 0);" data-bpb="' . $data->bpb_no . '"
                                data-placement="top"title="pdf"class="dropdown-item pdf">
                                   <i class="bi bi-file-earmark-fill"></i> PDF
                            </a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function generate_bpb_pdf($id_database, $bpb_database)
    {
        // Ambil data dari database
        // 1. Total semua baris data (total kanban fisik)
        $data = DB::connection('ekanban')
            ->table('ekanban_outgoing_tbl')
            ->select(
                'ekanban_no',
                'bpb_no',
                'po_no',
                'part_name',
                DB::raw('MIN(qty) as qty_per_kanban'), // Asumsinya semua qty per kanban sama
                DB::raw('MIN(creation_date) as creation_date'),
                DB::raw('COUNT(*) as total_kanban'),
                DB::raw('SUM(qty) as total_qty')
            )
            ->where('bpb_no', $bpb_database)
            ->groupBy('ekanban_no', 'bpb_no', 'part_name', 'po_no')
            ->get();

        // dd($data);

        // // 2. Group by ekanban_no
        // $data = Ekanban_outgoing_tbl::select(
        //     'ekanban_no',
        //     DB::raw('MIN(bpb_no) as bpb_no'),
        //     DB::raw('MIN(part_name) as part_name'),
        //     DB::raw('MIN(creation_date) as creation_date'),
        //     DB::raw('MIN(po_no) as po_no'),
        //     DB::raw('SUM(qty) as total_qty'),
        //     DB::raw('COUNT(*) as total_rows')
        // )
        //     ->where('bpb_no', $bpb_database)
        //     ->groupBy('ekanban_no')
        //     ->get();


        // dd($totalKanban, $data);

        // Generate QR Code dari bpb_no
        $qrCode = QrCode::size(100)->generate($bpb_database);
        // dd($qrCode);
        // Kirim data dan QR ke view
        $pdf = Pdf::loadView('bpb-outgoing.generate_bpb_pdf', [
            // 'totalKanban' => $totalKanban,
            'data' => $data,
            'qrcode' => $qrCode
        ])->setPaper('a4', 'potrait');
        // dd($pdf);
        // ->setPaper([0, 0, 595.28, 935.43], 'landscape'); // ukuran F5 dalam poin



        return $pdf->stream("bpb_{$bpb_database}.pdf");
    }
}
