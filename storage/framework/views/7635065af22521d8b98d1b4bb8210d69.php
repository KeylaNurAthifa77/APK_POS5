<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    
    <?php if(session('errors')): ?>
        <div class="alert alert-danger mb-3 rounded-3">
            <?php echo e(session('errors')); ?>

        </div>
    <?php endif; ?>

    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-4">

            
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h1 class="h2 fw-bold m-0" style="color: #4b3b43;">
                    <?php echo e($mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan'); ?>

                </h1>
                
                
                <a href="<?php echo e(route('penjualan.index')); ?>" 
                   class="btn px-4 py-2 rounded-3 fw-semibold shadow-sm" 
                   style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                    Kembali
                </a>
            </div>

            <div class="row g-4">

                
                <div class="col-lg-6">

                    
                    <div class="mb-3">
                        <form method="GET" action="<?php echo e(route('penjualan.create')); ?>">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       value="<?php echo e(request('search')); ?>"
                                       class="form-control rounded-start-3"
                                       placeholder="Cari produk...">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>

                    
                    <div class="product-list" style="max-height: 480px; overflow-y: auto; padding-right: 5px;">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <form method="POST" action="<?php echo e(route('itempenjualan.store')); ?>" class="mb-2">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="sale_id" value="<?php echo e($sale->id); ?>">
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                                <div class="card border rounded-3 shadow-sm hover-shadow">
                                    <div class="card-body p-2 d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-3">
                                            <?php if($product->foto): ?>
                                                <img src="<?php echo e(asset('storage/'.$product->foto)); ?>"
                                                     class="rounded shadow-sm"
                                                     style="width:48px; height:48px; object-fit:cover;">
                                            <?php else: ?>
                                                <div class="rounded bg-light border d-flex align-items-center justify-content-center text-muted"
                                                     style="width:48px; height:48px; font-size:10px;">
                                                    No Img
                                                </div>
                                            <?php endif; ?>

                                            <div>
                                                <div class="fw-bold text-dark"><?php echo e($product->nama); ?></div>
                                                <small class="text-muted">
                                                    Rp <?php echo e(number_format($product->harga_jual < 1000 ? $product->harga_jual * 1000 : $product->harga_jual, 0, ',', '.')); ?>

                                                </small>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <input type="number"
                                                   name="quantity"
                                                   value="1"
                                                   min="1"
                                                   class="form-control form-control-sm text-center"
                                                   style="width: 55px;">

                                            
                                            <button type="submit" class="btn btn-sm text-white fw-bold px-3 rounded-3" style="background-color: #E87A5D; border: none;">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>

                
                <div class="col-lg-6">

                    <div class="p-3 rounded-4 bg-light border">

                        
                        <div class="table-responsive mb-3" style="max-height: 280px; overflow-y: auto;">
                            <table class="table table-borderless align-middle mb-0">
                                <thead>
                                    <tr class="border-bottom text-muted small">
                                        <th scope="col" style="width: 30%;">Produk</th>
                                        <th scope="col" class="text-center" style="width: 22%;">Harga</th>
                                        <th scope="col" class="text-center" style="width: 15%;">Qty</th>
                                        <th scope="col" class="text-end" style="width: 23%;">Subtotal</th>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                                            <th scope="col" class="text-center" style="width: 10%;">Aksi</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $hargaItem = $item->produk?->harga_jual ?? 0;
                                            $hargaFixed = $hargaItem < 1000 ? $hargaItem * 1000 : $hargaItem;
                                            $subtotalFixed = $item->subtotal < 1000 ? $item->subtotal * 1000 : $item->subtotal;
                                        ?>
                                        <tr>
                                            <td class="fw-medium text-dark text-truncate" style="max-width: 110px;">
                                                <?php echo e($item->produk?->nama ?? 'Produk Dihapus'); ?>

                                            </td>

                                            <td class="text-center text-muted small">
                                                Rp <?php echo e(number_format($hargaFixed, 0, ',', '.')); ?>

                                            </td>

                                            <td class="text-center">
                                                <form method="POST" action="<?php echo e(route('itempenjualan.update', $item->id)); ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PUT'); ?>
                                                    <input type="number"
                                                           name="quantity"
                                                           value="<?php echo e($item->kuantitas); ?>"
                                                           min="1"
                                                           class="form-control form-control-sm text-center mx-auto px-1"
                                                           style="width: 55px;"
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>

                                            <td class="text-end fw-bold" style="color: #E87A5D;">
                                                Rp <?php echo e(number_format($subtotalFixed, 0, ',', '.')); ?>

                                            </td>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                                                <td class="text-center">
                                                    <form method="POST" action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-danger btn-sm py-1 px-2 fw-bold" style="font-size: 11px;">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="<?php echo e(Auth::user()->can('delete', $sale) ? 5 : 4); ?>" class="text-center text-muted py-4">
                                                Keranjang masih kosong
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">

                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fs-5 fw-bold text-dark">Total</span>
                            <span class="fs-4 fw-bold" style="color: #E87A5D;">
                                Rp <?php echo e(number_format($sale->total_pembayaran < 1000 ? $sale->total_pembayaran * 1000 : $sale->total_pembayaran, 0, ',', '.')); ?>

                            </span>
                        </div>

                        
                        <form method="POST"
                              action="<?php echo e(route('penjualan.update', $sale->id)); ?>"
                              onsubmit="return confirm('Yakin ingin checkout?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="mb-3">
                                <select name="payment_method" class="form-select rounded-3" required>
                                    <option value="" disabled <?php echo e(empty($sale->metode_pembayaran) ? 'selected' : ''); ?>>Pilih Pembayaran</option>
                                    <option value="CASH" <?php if($sale->metode_pembayaran === 'CASH'): echo 'selected'; endif; ?>>Cash</option>
                                    <option value="QRIS" <?php if($sale->metode_pembayaran === 'QRIS'): echo 'selected'; endif; ?>>QRIS</option>
                                </select>
                            </div>

                            
                            <button type="submit" class="btn text-white fw-bold w-100 py-2 rounded-3 shadow-sm" style="background-color: #E87A5D; border: none;">
                                Checkout
                            </button>
                        </form>

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                            <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                                  class="mt-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit" class="btn fw-bold w-100 py-2 rounded-3" style="background-color: #F3E8E8; color: #6C5F67; border: none;">
                                    Batalkan Transaksi
                                </button>
                            </form>
                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POSKEYLA\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>