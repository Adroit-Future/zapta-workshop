<?php

namespace App\Providers;

use App\Actions\Car1;
use App\Actions\Gas;
use App\Interfaces\MusicServiceInterface;
use App\Services\SoundCloudService;
use App\Services\SpotifyService;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('foo',function(){
            return new Request();
        });

        $this->app->bind(Car1::class,function(){
            return new Car1(new Gas(),40);
        });

        // // Case 1
        // $this->app->bind(MusicServiceInterface::class, function () {
        //     return new SpotifyService('12234');
        // });

        // $this->app->singleton(MusicServiceInterface::class, function () {
        //     return new SoundCloudService('12234');
        // });

        $this->app->when(OnlineMusicController::class)
        ->needs(MusicServiceInterface::class)
        ->give(function () {
            return new SpotifyService(env('SPOTIFY_API_KEY'));
        });

        $this->app->when(OfflineMusicController::class)
        ->needs(MusicServiceInterface::class)
        ->give(function () {
            return new SoundCloudService(env('SOUNDCLOUD_API_KEY'));
        });
    }
}
