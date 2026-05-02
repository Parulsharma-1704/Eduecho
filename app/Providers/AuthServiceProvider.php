<?php

namespace App\Providers;

use App\Models\Student;
use App\Models\Course;
use App\Models\IEP;
use App\Models\Assessment;
use App\Policies\StudentPolicy;
use App\Policies\CoursePolicy;
use App\Policies\IEPPolicy;
use App\Policies\AssessmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Student::class => StudentPolicy::class,
        Course::class => CoursePolicy::class,
        IEP::class => IEPPolicy::class,
        Assessment::class => AssessmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for common checks
        Gate::define('is-admin', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('is-educator', function ($user) {
            return $user->hasRole('special_educator');
        });

        Gate::define('is-therapist', function ($user) {
            return $user->hasRole('therapist');
        });

        Gate::define('is-student', function ($user) {
            return $user->hasRole('student');
        });

        Gate::define('is-care-giver', function ($user) {
            return $user->hasRole('care_giver');
        });
    }
}
