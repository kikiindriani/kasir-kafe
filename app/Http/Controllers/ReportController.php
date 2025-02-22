<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\pemesanan;
use App\Models\detail_pemesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        $dateFilter = $request->get('date_filter', Carbon::now()->format('Y-m-d'));

        $year = Carbon::parse($dateFilter)->format('Y');
        $month = Carbon::parse($dateFilter)->format('m');

        $salesData = pemesanan::selectRaw(
            'MONTH(tanggal_pemesanan) as month,
                        SUM(total_harga) as total_sales,
                        COUNT(id_pemesanan) as total_orders'
        )
            ->whereYear('tanggal_pemesanan', $year)
            ->whereMonth('tanggal_pemesanan', $month)
            ->groupBy('month')
            ->get();

        $salesByCash = pembayaran::where('metode_pembayaran', 'Cash')
            ->whereYear('tanggal_pembayaran', $year)
            ->whereMonth('tanggal_pembayaran', $month)
            ->groupBy(pembayaran::raw('MONTH(tanggal_pembayaran)'))
            ->select(pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'), pemesanan::raw('sum(total_pembayaran) as total_sales'))
            ->get()
            ->toArray();

        $salesByCashless = pembayaran::where('metode_pembayaran', 'Cashless')
            ->whereYear('tanggal_pembayaran', $year)
            ->whereMonth('tanggal_pembayaran', $month)
            ->groupBy(pembayaran::raw('MONTH(tanggal_pembayaran)'))
            ->select(pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'), pemesanan::raw('sum(total_pembayaran) as total_sales'))
            ->get()
            ->toArray();

        $periods = [];
        $totalSales = [];
        $totalOrders = [];

        foreach ($salesData as $data) {
            $periods[] = Carbon::create()->month($data->month)->format("F");
            $totalSales[] = $data->total_sales;
            $totalOrders[] = $data->total_orders;
        }

        return view('laporan', compact('periods', 'totalSales', 'totalOrders', 'salesByCash', 'salesByCashless', 'dateFilter'));
    }

    public function detail(Request $request)
    {

        $dateFilter = $request->get('date_filter', Carbon::now()->format('Y-m-d'));

        $year = Carbon::parse($dateFilter)->format('Y');
        $month = Carbon::parse($dateFilter)->format('m');

        $salesData = pemesanan::whereYear('tanggal_pemesanan', $year)
            ->whereMonth('tanggal_pemesanan', $month)
            ->orderBy('tanggal_pemesanan', 'ASC')
            ->get();


        $salesPerDay = pemesanan::selectRaw(
            'DATE(tanggal_pemesanan) as date,
                SUM(total_harga) as total_sales'
        )
            ->whereYear('tanggal_pemesanan', $year)
            ->whereMonth('tanggal_pemesanan', $month)
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $salesForCash = pembayaran::where('metode_pembayaran', 'Cash')
            ->whereYear('tanggal_pembayaran', $year)
            ->whereMonth('tanggal_pembayaran', $month)
            ->groupBy(pembayaran::raw('MONTH(tanggal_pembayaran)'))
            ->select(pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'), pemesanan::raw('sum(total_pembayaran) as total_sales'))
            ->get();

        $salesForCashless = pembayaran::where('metode_pembayaran', 'Cashless')
            ->whereYear('tanggal_pembayaran', $year)
            ->whereMonth('tanggal_pembayaran', $month)
            ->groupBy(pembayaran::raw('MONTH(tanggal_pembayaran)'))
            ->select(pembayaran::raw('MONTH(tanggal_pembayaran) as bulan'), pemesanan::raw('sum(total_pembayaran) as total_sales'))
            ->get();

        $dataPesanan = detail_pemesanan::join('menu', 'detail_pemesanan.id_menu', '=', 'menu.id_menu')
            ->join('pemesanan', 'detail_pemesanan.id_pemesanan', '=', 'pemesanan.id_pemesanan')
            ->whereYear('pemesanan.created_at', $year)
            ->whereMonth('pemesanan.created_at', $month)
            ->groupBy('detail_pemesanan.id_menu', 'menu.nama_menu')
            ->select(
                'menu.nama_menu',
                detail_pemesanan::raw('SUM(detail_pemesanan.jumlah) as total_dipesan')
            )
            ->orderBy('total_dipesan', 'DESC')
            ->get();

        $dataPegawai = pembayaran::join('pegawai', 'pembayaran.id_pegawai', '=', 'pegawai.id_pegawai')
            ->whereYear('pembayaran.created_at', $year)
            ->whereMonth('pembayaran.created_at', $month)
            ->groupBy('pembayaran.id_pegawai', 'pegawai.nama_pegawai')
            ->select(
                'pegawai.nama_pegawai',
                pembayaran::raw('COUNT(pembayaran.id_pegawai) as total_transaksi')
            )
            ->orderBy('total_transaksi', 'DESC')
            ->get();

        return view('laporanDetail', compact('salesData', 'salesPerDay', 'salesForCash', 'salesForCashless', 'dataPesanan', 'dataPegawai'));
    }
}
