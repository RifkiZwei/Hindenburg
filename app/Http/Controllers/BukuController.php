<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Buku::with('kategori')->latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $buku = Buku::create($request->validate([
            'isbn' => ['required', 'string', 'max:255', 'unique:buku,isbn'],
            'nama_buku' => ['required', 'string', 'max:255'],
            'foto_buku' => ['nullable', 'string', 'max:255'],
            'stok' => ['nullable', 'integer', 'min:0'],
            'kategori_id' => ['required', 'integer', 'exists:kategori_buku,id'],
        ]));

        return response()->json($buku->load('kategori'), 201);
    }

    public function show(Buku $buku): JsonResponse
    {
        return response()->json($buku->load('kategori'));
    }

    public function update(Request $request, Buku $buku): JsonResponse
    {
        $buku->update($request->validate([
            'isbn' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('buku', 'isbn')->ignore($buku->id)],
            'nama_buku' => ['sometimes', 'required', 'string', 'max:255'],
            'foto_buku' => ['nullable', 'string', 'max:255'],
            'stok' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'kategori_id' => ['sometimes', 'required', 'integer', 'exists:kategori_buku,id'],
        ]));

        return response()->json($buku->fresh()->load('kategori'));
    }

    public function destroy(Buku $buku): JsonResponse
    {
        $buku->delete();

        return response()->json(null, 204);
    }
}
