<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(SearchRequest $request)
{
    $this->authorize('viewAny', Produk::class);

    $keyword = $request->input('search');

    if ($keyword) {
        $products = Produk::with('jenis')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
        ->orderBy('nama')
        ->paginate(10)
        ->withQueryString();
    } else {
        $products = Produk::with('jenis')->oldest()->paginate(10)->withQueryString();
    }

    return view('produk.index', compact('products'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenis = Jenis::orderBy('nama_jenis')->get();

        return view('produk.create', compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);
        
        $dataReq = $request->validated();

        $data['user_id'] = Auth::id();
        $data['nama'] = $dataReq['name'];
        $data['harga_beli'] = $dataReq['purchase_price'];
        $data['harga_jual'] = $dataReq['selling_price'];
        $data['stok'] = $dataReq['stock'] ?? true;
        $data['jenis_id'] = $dataReq['jenis_id'];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk create successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenis = Jenis::orderBy('nama_jenis')->get();

        return view('produk.edit', compact('produk', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);
        
        $dataReq = $request->validated();

        $data = [
            'user_id' => Auth::id(),
            'nama' => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok' => $dataReq['stock'],
            'jenis_id' => $dataReq['jenis_id'],
        ];

        if ($request->hasFile('foto')) {
            // Delete the old image if it exists
            if (
                $produk->foto && 
                Storage::disk('public')->exists($produk->foto)
            ) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);
 
        return redirect()->route('produk.edit', $produk->id)->with('success', 'Product updated successfully.');
    }

   
    public function destroy(Produk $produk)
{
    $this->authorize('delete', $produk);

    try {
        
        $foto = $produk->foto;

        
        $produk->delete();

        
        if ($foto && Storage::disk('public')->exists($foto)) {
            Storage::disk('public')->delete($foto);
        }

        return redirect()
            ->route('produk.index')
            ->with('success', 'Product deleted successfully.');

    } catch (QueryException $e) {

        return redirect()
            ->route('produk.index')
            ->with('error', 'Produk tidak dapat dihapus karena sudah digunakan dalam transaksi penjualan.');
    }
}
}