<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(){return view('members.index',['members'=>Member::latest()->get()]);}
    public function create(){return view('members.create');}
    public function store(Request $request){$data=$this->rules($request);if($request->hasFile('foto_member')){$data['foto_member']=$request->file('foto_member')->store('photos/members','public');}$member=Member::create($data);return redirect()->route('members.show',$member)->with('success','Member berhasil ditambahkan.');}
    public function show(Member $member){return view('members.show',compact('member'));}
    public function edit(Member $member){return view('members.edit',compact('member'));}
    public function update(Request $request,Member $member){$data=$this->rules($request,$member);if($request->hasFile('foto_member')){if($member->foto_member){Storage::disk('public')->delete($member->foto_member);}$data['foto_member']=$request->file('foto_member')->store('photos/members','public');}else{unset($data['foto_member']);}$member->update($data);return redirect()->route('members.show',$member)->with('success','Member berhasil diperbarui.');}
    public function destroy(Member $member){if($member->transaksi()->exists()){return redirect()->route('members.index')->with('error','Member tidak dapat dihapus karena sudah memiliki transaksi.');}if($member->foto_member){Storage::disk('public')->delete($member->foto_member);}$member->delete();return redirect()->route('members.index')->with('success','Member berhasil dihapus.');}
    private function rules(Request $request,?Member $member=null):array{return $request->validate(['nama_member'=>['required','string','max:255'],'email'=>['required','email','max:255',Rule::unique('member','email')->ignore($member?->id)],'jenis_kelamin'=>['required',Rule::in(['Laki-laki','Perempuan'])],'tanggal_lahir'=>['nullable','date'],'nama_rekening'=>['nullable','string','max:255'],'foto_member'=>['nullable','image','mimes:jpg,jpeg,png,webp','max:2048']]);}
}
