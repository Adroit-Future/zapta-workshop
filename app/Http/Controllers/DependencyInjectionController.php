<?php

namespace App\Http\Controllers;

use App\Interfaces\MusicServiceInterface;
use Illuminate\Http\Request;
use App\Services\SpotifyService;

class DependencyInjectionController extends Controller
{
    public function index(){
        app()->bind(MusicServiceInterface::class, function () {
                return new SpotifyService('12234');
            });

            // dd(app(MusicServiceInterface::class));

            dd($this->play2());
    }

    public function play2(){
        $contact=new ContactController();
        return $contact->index();
    }
}
