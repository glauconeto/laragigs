<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Retorna toda a lista completa
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::all()
        ]);
    }

    // Retorna apenas um item
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]); 
    }
}
