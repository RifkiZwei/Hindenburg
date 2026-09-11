<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Member;
use App\Models\TransaksiBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BerandaController extends Controller
{
    public function index()
    {
        return view('home', [
            'bukus' => Buku::with('kategori')->orderBy('nama_buku')->get(),
            'members' => Member::orderBy('nama_member')->get(),
        ]);
    }

    public function transaksi(Request $request)
    {
        $data = $request->validate([
            'member_id' => ['required', 'integer', 'exists:member,id'],
            'buku_id' => ['required', 'integer', 'exists:buku,id'],
            'jenis' => ['required', Rule::in(['pinjam', 'beli'])],
            'jumlah' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($data) {
            $buku = Buku::whereKey($data['buku_id'])->lockForUpdate()->firstOrFail();

            if ($buku->stok < $data['jumlah']) {
                abort(422, 'Stok buku tidak mencukupi.');
            }

            $buku->decrement('stok', $data['jumlah']);
            TransaksiBuku::create($data);
        });

        return redirect()->route('home')->with('success', ucfirst($data['jenis']) . ' buku berhasil dicatat.');
    }
}
