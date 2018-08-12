<script type="text/javascript">
    function <?php echo e($chart->id); ?>_create(data) {
        <?php echo e($chart->id); ?>_rendered = true;
        var loader_element = document.getElementById("<?php echo e($chart->id); ?>_loader");
        loader_element.parentNode.removeChild(loader_element);
        document.getElementById("<?php echo e($chart->id); ?>").style.display = 'block';
        window.<?php echo e($chart->id); ?> = new Chart(document.getElementById("<?php echo e($chart->id); ?>").getContext("2d"), {
            type: <?php echo e($chart->type ? "'{$chart->type}'" : 'data[0].type'); ?>,
            data: {
                labels: <?php echo $chart->formatLabels(); ?>,
                datasets: data
            },
            options: <?php echo $chart->formatOptions(true); ?>

        });
    }
    <?php echo $__env->make('charts::init', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</script>
