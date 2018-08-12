<div class="col-md-4">
    <ul class="nav nav-pills flex-column">

        <li class="nav-item dropdown">
            <a class="nav-link text-right dropdown-toggle  active" href="#">سفارشات</a> 
            <div class="dropdown-menu show w-100" style="position: static;">
                <a class="dropdown-item text-right <?php echo e($active=='orders.create'?'active':''); ?>" href="<?php echo e(route('orders.create')); ?>">سفارش جدید</a>
                <a class="dropdown-item text-right <?php echo e($active=='orders.index'?'active':''); ?>" href="<?php echo e(route('orders.index')); ?>">لیست سفارشات</a>
                <a class="dropdown-item text-right <?php echo e($active=='orders.chart.today'?'active':''); ?>" href="<?php echo e(route('orders.chart', ['type' => 'today'])); ?>">نمودار سفارشات امروز</a>
                <a class="dropdown-item text-right <?php echo e($active=='orders.chart.month'?'active':''); ?>" href="<?php echo e(route('orders.chart', ['type' => 'month'])); ?>">نمودار سفارشات ماه جاری</a>
            </div>
        </li>
        <hr>
        <li class="nav-item dropdown">
            <a class="nav-link text-right dropdown-toggle active" href="#">محصولات</a> 
            <div class="dropdown-menu show w-100" style="position: static;">
                <a class="dropdown-item text-right <?php echo e($active=='products.index'?'active':''); ?>" href="<?php echo e(route('products.index')); ?>">لیست محصولات</a>
                <a class="dropdown-item text-right <?php echo e($active=='products.create'?'active':''); ?>" href="<?php echo e(route('products.create')); ?>">ایجاد گروه محصولات</a>
                <a class="dropdown-item text-right <?php echo e($active=='product-types.create'?'active':''); ?>" href="<?php echo e(route('product-types.create')); ?>">ایجاد زیر محصول</a>
            </div>
        </li>

    </ul>
</div>