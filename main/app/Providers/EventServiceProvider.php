<?php

namespace App\Providers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Jobs\TestJob;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //\App::bindMethod(TestJob::class.'@handle', fn($job) => $job->handle());
        \App::bindMethod(ProductCreated::class.'@handle', fn($job) => $job->handle());
        \App::bindMethod(ProductUpdated::class.'@handle', fn($job) => $job->handle());
        \App::bindMethod(ProductDeleted::class.'@handle', fn($job) => $job->handle());
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
