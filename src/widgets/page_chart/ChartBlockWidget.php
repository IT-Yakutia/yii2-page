<?php

namespace uraankhayayaal\page\widgets\page_chart;

use yii\base\Widget;

class ChartBlockWidget extends Widget {
    public $data;

    public function run() {

        return $this->render('index', [
            'title' => $this->data['title'],
            'data' => $this->data['data'],
        ]);
    }

    public $type = 'bar'; // line, pie, bar
    // public $data = [
    //     20,
    //     10
    // ];
    
    /*
     * For `bar` chart example data
     */
    public $dataset = [
        'labels' => [
            // имена колонок
            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange' // labels count must be equals dataset[data] items count 
        ],
        'datasets' => [
            [
                // title chart
                'label' => '# of Votes',
                // цветов должно быть столько же, сколько колонок
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                // цвета границы
                'borderColor' =>  [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                'borderWidth' => 1,
                // данные колонок
                'data' => [
                    19, 19, 3, 5, 2, 3
                ]
            ]
        ]
    ];

    /*
     * For `pie` chart example data
     */
    /*public $dataset = [
        'labels' => [
            'Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange' // labels count must be equals dataset[data] items count
        ],
        'datasets' => [
            [
                'label' => '# of Votes',
                'backgroundColor' => [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                'borderColor' =>  [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                'borderWidth' => 1,
                'data' => [
                    10, 20, 30, 23, 1, 0.5
                ]
            ]
        ]
    ];*/

    /*
     * For `line` chart example data
     */
    /*public $dataset = [
        'labels' => [
            'January', 'February', 'March', 'April', 'May', 'June', 'July' // labels count must be equals dataset[data] items count
        ],
        'datasets' => [
            [
                'label' => '# of Votes',
                'backgroundColor' => '#f00',
                'borderColor' => '#f00',
                'fill' => false,
                'data' => [
                    ["x" => 1, "y" => 30],
                    ["x" => 2, "y" => 20],
                    ["x" => 3, "y" => 40],
                    ["x" => 4, "y" => 30],
                    ["x" => 5, "y" => 10],
                    ["x" => 6, "y" => 40],
                    ["x" => 7, "y" => 50],
                ]
            ],
            [
                'label' => 'My Second dataset',
                'backgroundColor' => '#00f',
                'borderColor' => '#00f',
                'fill' => false,
                'data' => [
                    ["x" => 1, "y" => 50],
                    ["x" => 2, "y" => 40],
                    ["x" => 3, "y" => 20],
                    ["x" => 4, "y" => 30],
                    ["x" => 5, "y" => 20],
                    ["x" => 6, "y" => 10],
                    ["x" => 7, "y" => 0],
                ]
            ],
        ]
    ]; */

    public function init() {
        ChartAsset::register( $this->getView() );
        parent::init();
    }
}