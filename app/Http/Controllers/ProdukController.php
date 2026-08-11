<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        // $this->authorize('viewAny', Produk::class); // Di-nonaktifkan agar kasir tidak terblokir Policy

        $keyword = $request->input('search');

        $query = Produk::with('user');

        if ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        }

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $this->authorize('create', Produk::class); // Di-nonaktifkan agar kasir bisa buka form tambah produk

        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Produk::class); // Di-nonaktifkan agar kasir bisa simpan produk

        // 1. Validasi input termasuk 'jenis_makanan'
        $dataReq = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_makanan' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Otomatis kalikan 1000 jika user memasukkan angka satuan (misal: 5 jadi 5000)
        $hargaBeli = $dataReq['purchase_price'] < 1000 ? $dataReq['purchase_price'] * 1000 : $dataReq['purchase_price'];
        $hargaJual = $dataReq['selling_price'] < 1000 ? $dataReq['selling_price'] * 1000 : $dataReq['selling_price'];

        // 2. Mapping data yang akan disimpan ke DB
        $data = [
            'user_id' => Auth::id(),
            'nama' => $dataReq['name'],
            'jenis_makanan' => $dataReq['jenis_makanan'],
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
            'stok' => $dataReq['stock'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Product created successfully.');
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
        // $this->authorize('update', $produk); // Di-nonaktifkan agar kasir bisa edit produk

        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        // $this->authorize('update', $produk); // Di-nonaktifkan agar kasir bisa update produk

        // Validasi input dari form
        $dataReq = $request->validate([
            'name' => 'required|string|max:255',
            'jenis_makanan' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'stock' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Otomatis kalikan 1000 jika user memasukkan angka satuan saat update
        $hargaBeli = $dataReq['purchase_price'] < 1000 ? $dataReq['purchase_price'] * 1000 : $dataReq['purchase_price'];
        $hargaJual = $dataReq['selling_price'] < 1000 ? $dataReq['selling_price'] * 1000 : $dataReq['selling_price'];

        // Mapping array data yang akan dimasukkan ke DB
        $data = [
            'user_id' => Auth::id(),
            'nama' => $dataReq['name'],
            'jenis_makanan' => $dataReq['jenis_makanan'],
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
            'stok' => $dataReq['stock'] ?? 0,
        ];

        // Jika user memilih/mengunggah foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika filenya ada di storage
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // Simpan foto baru ke folder storage/app/public/products
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        // Eksekusi update
        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        // $this->authorize('delete', $produk); // Di-nonaktifkan agar kasir bisa hapus produk

        try {
            // Eksekusi penghapusan di database dulu
            $produk->delete();

            // Hapus file foto HANYA jika record di database berhasil dihapus
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            return redirect()
                ->route('produk.index')
                ->with('success', 'Product deleted successfully.');

        } catch (QueryException $e) {
            // Tangkap Error Integrity Constraint Violation (SQLSTATE 23000 / MySQL error 1451)
            if ($e->getCode() === '23000' || (isset($e->errorInfo[1]) && $e->errorInfo[1] === 1451)) {
                return redirect()
                    ->route('produk.index')
                    ->with('error', 'Produk tidak dapat dihapus karena sudah memiliki riwayat transaksi penjualan!');
            }

            // Tangkap error database lainnya
            return redirect()
                ->route('produk.index')
                ->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}