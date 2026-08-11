@csrf

{{-- Row Foto Saat Ini & Preview Foto Baru --}}
<div class="row mb-3">
    @if (!empty($produk->foto))
        <div class="col-md-6 mb-2">
            <label class="form-label fw-semibold">Foto Saat Ini</label><br>
            <img src="{{ asset('storage/' . $produk->foto) }}"
                 alt="Foto Produk"
                 class="img-thumbnail rounded"
                 style="max-height:120px;object-fit:cover;">
        </div>
    @endif

    <div class="col-md-6 mb-2" id="preview-container" style="display:none;">
        <label class="form-label fw-semibold">Preview Foto Baru</label><br>
        <img id="preview"
             class="img-thumbnail rounded"
             style="max-height:120px;object-fit:cover;">
    </div>
</div>

{{-- Upload Gambar --}}
<div class="mb-3">
    <label for="foto" class="form-label fw-semibold">Gambar</label>
    <input
        type="file"
        id="foto"
        name="foto"
        onchange="previewImage(this)"
        class="form-control @error('foto') is-invalid @enderror">

    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Nama Produk --}}
<div class="mb-3">
    <label for="name" class="form-label fw-semibold">Nama Produk</label>
    <input
        type="text"
        id="name"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $produk->nama ?? '') }}">

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Jenis Makanan --}}
<div class="mb-3">
    <label for="jenis_makanan" class="form-label fw-semibold">
        Jenis Makanan
    </label>

    <select
        id="jenis_makanan"
        name="jenis_makanan"
        class="form-select @error('jenis_makanan') is-invalid @enderror"
        required>

        <option value="">-- Pilih Jenis Makanan --</option>

        <option value="Makanan Berat"
            {{ old('jenis_makanan', $produk->jenis_makanan ?? '') == 'Makanan Berat' ? 'selected' : '' }}>
            Makanan Berat
        </option>

        <option value="Makanan Ringan"
            {{ old('jenis_makanan', $produk->jenis_makanan ?? '') == 'Makanan Ringan' ? 'selected' : '' }}>
            Makanan Ringan
        </option>

        <option value="Minuman"
            {{ old('jenis_makanan', $produk->jenis_makanan ?? '') == 'Minuman' ? 'selected' : '' }}>
            Minuman
        </option>

    </select>

    @error('jenis_makanan')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Harga Beli --}}
<div class="mb-3">
    <label for="purchase_price" class="form-label fw-semibold">Harga Beli</label>
    <input
        type="number"
        id="purchase_price"
        name="purchase_price"
        class="form-control @error('purchase_price') is-invalid @enderror"
        value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">

    @error('purchase_price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Harga Jual --}}
<div class="mb-3">
    <label for="selling_price" class="form-label fw-semibold">Harga Jual</label>
    <input
        type="number"
        id="selling_price"
        name="selling_price"
        class="form-control @error('selling_price') is-invalid @enderror"
        value="{{ old('selling_price', $produk->harga_jual ?? '') }}">

    @error('selling_price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Stok --}}
<div class="mb-3">
    <label for="stock" class="form-label fw-semibold">Stok</label>
    <input
        type="number"
        id="stock"
        name="stock"
        class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $produk->stok ?? '') }}">

    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Tombol Akses (Simpan & Kembali) --}}
<div class="d-flex align-items-center gap-2 mt-4">
    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #E87A5D; border: none;">
        Simpan
    </button>

    <a href="{{ route('produk.index') }}" class="btn px-4 py-2 rounded-3 fw-semibold" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
        Kembali
    </a>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const container = document.getElementById('preview-container');

    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
}
</script>