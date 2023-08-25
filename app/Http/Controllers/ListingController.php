<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    // Retorna a lista completa
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
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
