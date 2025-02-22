<?php

namespace App\Http\Controllers;

use App\Models\detail_pemesanan;
use App\Models\menu;
use App\Models\pembayaran;
use App\Models\pemesanan;
use Illuminate\Http\Request;
class OrderController extends Controller
{
    public function index(){
        $menu = menu::all();
        return view('transaksi', compact('menu'));
    }

    public function store(request $request){
        
        $validate = $request->validate([
            'name' => 'required|string',
            'menu' => 'required|array',
            'menu.*.id_menu' => 'required|exists:menu,id_menu',
            'menu.*.quantity' => 'required|integer|min:1',
            'paymentMethod' => 'required|string|in:Cash,Cashless',
            'paymentAmount' => 'required|integer|min:1',
        ]);

        $name = $validate['name'];
        $menuItems = array_values($validate['menu']);
        $statusPembayaran = $validate['paymentMethod'];
        $paymentAmount = $validate['paymentAmount'];

        $totalHarga = 0;
        foreach ($menuItems as $item) {
            $menu = menu::find($item['id_menu']);
            $hargaItem = $menu->harga * $item['quantity'];
            $pajakItem = $hargaItem * 0.12;
            $totalHarga += $hargaItem + $pajakItem;
        }
        
        $paymentChange = $paymentAmount - $totalHarga;

        $pesanan = pemesanan::create([
            'jumlah' => count($menuItems),
            'total_harga' => $totalHarga,
            'tanggal_pemesanan' => now(),
            'nomor_meja' => 1,
            'id_member' => 1,
            'diskon' => "false",
        ]);

        foreach ($menuItems as $item) {
            detail_pemesanan::create([
                'id_pemesanan' => $pesanan->id_pemesanan,
                'id_menu' => $item['id_menu'],
                'jumlah' => $item['quantity'],
            ]);
        }

        pembayaran::create([
            'id_pemesanan' => $pesanan->id_pemesanan,
            'id_pegawai' => session('user')['user_id'],
            'tanggal_pembayaran' => now(),
            'metode_pembayaran' => $statusPembayaran,
            'total_pembayaran' => $totalHarga,
            'status' => "Sudah Dibayar",
        ]);

        return $this->showOrder($name, $pesanan->id_pemesanan, $statusPembayaran, $menuItems, $totalHarga, $paymentAmount, $paymentChange);
    }

    public function showOrder($name, $id_pemesanan, $statusPembayaran, $menuItems, $totalHarga, $paymentAmount, $paymentChange){
        $pesanan = pemesanan::find($id_pemesanan);

        foreach ($menuItems as &$item) { 
            $menu = menu::find($item['id_menu']);
            $item['nama_menu'] = $menu->nama_menu; 
            $item['harga'] = $menu->harga; 
            $item['subtotal'] = $item['quantity'] * $item['harga'];
        }

        return view('struk', [
            'name' => $name,
            'statusPembayaran' => $statusPembayaran,
            'menuItems' => $menuItems,
            'totalHarga' => $totalHarga,
            'pesanan' => $pesanan,
            'totalPembayaran' => $paymentAmount,
            'totalKembalian' => $paymentChange,
        ]);
    }

}
