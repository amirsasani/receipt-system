<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css" />
    <?php echo $__env->make('layout.sidebar', ['active' => 'products.index'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="col-md-8">
    <div class="tab-content">
        <div class="tab-pane container active">
            <table id="table" class="table table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th class="text-center">نام گروه محصول</th>
                        <th class="text-center">تعداد زیرگروه</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-right"><?php echo e($product->name); ?></td>
                        <td class="text-right"><?php echo e($product->productTypes()->count()); ?></td>
                        <td class="text-right">
                            <form action="<?php echo e(route('products.destroy', $product)); ?>" method="post" class="d-inline-block">
                                <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">نام گروه محصول</th>
                        <th class="text-center">تعداد زیرگروه</th>
                        <th class="text-center"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript" src="/DataTables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table').DataTable({
            'language':{
                'url': '/DataTables/persian.lang.json'
            }
        });
    });

</script>