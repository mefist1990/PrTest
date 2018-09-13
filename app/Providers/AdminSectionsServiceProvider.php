<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
                         \App\Categories::class       => 'App\Admin\Http\Sections\Categories',
                         \App\Issues::class       => 'App\Admin\Http\Sections\Issues',
                         \App\Professions::class       => 'App\Admin\Http\Sections\Professions',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
