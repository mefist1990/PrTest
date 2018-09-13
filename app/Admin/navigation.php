<?php
use SleepingOwl\Admin\Navigation\Page;




return [


    [


        'title' => 'Тесты',
        'icon' => 'fa fa-database',
        'priority' => '2000',
        'pages' => [

            (new Page(\App\Categories::class))
                ->setIcon('fa fa-table')
                ->setPriority(100),
            (new Page(\App\Issues::class))
                ->setIcon('fa fa-table')
                ->setPriority(200),
            (new Page(\App\Professions::class))
                ->setIcon('fa fa-table')
                ->setPriority(200),
                    ]



    ]



];