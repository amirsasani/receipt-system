<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" href="/css/scrolling-tabs.css">
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />
    <?php echo $__env->make('layout.sidebar', ['active' => 'orders.create'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

            <form id="orderForm" method="POST" action="<?php echo e(route('orders.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="row justify-content-between align-items-center mb-5">
                    <div>
                        <span class="font-weight-bold">قیمت کل: </span>
                        <span id="totalPrice">0</span>
                        <span>تومان</span>
                    </div>
                    <div class="btn-group ltr">
                        <button type="submit" class="btn btn-success">ثبت سفارش</button>
                        <a id="calculate_price" class="btn btn-outline-info">محاسبه قیمت</a>
                    </div>
                </div>

                <nav class="tabbable">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a class="nav-item nav-link <?php echo e($loop->first?'active':''); ?>" data-toggle="tab" href="#product-<?php echo e($product->id); ?>" role="tab">
                                <?php echo e($product->name); ?>

                            </a> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </nav>
                <div class="tab-content pt-2" id="nav-tabContent">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tab-pane fade show <?php echo e($loop->first?'active':''); ?>" id="product-<?php echo e($product->id); ?>" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">نام کالا</th>
                                    <th class="text-center">قیمت واحد</th>
                                    <th class="text-center w-25">تعداد سفارش</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $product->productTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-right"><?php echo e($productType->name); ?></td>
                                    <td class="text-right"><?php echo e(number_format($productType->price)); ?></td>
                                    <td class="text-right">
                                        <input type="number" class="form-control productTypes" name="<?php echo e($productType->id); ?>" value="<?php echo e(old('$productType->id')?old('$productType->id'):0); ?>"
                                            min="0" oninput="validity.valid||(value='');">
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">نام کالا</th>
                                    <th class="text-center">قیمت واحد</th>
                                    <th class="text-center">تعداد سفارش</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </form>
        </div>
    </div>
</div>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>
<script>
    $(function(){
        $("#calculate_price").on('click', function(e) {

            axios.post('/orders/total-price', {
                productTypes: $('input.productTypes').serializeArray()
                })
                .then(function (response) {
                     $('#totalPrice').text(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });

        });

        $('#orderForm').submit(function(e){
            e.preventDefault();
            axios.post($('#orderForm').prop('action'), {
                productTypes: $('input.productTypes').serializeArray()
                })
                .then(function (response) {
                    console.log(response.data);
                    window.location.href = $('#orderForm').prop('action');
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $('.table').DataTable({
            'language':{
                'url': '/DataTables/persian.lang.json',
            },
        });
    });

</script>