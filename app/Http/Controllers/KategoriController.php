<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Redirect;

class KategoriController extends Controller
{
    //
    public function index()
    {
        $kategori=Kategori::all();
        return view('kategori.index',[
            "title"=>"kategori",
            "data"=>$kategori
        ]);
    }
    public function create():View
    {
        return view('kategori.create')->with(["title" => "Tambah Data Kategori",]);
    }
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
        ]);
        
        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success','Data Kategori Berhasil Ditambahkan');
    }
    public function edit(Kategori $kategori):View
    {
        return view('kategori.edit',compact('kategori'))->with([
            "title" => "Ubah Data Kategori",
        ]);
    }
    public function update(Kategori $kategori, Request $request):RedirectResponse
    {
        $request->validate([
            "name"=>"required",
        ]);

        $kategori->update($request->all());
        return redirect()->route('kategori.index')->with('updated','Data Kategori Berhasil Diubah');
    }
    public function show():View
    {
        $kategori=Kategori::all();
        return view('kategori.show')->with([
            "title" => "kategori Data Kategori",
            "data"=>$kategori
        ]);
    }
    public function destroy($id):RedirectResponse
    {
        Kategori::where('id',$id)->delete();
        return redirect()->route('kategori.index')->with('deleted','Data Kategori Berhasil Dihapus');
    }
}
