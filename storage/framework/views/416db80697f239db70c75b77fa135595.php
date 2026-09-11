 

<?php $__env->startSection('title', 'Manajemen Produk'); ?> 

<?php $__env->startSection('content'); ?> 
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> 

<div class="container my-5">
    <div class="row align-items-center mb-4 g-3">
        <div class="col-md-6">
            <h2 class="text-dark fw-bold m-0 fs-3 tracking-tight">Halaman Produk</h2>
            <p class="text-muted mb-0 small">Kelola daftar produk, stok, harga jual, dan harga beli.</p>
        </div>
        <div class="col-md-6 text-md-end">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?> 
                <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm fw-semibold">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Produk
                </a> 
            <?php endif; ?> 
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3">
            <form action="<?php echo e(route('produk.index')); ?>" method="GET" class="row g-2 align-items-center"> 
                <div class="col-md-6 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" 
                               name="search" 
                               value="<?php echo e(request('search')); ?>" 
                               class="form-control border-start-0 ps-0 bg-transparent" 
                               placeholder="Cari nama produk...">
                        <?php if(request('search')): ?>
                            <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-outline-secondary border-start-0 text-muted" type="button">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        <?php endif; ?>
                        <button class="btn btn-primary px-4 fw-semibold" type="submit">Cari</button> 
                    </div> 
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0"> 
                <thead class="bg-light text-uppercase fs-7 text-secondary fw-bold border-bottom"> 
                    <tr> 
                        <th scope="col" class="ps-4 py-3" style="width: 5%">#</th> 
                        <th scope="col" class="py-3" style="width: 10%">Foto</th> 
                        <th scope="col" class="py-3">Nama Produk</th> 
                        <th scope="col" class="py-3">Diinput Oleh</th> 
                        <th scope="col" class="py-3">Harga Beli</th> 
                        <th scope="col" class="py-3">Harga Jual</th> 
                        <th scope="col" class="py-3" style="width: 12%">Stok</th> 
                        <th scope="col" class="text-end pe-4 py-3" style="width: 20%">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody class="border-top-0"> 
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
                    <tr> 
                        <td class="ps-4 fw-semibold text-muted fs-7">
                            <?php echo e($products->firstItem() + $loop->index); ?>

                        </td> 

                        <td class="py-3"> 
                            <?php if($product->foto): ?>
                                <img src="<?php echo e(asset('storage/' . $product->foto)); ?>" 
                                     alt="<?php echo e($product->nama); ?>"
                                     width="50" 
                                     height="50"
                                     class="rounded-3 object-fit-cover border shadow-2xs"> 
                            <?php else: ?>
                                <div class="bg-light rounded-3 d-flex align-items-center justify-content-center border text-muted" style="width: 50px; height: 50px;">
                                    <i class="bi bi-image fs-5"></i>
                                </div>
                            <?php endif; ?>
                        </td> 

                        <td class="fw-bold text-dark"><?php echo e($product->nama); ?></td> 

                        <td>
                            <span class="badge bg-light text-secondary border px-2.5 py-1.5 rounded-pill fw-normal">
                                <i class="bi bi-person me-1"></i> <?php echo e($product->user->name ?? 'System'); ?>

                            </span>
                        </td> 

                        <td class="text-secondary">
                            Rp <?php echo e(number_format($product->harga_beli, 0, ',', '.')); ?>

                        </td> 

                        <td class="fw-semibold text-dark">
                            Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

                        </td> 

                        <td>
                            <?php if($product->stok > 0): ?>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-medium">
                                    <i class="bi bi-box-seam me-1"></i> <?php echo e($product->stok); ?> Pcs
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-medium">
                                    <i class="bi bi-exclamation-triangle me-1"></i> Habis
                                </span>
                            <?php endif; ?>
                        </td> 

                        <td class="text-end pe-4"> 
                            <div class="btn-group gap-1">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $product)): ?> 
                                    <a href="<?php echo e(route('produk.show', $product)); ?>" 
                                       class="btn btn-sm btn-light text-primary border shadow-2xs rounded-2 px-2.5" 
                                       title="Detail"> 
                                        <i class="bi bi-eye"></i> Detail
                                    </a> 
                                <?php endif; ?> 

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?> 
                                    <a href="<?php echo e(route('produk.edit', $product)); ?>" 
                                       class="btn btn-sm btn-light text-warning border shadow-2xs rounded-2 px-2.5" 
                                       title="Edit"> 
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a> 
                                <?php endif; ?> 

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?> 
                                    <form action="<?php echo e(route('produk.destroy', $product)); ?>" method="POST" class="d-inline"> 
                                        <?php echo csrf_field(); ?> 
                                        <?php echo method_field('DELETE'); ?> 
                                        <button class="btn btn-sm btn-light text-danger border shadow-2xs rounded-2 px-2.5" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"> 
                                            <i class="bi bi-trash"></i> Hapus
                                        </button> 
                                    </form> 
                                <?php endif; ?> 
                            </div>
                        </td> 
                    </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> 
                    <tr> 
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 d-block mb-2 text-secondary opacity-50"></i>
                            <span>Data produk tidak ditemukan.</span>
                        </td> 
                    </tr> 
                    <?php endif; ?> 
                </tbody> 
            </table> 
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <?php echo e($products->links()); ?> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS\resources\views/produk/index.blade.php ENDPATH**/ ?>