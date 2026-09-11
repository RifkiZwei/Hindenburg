<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Member::latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $member = Member::create($request->validate([
            'nama_member' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:member,email'],
            'jenis_kelamin' => ['required', 'string', 'max:50'],
            'tanggal_lahir' => ['nullable', 'date'],
            'nama_rekening' => ['nullable', 'string', 'max:255'],
            'foto_member' => ['nullable', 'string', 'max:255'],
        ]));

        return response()->json($member, 201);
    }

    public function show(Member $member): JsonResponse
    {
        return response()->json($member);
    }

    public function update(Request $request, Member $member): JsonResponse
    {
        $member->update($request->validate([
            'nama_member' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', Rule::unique('member', 'email')->ignore($member->id)],
            'jenis_kelamin' => ['sometimes', 'required', 'string', 'max:50'],
            'tanggal_lahir' => ['nullable', 'date'],
            'nama_rekening' => ['nullable', 'string', 'max:255'],
            'foto_member' => ['nullable', 'string', 'max:255'],
        ]));

        return response()->json($member->fresh());
    }

    public function destroy(Member $member): JsonResponse
    {
        $member->delete();

        return response()->json(null, 204);
    }
}
