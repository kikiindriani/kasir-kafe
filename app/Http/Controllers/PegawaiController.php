<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index(){

        $pegawai = Pegawai::where('id_level', '!=', 1)->get(); //lindungi admin
        return view('pegawai', compact('pegawai'));
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'string',
            'username' => 'required|string|unique:pegawai', 
            'passwordAdd' => 'required|string|min:8',
        ]);

        pegawai::create([
            'nama_pegawai' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->passwordAdd),
            'id_level' => 3
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    // public function find($id){
    //     $pegawai = pegawai::find($id);
    //     return view('edit-pegawai', compact('pegawai'));
    // }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'string',
            'username' => 'required|string|unique:pegawai,username,'.$id.',id_pegawai',
            'password' => 'required|string|min:8',
        ]);

        $pegawai = pegawai::find($id);
        $pegawai->nama_pegawai = $request->nama;
        $pegawai->username = $request->username;
        $pegawai->password = Hash::make($request->password);
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diubah!');
    }

    public function destroy($id){
    $pegawai = Pegawai::findOrFail($id);
    $pegawai->delete();

    return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }

}
