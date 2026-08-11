<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">

    
    <?php if(session('errors')): ?>
        <div class="alert alert-danger mb-3">
            <?php echo e(session('errors')); ?>

        </div>
    <?php endif; ?>

    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-body p-4">

            
            <h1 class="h2 fw-bold mb-3" style="color: #4b3b43;">Halaman Penjualan</h1>

            
            <div class="mb-3">
                <a href="<?php echo e(route('penjualan.create')); ?>" class="btn fw-semibold" style="background-color: #eadbc8; color: #4b3b43; border: 1px solid #d6c5b0;">
                    + Tambah Penjualan
                </a>
            </div>

            
            <form action="<?php echo e(route('penjualan.index')); ?>" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="<?php echo e(request()->search); ?>"
                           class="form-control"
                           placeholder="Search penjualan">

                    <button class="btn btn-outline-secondary" type="submit">
                        Search
                    </button>
                </div>
            </form>

            
            <div class="table-responsive">
                <table class="table align-middle custom-compact-table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4%;">#</th>
                            <th scope="col" style="width: 18%;">Tanggal Transaksi</th>
                            <th scope="col" style="width: 22%;">Kasir</th>
                            <th scope="col" style="width: 18%;">Total Pembayaran</th>
                            <th scope="col" style="width: 15%;">Metode Pembayaran</th>
                            <th scope="col" style="width: 11%;">Status</th>
                            <th scope="col" style="width: 12%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <th scope="row"><?php echo e($sales->firstItem() + $loop->index); ?></th>
                            <td><?php echo e($sale->created_at->format('d-m-Y H:i:s')); ?></td>
                            <td><?php echo e($sale->user->name ?? '-'); ?></td>
                            <td>Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?></td>
                            <td><?php echo e($sale->metode_pembayaran); ?></td>
                            <td><?php echo e($sale->status); ?></td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-1">
                                    
                                    
                                    <?php if(strtoupper($sale->status) === 'COMPLETED'): ?>
                                        <a href="<?php echo e(route('penjualan.show', $sale)); ?>" 
                                           class="btn btn-action-sm fw-semibold text-white" 
                                           style="background-color: #84a98c; border-color: #84a98c;">
                                            Detail
                                        </a>

                                    
                                    <?php else: ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $sale)): ?>
                                            <a href="<?php echo e(route('penjualan.edit', $sale)); ?>" class="btn btn-action-sm btn-warning fw-semibold text-dark">
                                                Edit
                                            </a>
                                        <?php endif; ?>

                                        <?php if(auth()->user()->can('view', $sale) && auth()->user()->can('delete', $sale)): ?>
                                            <span class="text-muted small">|</span>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                                            <form action="<?php echo e(route('penjualan.destroy', $sale)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button class="btn btn-action-sm btn-danger fw-semibold"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">Data Tidak Ditemukan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-3 d-flex justify-content-end">
                <?php echo e($sales->links()); ?>

            </div>

        </div>
    </div>

</div>


<style>
    .custom-compact-table {
        font-size: 0.815rem; /* Ukuran font ~13px */
    }

    .custom-compact-table th,
    .custom-compact-table td {
        padding: 0.5rem 0.4rem !important; /* Jarak antar baris & kolom lebih rapat */
        white-space: nowrap;
    }

    .btn-action-sm {
        font-size: 0.72rem !important; /* Ukuran teks tombol aksi */
        padding: 0.15rem 0.45rem !important; /* Padding ringkas */
        line-height: 1.2;
        border-radius: 4px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POSKEYLA\resources\views/penjualan/index.blade.php ENDPATH**/ ?>