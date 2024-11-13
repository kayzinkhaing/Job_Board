<?php

namespace App\Providers;

use App\Models\Job;
use app\Policies\JobPolicy;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        // Employer::class => EmployerPolicy::class,
    ];
    public function boot(): void
    {
        //
    }
}
