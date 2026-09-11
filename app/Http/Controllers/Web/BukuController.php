<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    public function index(){return view('buku.index',['bukus'=>Buku::with('kategori')->latest()->get()]);}
    public function create(){return view('buku.create',['kategoris'=>KategoriBuku::orderBy('nama_kategori')->get()]);}
    public function store(Request $request){$data=$this->rules($request);if($request->hasFile('foto_buku')){$data['foto_buku']=$request->file('foto_buku')->store('photos/books','public');}$buku=Buku::create($data);return redirect()->route('buku.show',$buku)->with('success','Buku berhasil ditambahkan.');}
    public function show(Buku $buku){return view('buku.show',['buku'=>$buku->load('kategori')]);}
    public function edit(Buku $buku){return view('buku.edit',['buku'=>$buku,'kategoris'=>KategoriBuku::orderBy('nama_kategori')->get()]);}
    public function update(Request $request,Buku $buku){$data=$this->rules($request,$buku);if($request->hasFile('foto_buku')){if($buku->foto_buku){Storage::disk('public')->delete($buku->foto_buku);}$data['foto_buku']=$request->file('foto_buku')->store('photos/books','public');}else{unset($data['foto_buku']);}$buku->update($data);return redirect()->route('buku.show',$buku)->with('success','Buku berhasil diperbarui.');}
    public function destroy(Buku $buku){if($buku->transaksi()->exists()){return redirect()->route('buku.index')->with('error','Buku tidak dapat dihapus karena sudah memiliki transaksi.');}if($buku->foto_buku){Storage::disk('public')->delete($buku->foto_buku);}$buku->delete();return redirect()->route('buku.index')->with('success','Buku berhasil dihapus.');}
    private function rules(Request $request,?Buku $buku=null):array{return $request->validate(['isbn'=>['required','string','max:255',Rule::unique('buku','isbn')->ignore($buku?->id)],'nama_buku'=>['required','string','max:255'],'foto_buku'=>['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],'stok'=>['required','integer','min:0'],'kategori_id'=>['required','integer','exists:kategori_buku,id']]);}
}
