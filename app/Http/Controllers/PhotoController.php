<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PhotoController extends Controller
{
    public function index()
    {
        $response = Http::get('http://jsonplaceholder.typicode.com/photos');

        if ($response->ok())
        {
            return view('photos', ['senaraiPhotos' => json_decode($response->body())]);
        }
        else
        {
            return 'Error: ' . $response->status();
        }
    }
}
