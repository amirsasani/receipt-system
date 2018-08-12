<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('layout.sidebar', ['active' => 'products.create'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="col-md-8">
    <div class="tab-content">
        <div class="tab-pane container active">
            <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="text-right"><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('products.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="name" class="d-block text-right">نام محصول</label>
                    <input type="text" class="form-control text-right" name="name" id="name" value="<?php echo e(old('name')); ?>" required>                    <?php if(session()->has('error') && session('error') == 'duplicate'): ?>
                    <p class="text-danger text-right">نام محصول نمی تواند تکراری باشد</p> <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-outline-success">ثبت محصول</button>
            </form>
        </div>
    </div>
</div>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>