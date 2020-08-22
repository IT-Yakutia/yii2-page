<?php

$canvas_id = "asdasd";

?>

<div class="row">
    <div class="col">
        <h3><?= $chart_title ?></h3>
    </div>
</div>

<div class="row">
    <div class="col">
        <canvas id="<?= $canvas_id ?>" width="400" height="200"></canvas>
    </div>
</div>


<?php $dataset = json_encode($data); ?>
<?php $this->registerJs("
    var ctx = document.getElementById('$canvas_id').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: $dataset,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
",$this::POS_READY); ?>