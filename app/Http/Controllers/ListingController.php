<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Controller de listagem de itens
 */
class ListingController extends Controller
{
    /**
     * Retorna a lista completa
     * 
     * @return view
     */
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    /**
     * Retorna apenas um item
     * 
     * @return view
     * 
     */
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]); 
    }

    /**
     * Mostra o formulário de criação
     * 
     * @return view
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Armazena os dados da listagem, pegos pelo formulário 'create'
     * 
     * @return void
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }
}
