@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container py-4">

    {{-- Card Container Pembungkus --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mx-auto" style="max-width: 800px;">
        <div class="card-body p-4">

            {{-- Judul Halaman --}}
            <h1 class="h2 fw-bold mb-4" style="color: #4b3b43;">Tambah Produk</h1>

            {{-- Form Tambah Produk --}}
            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- 1. Gambar --}}
                <div class="mb-3">
                    <label for="foto" class="form-label fw-semibold">Gambar</label>

                    {{-- Pratinjau Gambar di atas kolom (Awalnya Tersembunyi) --}}
                    <div class="mb-3 d-none" id="previewContainer">
                        <p class="text-muted small mb-1">Pratinjau Foto:</p>
                        <img id="imgPreview" 
                             src="#" 
                             alt="Pratinjau Gambar" 
                             class="img-thumbnail rounded-3 shadow-sm" 
                             style="max-height: 150px; object-fit: cover;">
                    </div>

                    {{-- Input File --}}
                    <input type="file"
                           class="form-control @error('foto') is-invalid @enderror"
                           id="foto"
                           name="foto"
                           accept="image/*"
                           onchange="previewImage(event)">

                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 2. Nama Produk --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Produk</label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Masukkan nama produk"
                           required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 3. Jenis Makanan --}}
                <div class="mb-3">
                    <label for="jenis_makanan" class="form-label fw-semibold">
                        Jenis Makanan
                    </label>

                    <select
                        class="form-select @error('jenis_makanan') is-invalid @enderror"
                        id="jenis_makanan"
                        name="jenis_makanan"
                        required>

                        <option value="">-- Pilih Jenis Makanan --</option>

                        <option value="Makanan Berat"
                            {{ old('jenis_makanan') == 'Makanan Berat' ? 'selected' : '' }}>
                            Makanan Berat
                        </option>

                        <option value="Makanan Ringan"
                            {{ old('jenis_makanan') == 'Makanan Ringan' ? 'selected' : '' }}>
                            Makanan Ringan
                        </option>

                        <option value="Minuman"
                            {{ old('jenis_makanan') == 'Minuman' ? 'selected' : '' }}>
                            Minuman
                        </option>

                    </select>

                    @error('jenis_makanan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 4. Harga Beli --}}
                <div class="mb-3">
                    <label for="purchase_price" class="form-label fw-semibold">Harga Beli</label>
                    <input type="number"
                           class="form-control @error('purchase_price') is-invalid @enderror"
                           id="purchase_price"
                           name="purchase_price"
                           value="{{ old('purchase_price') }}"
                           placeholder="Masukkan harga beli"
                           required>

                    @error('purchase_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 5. Harga Jual --}}
                <div class="mb-3">
                    <label for="selling_price" class="form-label fw-semibold">Harga Jual</label>
                    <input type="number"
                           class="form-control @error('selling_price') is-invalid @enderror"
                           id="selling_price"
                           name="selling_price"
                           value="{{ old('selling_price') }}"
                           placeholder="Masukkan harga jual"
                           required>

                    @error('selling_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- 6. Stok --}}
                <div class="mb-4">
                    <label for="stock" class="form-label fw-semibold">Stok</label>
                    <input type="number"
                           class="form-control @error('stock') is-invalid @enderror"
                           id="stock"
                           name="stock"
                           value="{{ old('stock') }}"
                           placeholder="Masukkan jumlah stok">

                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Tombol (Simpan & Kembali) --}}
                <div class="d-flex align-items-center gap-2">
                    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #E87A5D; border: none;">
                        Simpan
                    </button>

                    <a href="{{ route('produk.index') }}" class="btn px-4 py-2 rounded-3 fw-semibold" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- Script JS Preview Gambar Instan --}}
<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('previewContainer');
        const imgPreview = document.getElementById('imgPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
@endsection