<?php

namespace App\Http\Controllers;

use App\Interfaces\MusicServiceInterface;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        dd(app(MusicServiceInterface::class),app(MusicServiceInterface::class),app(MusicServiceInterface::class));
        $contact=Contact::with('user')->latest()->first();
        return $contact;
    }
}
