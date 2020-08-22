<?php

namespace frontend\themes\basic\widgets\page_chart;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ChartAsset extends AssetBundle
{
    public $css = [
        // [
        //     //'rel' => 'stylesheet',
        //     'href' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css',
        //     'integrity' => 'sha512-SUJFImtiT87gVCOXl3aGC00zfDl6ggYAw5+oheJvRJ8KBXZrr/TMISSdVJ5bBarbQDRC2pR5Kto3xTR0kpZInA==',
        //     'crossorigin' => 'anonymous',
        // ],
        [
            //'rel' => 'stylesheet',
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
        // [
        //     'src' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js',
        //     'integrity' => 'sha512-G8JE1Xbr0egZE5gNGyUm1fF764iHVfRXshIoUWCTPAbKkkItp/6qal5YAHXrxEu4HNfPTQs6HOu3D5vCGS1j3w==',
        //     'crossorigin' => 'anonymous',
        // ],
        // [
        //     'src' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js',
        //     'integrity' => 'sha512-vBmx0N/uQOXznm/Nbkp7h0P1RfLSj0HQrFSzV8m7rOGyj30fYAOKHYvCNez+yM8IrfnW0TCodDEjRqf6fodf/Q==',
        //     'crossorigin' => 'anonymous',
        // ],
        // [
        //     'src' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js',
        //     'integrity' => 'sha512-QEiC894KVkN9Tsoi6+mKf8HaCLJvyA6QIRzY5KrfINXYuP9NxdIkRQhGq3BZi0J4I7V5SidGM3XUQ5wFiMDuWg==',
        //     'crossorigin' => 'anonymous',
        // ],
    ];
}
