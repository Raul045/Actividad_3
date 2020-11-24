<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*Apartado para los Productos*/
Route::get("/productos/{id?}", "API\ProductoController@index")->where("id","[0-9]+");
Route::post("/productos","API\ProductoController@guardar");
Route::put("/productos/{id?}", "API\ProductoController@Cambiar")->where("id","[0-9]+");
Route::delete("/productos/{id?}", "API\ProductoController@Eliminar")->where("id","[0-9]+");

/*Apartado para los comentarios*/
Route::get("/comentarios/{id?}", "API\ComentarioController@mostrar")->where("id","[0-9]+");
Route::post("/comentarios","API\ComentarioController@guardarC");
Route::put("/comentarios/{id?}","API\ComentarioController@CambiarCom")->where("id","[0-9]+");
Route::delete("/comentarios/{id?}","API\ComentarioController@EliminarCom")->where("id","[0-9]+");

/*Apartado para los usuarios*/
Route::get("/users/{id?}", "API\UserController@MostrarUser")->where("id","[0-9]+");
Route::post("/users", "API\UserController@guardarUser");
Route::put("/users/{id?}", "API\UserController@CambiarUser")->where("id","[0-9]+");
Route::delete("/users/{id?}", "API\UserController@EliminarUser")->where("id","[0-9]+");
Route::get("/users1", "API\UserController@ConsultaAv");


/*Comentarios * Productos*/
Route::get("/productos/{id}/comentarios","API\ComentarioController@obtenerCP")->where("id","[0-9]+");

/*middleware tokens*/
Route::middleware('auth:sanctum')->get('user', 'APIAuth\AuthController@index');
Route::middleware('auth:sanctum')->delete('Salir', 'APIAuth\AuthController@Salir');
Route::middleware('auth:sanctum')->post('permisos', 'APIAuth\AuthController@darpermisos');

/*Las Rutas*/
Route::post('login', 'APIAuth\AuthController@entrar');
Route::post('registro', 'APIAuth\AuthController@regis');

/*Correos*/
Route::post("/correo", "Mails\CorreoController@EnviarCorreo");

Route::post("/email/api","ApiMails\MailsController@EnviarelEmail");
