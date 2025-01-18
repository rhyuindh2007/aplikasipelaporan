<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    /**
     * Display a listing of the reports.
     */
    public function index(): View
    {
        $laporan = Laporan::all();
        return view('laporan.index', [
            "title" => "Laporan",
            "data" => $laporan,
        ]);
    }

    /**
     * Show the form for creating a new report.
     */
    public function create(): View
    {
        return view('laporan.create', [
            "title" => "Tambah Data Laporan",
            "user" => User::all(),
            "kategori" => Kategori::all(),
        ]);
    }

    /**
     * Store a newly created report in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            "judul" => "required|string|max:255",
            "tanggal" => "nullable|date",
            "kategori_id" => "required|exists:kategoris,id",
            "file" => "required|file|mimes:pdf|max:2048",
        ]);

        $filePath = $request->file('file')->store('laporan', 'public');

        Laporan::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
            'file' => $filePath,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Data Laporan Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified report.
     */
    public function edit(Laporan $laporan): View
    {
        return view('laporan.edit', compact('laporan'))->with([
            "title" => "Ubah Data Laporan",
            "user" => User::all(),
            "kategori" => Kategori::all(),
        ]);
    }

    /**
     * Update the specified report in storage.
     */
    public function update(Laporan $laporan, Request $request): RedirectResponse
    {
        $request->validate([
            "judul" => "required|string|max:255",
            "tanggal" => "nullable|date",
            "kategori_id" => "required|exists:kategoris,id",
            "file" => "nullable|file|mimes:pdf|max:2048",
        ]);

        $data = [
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'kategori_id' => $request->kategori_id,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
                Storage::disk('public')->delete($laporan->file);
            }

            $data['file'] = $request->file('file')->store('laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->route('laporan.index')->with('updated', 'Data Laporan Berhasil Diubah');
    }

    /**
     * Display the specified report.
     */
    public function show($id): View
    {
        $laporan = Laporan::with('kategori')->findOrFail($id);
        return view('laporan.show', [
            'title' => 'Detail Laporan',
            'data' => [$laporan],
        ]);
    }

    /**
     * View the specified PDF file.
     */
    public function viewPdf($filename)
    {
        $path = storage_path("app/public/laporan/{$filename}");
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->file($path);
    }

    /**
     * Download the specified PDF file.
     */
    public function downloadPdf($filename)
    {
        $path = storage_path("app/public/laporan/{$filename}");
        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path);
    }

    /**
     * Remove the specified report from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $laporan = Laporan::findOrFail($id);

        // Hapus file jika ada
        if ($laporan->file && Storage::disk('public')->exists($laporan->file)) {
            Storage::disk('public')->delete($laporan->file);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('deleted', 'Data Laporan Berhasil Dihapus');
    }
}
