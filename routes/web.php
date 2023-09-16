<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/hello', function () {
//     return response('Hello world', 200)
//             ->header('Content-Type', 'text/plain')
//             ->header('foo', 'bar');
// });

// Route::get('/posts/{id}', function ($id) {
//     ddd($id);
//     return response('Post ', $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request) {
//     return$request->name . ', ' . $request->city;
// });

// Padrão de Rotas de recursos:
// index - Mostra todas os itens
// show - Requisitar apenas um item
// create - Criar um novo item a partir de um formulário
// store - Armazena um novo item criado
// edit - Retorna um formulário para editar um item
// update - Armazena o item editado
// destroy - Deleta um item

// Todos os itens
Route::get('/', [ListingController::class, 'index']);

// Mostra o formulário de criação.
Route::get('/listings/create', [ListingController::class, 'create']);

// Armazena os dados da listagem
Route::post('/listings', [ListingController::class, 'store']);

// Apenas um item
Route::get('/listings/{listing}', [ListingController::class, 'show']);