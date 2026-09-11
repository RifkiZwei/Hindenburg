<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class KategoriBukuController extends Controller
{
    public function index(){return view('kategori-buku.index',['kategoris'=>KategoriBuku::withCount('buku')->latest()->get()]);}
    public function create(){return view('kategori-buku.create',['genres'=>KategoriBuku::GENRES]);}
    public function store(Request $request){$data=$this->rules($request);if($request->hasFile('foto_kategori')){$data['foto_kategori']=$request->file('foto_kategori')->store('photos/categories','public');}$kategori=KategoriBuku::create($data);return redirect()->route('kategori-buku.show',$kategori)->with('success','Kategori berhasil ditambahkan.');}
    public function show(KategoriBuku $kategoriBuku){return view('kategori-buku.show',['kategori'=>$kategoriBuku->load('buku')]);}
    public function edit(KategoriBuku $kategoriBuku){return view('kategori-buku.edit',['kategori'=>$kategoriBuku,'genres'=>KategoriBuku::GENRES]);}
    public function update(Request $request,KategoriBuku $kategoriBuku){$data=$this->rules($request);if($request->hasFile('foto_kategori')){if($kategoriBuku->foto_kategori){Storage::disk('public')->delete($kategoriBuku->foto_kategori);}$data['foto_kategori']=$request->file('foto_kategori')->store('photos/categories','public');}else{unset($data['foto_kategori']);}$kategoriBuku->update($data);return redirect()->route('kategori-buku.show',$kategoriBuku)->with('success','Kategori berhasil diperbarui.');}
    public function destroy(KategoriBuku $kategoriBuku){if($kategoriBuku->buku()->exists()){return redirect()->route('kategori-buku.index')->with('error','Kategori tidak dapat dihapus karena masih memiliki buku.');}if($kategoriBuku->foto_kategori){Storage::disk('public')->delete($kategoriBuku->foto_kategori);}$kategoriBuku->delete();return redirect()->route('kategori-buku.index')->with('success','Kategori berhasil dihapus.');}
    private function rules(Request $request):array{return $request->validate(['nama_kategori'=>['required','string',Rule::in(KategoriBuku::GENRES)],'foto_kategori'=>['nullable','image','mimes:jpg,jpeg,png,webp','max:2048']]);}
}
