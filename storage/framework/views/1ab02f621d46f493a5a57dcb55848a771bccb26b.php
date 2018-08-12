<?php echo $__env->make('layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php if($type == 'today'): ?>
    <?php echo $__env->make('layout.sidebar', ['active' => 'orders.chart.today'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php elseif($type
== 'month'): ?>
    <?php echo $__env->make('layout.sidebar', ['active' => 'orders.chart.month'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php endif; ?>
<div class="col">
    <?php echo $chart->container(); ?>

</div>
    <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="/js/chart.min.js"></script>
<?php echo $chart->script(); ?>