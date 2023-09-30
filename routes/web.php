<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Mostra todos os itens
Route::get('/', [ListingController::class, 'index']);

// Mostra formulário de criação.
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Armazena dados do formulário.
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Mostra formulário de edição.
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Atualiza dados.
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Remove item.
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Mostra apenas um item
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Mostra o formulário de registro de usuários.
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Cria novo usuário.
Route::post('/users', [UserController::class, 'store']);

// Desloga o usuário.
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Mostra formulário de login.
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Loga o usuário no sistema.
Route::post('/users/authenticate', [UserController::class, 'authenticate']);