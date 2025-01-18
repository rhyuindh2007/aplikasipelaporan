<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            "title" => "Data User",
            "data" => User::all()
        ]);
    }
    public function create()
    {
        return view('user.create', ["title" => "Tambah User"]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"]),
        ]);

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Ditambahkan');
    }
}