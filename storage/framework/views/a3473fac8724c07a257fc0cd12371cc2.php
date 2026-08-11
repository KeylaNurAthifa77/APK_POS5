<?php echo csrf_field(); ?>


<div class="row mb-3">
    <?php if(!empty($produk->foto)): ?>
        <div class="col-md-6 mb-2">
            <label class="form-label fw-semibold">Foto Saat Ini</label><br>
            <img src="<?php echo e(asset('storage/' . $produk->foto)); ?>"
                 alt="Foto Produk"
                 class="img-thumbnail rounded"
                 style="max-height:120px;object-fit:cover;">
        </div>
    <?php endif; ?>

    <div class="col-md-6 mb-2" id="preview-container" style="display:none;">
        <label class="form-label fw-semibold">Preview Foto Baru</label><br>
        <img id="preview"
             class="img-thumbnail rounded"
             style="max-height:120px;object-fit:cover;">
    </div>
</div>


<div class="mb-3">
    <label for="foto" class="form-label fw-semibold">Gambar</label>
    <input
        type="file"
        id="foto"
        name="foto"
        onchange="previewImage(this)"
        class="form-control <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">

    <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="name" class="form-label fw-semibold">Nama Produk</label>
    <input
        type="text"
        id="name"
        name="name"
        class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        value="<?php echo e(old('name', $produk->nama ?? '')); ?>">

    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="jenis_makanan" class="form-label fw-semibold">
        Jenis Makanan
    </label>

    <select
        id="jenis_makanan"
        name="jenis_makanan"
        class="form-select <?php $__errorArgs = ['jenis_makanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        required>

        <option value="">-- Pilih Jenis Makanan --</option>

        <option value="Makanan Berat"
            <?php echo e(old('jenis_makanan', $produk->jenis_makanan ?? '') == 'Makanan Berat' ? 'selected' : ''); ?>>
            Makanan Berat
        </option>

        <option value="Makanan Ringan"
            <?php echo e(old('jenis_makanan', $produk->jenis_makanan ?? '') == 'Makanan Ringan' ? 'selected' : ''); ?>>
            Makanan Ringan
        </option>

        <option value="Minuman"
            <?php echo e(old('jenis_makanan', $produk->jenis_makanan ?? '') == 'Minuman' ? 'selected' : ''); ?>>
            Minuman
        </option>

    </select>

    <?php $__errorArgs = ['jenis_makanan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="purchase_price" class="form-label fw-semibold">Harga Beli</label>
    <input
        type="number"
        id="purchase_price"
        name="purchase_price"
        class="form-control <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        value="<?php echo e(old('purchase_price', $produk->harga_beli ?? '')); ?>">

    <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="selling_price" class="form-label fw-semibold">Harga Jual</label>
    <input
        type="number"
        id="selling_price"
        name="selling_price"
        class="form-control <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        value="<?php echo e(old('selling_price', $produk->harga_jual ?? '')); ?>">

    <?php $__errorArgs = ['selling_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="stock" class="form-label fw-semibold">Stok</label>
    <input
        type="number"
        id="stock"
        name="stock"
        class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        value="<?php echo e(old('stock', $produk->stok ?? '')); ?>">

    <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="d-flex align-items-center gap-2 mt-4">
    <button type="submit" class="btn text-white px-4 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: #E87A5D; border: none;">
        Simpan
    </button>

    <a href="<?php echo e(route('produk.index')); ?>" class="btn px-4 py-2 rounded-3 fw-semibold" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
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
</script><?php /**PATH C:\laragon\www\APK_POSKEYLA\resources\views/produk/_form.blade.php ENDPATH**/ ?>