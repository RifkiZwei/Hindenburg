<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriBukuController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(KategoriBuku::withCount('buku')->latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $kategori = KategoriBuku::create($request->validate([
            'nama_kategori' => ['required', 'string', Rule::in(KategoriBuku::GENRES)],
            'foto_kategori' => ['nullable', 'string', 'max:255'],
        ]));

        return response()->json($kategori, 201);
    }

    public function show(KategoriBuku $kategoriBuku): JsonResponse
    {
        return response()->json($kategoriBuku->load('buku'));
    }

    public function update(Request $request, KategoriBuku $kategoriBuku): JsonResponse
    {
        $kategoriBuku->update($request->validate([
            'nama_kategori' => ['sometimes', 'required', 'string', Rule::in(KategoriBuku::GENRES)],
            'foto_kategori' => ['nullable', 'string', 'max:255'],
        ]));

        return response()->json($kategoriBuku->fresh());
    }

    public function destroy(KategoriBuku $kategoriBuku): JsonResponse
    {
        $kategoriBuku->delete();

        return response()->json(null, 204);
    }
}
