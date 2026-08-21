<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class JenisController extends Controller
{
   public function index(Request $request)
    {
        $keyword = $request->input('search');

        $jenis = Jenis::when($keyword, function ($query) use ($keyword) {
        $query->where('nama_jenis', 'like', '%' . $keyword . '%');
    })
        ->oldest()
        ->paginate(10)
        ->withQueryString();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
    $request->validate(['nama_jenis' => 'required|string|max:100']);

    Jenis::create([
        'nama_jenis' => $request->nama_jenis,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan');
}

    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jenis)
    {
        $request->validate(['nama_jenis' => 'required|string|max:100']);
        $jenis->update($request->only('nama_jenis'));
        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diupdate');
    }

    public function destroy(Jenis $jenis)
    {
        try {
            $jenis->delete();
            return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->route('jenis.index')->with('error', 'Jenis tidak dapat dihapus karena masih digunakan oleh produk.');
        }
    }
}