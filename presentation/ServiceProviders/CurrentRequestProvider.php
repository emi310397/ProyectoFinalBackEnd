<?php
//declare(strict_types=1);
//
//namespace Presentation\ServiceProviders;
//
//use Illuminate\Contracts\Support\DeferrableProvider;
//use Illuminate\Support\ServiceProvider;
//use Presentation\Interfaces\CurrentRequestInterface;
//use Presentation\Services\Request\CurrentRequest;
//
//class CurrentRequestProvider extends ServiceProvider implements DeferrableProvider
//{
//    public function register()
//    {
//        $this->app->singleton(CurrentRequestInterface::class, static function () {
//            return new CurrentRequest();
//        });
//    }
//
//    public function provides()
//    {
//        return [
//            CurrentRequestInterface::class,
//        ];
//    }
//}
