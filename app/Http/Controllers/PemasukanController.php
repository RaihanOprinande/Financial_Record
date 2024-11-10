<?php

namespace App\Http\Controllers;

use App\Models\KategoriPemasukan;
use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index(){
        $pemasukan = Pemasukan::latest()->paginate(10);
        $kategori = KategoriPemasukan::latest()->paginate(10);
        $total = Pemasukan::sum('jumlah');
        return view('Features.pemasukan.pemasukan',['pemasukans'=>$pemasukan,'kpemasukan'=>$kategori,'total'=>$total]);
    }

    public function create(){
        $addpemasukan = Pemasukan::all();
        $kategoris = KategoriPemasukan::all();
        return view('Features.pemasukan.create',['addpemasukans' => $addpemasukan, 'kategoris' => $kategoris]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required'
        ]);
        Pemasukan::create($validated);
        return redirect('/pemasukan')-> with('pesan', 'Data berhasil disimpan');
    }

    public function edit(string $id){
        $editpemasukan = Pemasukan::find($id);
        $kategoris = KategoriPemasukan::all();
        return view('Features.pemasukan.edit',compact('editpemasukan','kategoris'));
    }

    public function update(Request $request, string $id){
        $validated = $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required'
        ]);
        Pemasukan::where('id',$id)->update($validated);
        return redirect('/pemasukan')-> with('pesan', 'Data berhasil diubah');
    }

    public function destroy(string $id){
        Pemasukan::destroy($id);
        return redirect('pemasukan')->with('pesan','Data berhasil dihapus');
    }
}
