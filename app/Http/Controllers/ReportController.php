<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request){
        
        $year = $request->input('year', Carbon::now()->format('Y'));
        $month = $request->input('month', Carbon::now()->format('m'));

        $salesData = pemesanan::selectRaw(
            'CASE 
                WHEN MONTH(tanggal_pemesanan) BETWEEN 1 AND 3 THEN "Jan-Mar"
                WHEN MONTH(tanggal_pemesanan) BETWEEN 4 AND 6 THEN "Apr-Jun"
                WHEN MONTH(tanggal_pemesanan) BETWEEN 7 AND 9 THEN "Jul-Sep"
                WHEN MONTH(tanggal_pemesanan) BETWEEN 10 AND 12 THEN "Oct-Dec"
            END as period, 
            SUM(total_harga) as total_sales, 
            COUNT(id_pemesanan) as total_orders'
        )
        ->whereYear('tanggal_pemesanan', $year)
        ->groupBy('period')
        ->get();

        $salesByCash = pembayaran::where('metode_pembayaran', 'Cash')
            ->whereYear('tanggal_pembayaran', $year)
            ->groupBy(pembayaran::raw('MONTH(tanggal_pembayaran)'))
            ->select(pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'), pemesanan::raw('sum(total_pembayaran) as total_sales'))
            ->get()
            ->toArray();

        $salesByCashless = pembayaran::where('metode_pembayaran', 'Cashless')
            ->whereYear('tanggal_pembayaran', $year)
            ->groupBy(pembayaran::raw('MONTH(tanggal_pembayaran)'))
            ->select(pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'), pemesanan::raw('sum(total_pembayaran) as total_sales'))
            ->get()
            ->toArray();

        $periods = [];
        $totalSales = [];
        $totalOrders = [];

        foreach ($salesData as $data) {
            $periods[] = $data->period;
            $totalSales[] = $data->total_sales;
            $totalOrders[] = $data->total_orders;
        }

        return view('laporan', compact('periods', 'totalSales', 'totalOrders', 'salesByCash', 'salesByCashless'));
    }
}
