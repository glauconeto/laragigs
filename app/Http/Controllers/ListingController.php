<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Termwind\Components\Li;

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
            'listings' => Listing::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(6)
        ]);
        // Paginate pode ser substituido por simplePaginate(), mudando apenas o estilo.
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

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    /**
     * Mostra o formulário de edição
     *
     * @param  mixed $listing
     * @return void
     */
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    /**
     * Atuaiza os dados da listagem, pegos pelo formulário 'edit'
     * 
     * @return void
     */
    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }
    
    /**
     * Método para deletar um item
     *
     * @param  mixed $listing
     * @return void
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted sucessfully');
    }
}
