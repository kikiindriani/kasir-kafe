<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('loginPage');
    }

    public function loginProcess(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $dataPegawai = pegawai::with('level') 
            ->where('username', $request->username)
            ->first();


        if($dataPegawai){
            if (Hash::check($request->password, $dataPegawai->password)) {

                session([ 'user' => 
                    [
                        'user_id' => $dataPegawai->id_pegawai,
                        'name' => $dataPegawai->nama_pegawai,
                        'level' => $dataPegawai->level->level,
                        'username' => $dataPegawai->username
                    ]
                ]);

                
                $level = $dataPegawai->level; 
                if ($level && $level->id_level == 1) {
                    return redirect()->route('pegawai.index')->with('success', 'Selamat datang!');
                } else if ($level && $level->id_level == 2) {
                    return redirect()->route('menu.index')->with('success', 'Selamat datang!');
                } else if ($level && $level->id_level == 3) {
                    return redirect()->route('order.index')->with('success', 'Selamat datang!');
                } else {
                    return redirect()->route('login')->with('error', 'akses tidak ditemukan!');
                }
            } else {
                return redirect()->route('login')->with('error', 'Username atau password salah!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Pengguna tidak ditemukan!');
        }
    }

    public function logoutProcess(){
        session()->forget('user');
        return redirect()->route('login');
    }
}
