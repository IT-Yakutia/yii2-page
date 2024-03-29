<?php

namespace uraankhayayaal\page\widgets\page_chart;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ChartAsset extends AssetBundle
{
    public $css = [
        [
            'href' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css',
            'integrity' => 'sha512-/zs32ZEJh+/EO2N1b0PEdoA10JkdC3zJ8L5FTiQu82LR9S/rOQNfQN7U59U9BC12swNeRAz3HSzIL2vpp4fv3w==',
            'crossorigin' => 'anonymous',
        ],
    ];
    public $js = [
        [
            'src' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js',
            'integrity' => 'sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==',
            'crossorigin' => 'anonymous',
        ],
    ];
}
