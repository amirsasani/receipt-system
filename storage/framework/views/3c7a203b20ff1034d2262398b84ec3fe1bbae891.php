<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('layout.sidebar', ['active' => 'product-types.create'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

            <form method="POST" action="<?php echo e(route('product-types.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="name" class="d-block text-right">نام محصول</label>
                    <input type="text" class="form-control text-right" name="name" id="name" value="<?php echo e(old('name')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="name" class="d-block text-right">گروه محصول</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($product->id); ?>" <?php echo e(old('product_id')==$product->id?'selected':''); ?>><?php echo e($product->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="d-block text-right">قیمت محصول</label>
                    <input type="text" class="form-control text-right" name="price" id="price" value="<?php echo e(old('price')); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description" class="d-block text-right">توضیح کوتاه محصول</label>
                    <input type="text" class="form-control text-right" name="description" id="description" value="<?php echo e(old('description')?old('description'):'بدون توضیح'); ?>">
                </div>

                <button type="submit" class="btn btn-outline-success">ثبت زیر محصول</button>
            </form>
        </div>
    </div>
</div>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>