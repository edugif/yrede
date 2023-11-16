<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {

    $posts = Post::all();

    return view('inicial', compact('post'));
});

Route::get('/teste', function () {
    return ('testado');
});

Route::get('/lista-usuarios', function () {
    $usuarios = User::all();

    return view('listaUsuarios', compact('usuarios'));
})->name('lista-usuario');

Route::view('/cadastra-usuario','cadastraUsuarios');

Route::post('/salva-usuario', function(Request $request){
    
    $usuario = new User();
    $usuario->usuario = $request->input('usuario');
    $usuario->name = $request->input('nome');
    $usuario->bio = $request->input('bio');
    $usuario->email = $request->input('email');
    $usuario->password = $request->input('senha');
    $usuario->save();

    return "Salvo com sucesso!!!1";

})->name('salva-usuario');

route::view('login', 'login')->name('login');

route::post('/logar', function (Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt(['email'=>$credentials['email'],
    'password' =>$credentials['password']])) {

        $request->session()->regenerate();

        return redirect()->intended('/');

       // return "Logado com sucesso!!";
    }

return "Erro ao logar!!! Usuário ou senha inválido";

});

Route::middleware(['auth'])->group(function () {
Route::view('/cria-post', 'criaPost');

Route::post('/salva-post', function (Request $request) {
    $post = new Post();

    $post->user_id= Auth::id();
    $post->mensagem = $request->mensagem;

    $post->save();

});

}); 
