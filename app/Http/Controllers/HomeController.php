<?php

namespace App\Http\Controllers;

use App\Services\InstagramService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected InstagramService $instagram;
    
    public function __construct(InstagramService $instagram)
    {
        $this->instagram = $instagram;
    }
    
    /**
     * Display the home page
     */
    public function index()
    {
        $media = $this->instagram->getUserMedia(12);
        
        return view('home', [
            'instagramMedia' => $media,
        ]);
    }
}

