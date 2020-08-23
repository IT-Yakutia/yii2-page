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
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var ctx = document.getElementById('$canvas_id').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: $dataset,
        options: {
            responsive: true,
            // title: {
            //     display: true,
            //     text: 'Chart.js Line Chart'
            // },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        //labelString: 'Month'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        //labelString: 'Value'
                    }
                }]
            }
        }
    });
",$this::POS_READY); ?>