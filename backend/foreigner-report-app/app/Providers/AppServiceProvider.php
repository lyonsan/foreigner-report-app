<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(App\Services\ReportService::class);

        $this->app->bind(
            \App\Repositories\Report\ReportRepositoryInterface::class,
            \App\Repositories\Report\ReportRepository::class
        );
        $this->app->bind(
            \App\Repositories\MSubjectReport\MSubjectReportRepositoryInterface::class,
            \App\Repositories\MSubjectReport\MSubjectReportRepository::class
        );
        $this->app->bind(
            \App\Repositories\MSubject\MSubjectRepositoryInterface::class,
            \App\Repositories\MSubject\MSubjectRepository::class
        );
        $this->app->bind(
            \App\Repositories\ReportText\ReportTextRepositoryInterface::class,
            \App\Repositories\ReportText\ReportTextRepository::class
        );
        $this->app->bind(
            \App\Repositories\TextInfo\TextInfoRepositoryInterface::class,
            \App\Repositories\TextInfo\TextInfoRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
