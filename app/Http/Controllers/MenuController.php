<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(){
        $menu = menu::all();
        return view('menu', compact('menu'));
    }

    public function store(Request $request){
        $request->validate([
            'nama_menu' => 'required|string',
            'harga' => 'required|integer',
            // 'jenis_menu' => 'required|string',
            'imageAdd_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageAddName = '';

        if ($request->hasFile('imageAdd_name')) {
            $image = $request->file('imageAdd_name');
            $imageAddName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageAddName);
        }

        menu::create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'jenis_menu' => "Minuman",
            'image_name' => $imageAddName,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_menu' => 'required|string',
            'harga' => 'required|integer',
            // 'jenis_menu' => 'required|string',
            'imageEdit_name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageEditName = '';

        if ($request->hasFile('imageEdit_name')) {
            $image = $request->file('imageEdit_name');
            $imageEditName = time().'.'.$image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageEditName);
        }

        $menu = menu::find($id);
        $menu->nama_menu = $request->nama_menu;
        $menu->harga = $request->harga;
        $menu->jenis_menu = "Minuman";
        $menu->image_name = $imageEditName;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diubah!');
    }

    public function destroy($id){
        $menu = menu::find($id);

        if($menu->image && Storage::exists($menu->image)) {
            Storage::delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
