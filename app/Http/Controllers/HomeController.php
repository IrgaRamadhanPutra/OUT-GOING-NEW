<?php

namespace App\Http\Controllers;

use App\Models\Ekanban\ekanban_stock_limit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function index_chuter2_Abnormality()
    {
        $mpname = Carbon::now()->format('m-Y');

        $data = ekanban_stock_limit::select(
            'ekanban_stock_limit.itemcode',
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.part_type) as part_type'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance'),
            DB::raw('COUNT(ekanban_fgin_tbl.item_code) as jumlah_kanban'), // jumlah kanban
            DB::raw('COALESCE(SUM(ekanban_fgin_tbl.qty), 0) as jumlah_qty')  // jumlah qty
        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })
            ->leftJoin('ekanban_fgin_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fgin_tbl.item_code')
                    ->whereNull('ekanban_fgin_tbl.chutter_address')
                    ->whereNull('ekanban_fgin_tbl.last_updated_by');
            })
            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get();

        // dd($data);
        return view('visual.chuter2_abnormality', compact('data'));
    }
    public function index_chuter2_All()
    {
        $mpname = Carbon::now()->format('m-Y');
        $data = ekanban_stock_limit::select(
            'ekanban_stock_limit.itemcode',
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.part_type) as part_type'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance'),
            DB::raw('COUNT(ekanban_fgin_tbl.item_code) as jumlah_kanban'), // jumlah kanban
            DB::raw('COALESCE(SUM(ekanban_fgin_tbl.qty), 0) as jumlah_qty')  // jumlah qty
        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })
            ->leftJoin('ekanban_fgin_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fgin_tbl.item_code')
                    ->whereNull('ekanban_fgin_tbl.chutter_address')
                    ->whereNull('ekanban_fgin_tbl.last_updated_by');
            })
            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get();

        // Convert the model to an array and use dd() to display
        // dd($data);
        return view('visual.chuter2_all', compact('data'));
    }

    public function index_chuter1_Abnormality()
    {
        $mpname = Carbon::now()->format('m-Y');
        $data = ekanban_stock_limit::select(
            'ekanban_stock_limit.itemcode',
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.part_type) as part_type'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance'),
            DB::raw('COUNT(ekanban_fgin_tbl.item_code) as jumlah_kanban'), // jumlah kanban
            DB::raw('COALESCE(SUM(ekanban_fgin_tbl.qty), 0) as jumlah_qty')  // jumlah qty
        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })
            ->leftJoin('ekanban_fgin_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fgin_tbl.item_code')
                    ->whereNull('ekanban_fgin_tbl.chutter_address')
                    ->whereNull('ekanban_fgin_tbl.last_updated_by');
            })
            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get();
        // Convert the model to an array and use dd() to display it
        // dd($data);
        return view('visual.chuter1_abnormality', compact('data'));
    }

    public function index_chuter1_All()
    {
        $mpname = Carbon::now()->format('m-Y');
        $data = ekanban_stock_limit::select(
            'ekanban_stock_limit.itemcode',
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.part_type) as part_type'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance'),
            DB::raw('COUNT(ekanban_fgin_tbl.item_code) as jumlah_kanban'), // jumlah kanban
            DB::raw('COALESCE(SUM(ekanban_fgin_tbl.qty), 0) as jumlah_qty')  // jumlah qty
        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })
            ->leftJoin('ekanban_fgin_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fgin_tbl.item_code')
                    ->whereNull('ekanban_fgin_tbl.chutter_address')
                    ->whereNull('ekanban_fgin_tbl.last_updated_by');
            })
            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get();
        // dd($data);
        return view('visual.chuter1_all', compact('data'));
    }
}
