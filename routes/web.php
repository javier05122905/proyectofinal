<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\practicascontroller;
use App\Http\Controllers\mascotascontroller;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\ventascontroller;
use App\Mail\notificacion;
use Illuminate\Support\Facades\Mail;

Route::get('altamascotas',[mascotascontroller::class,'altamascotas'])->name('altamascotas');
Route::POST('guardamascota',[mascotascontroller::class,'guardamascota'])->name('guardamascota');
Route::get('reportemascota',[mascotascontroller::class,'reportemascota'])->name('reportemascota');
Route::get('editamascota/{idma}',[mascotascontroller::class,'editamascota'])->name('editamascota');
Route::POST('guardacambios',[mascotascontroller::class,'guardacambios'])->name('guardacambios');
Route::get('desactivamascota/{idma}',[mascotascontroller::class,'desactivamascota'])->name('desactivamascota');
Route::get('activamascota/{idma}',[mascotascontroller::class,'activamascota'])->name('activamascota');
Route::get('eliminamascota/{idma}',[mascotascontroller::class,'eliminamascota'])->name('eliminamascota');

Route::get('inicio',[logincontroller::class,'inicio'])->name('inicio');
Route::get('login',[logincontroller::class,'login'])->name('login');
Route::POST('validar',[logincontroller::class,'validar'])->name('validar');
Route::get('cerrarsesion',[logincontroller::class,'cerrarsesion'])->name('cerrarsesion');


Route::get('crearventa',[ventascontroller::class,'crearventa'])->name('crearventa');
Route::get('infocliente',[ventascontroller::class,'infocliente'])->name('infocliente');
Route::get('infoproducto',[ventascontroller::class,'infoproducto'])->name('infoproducto');
Route::get('detalleproducto',[ventascontroller::class,'detalleproducto'])->name('detalleproducto');
Route::get('infodesc',[ventascontroller::class,'infodesc'])->name('infodesc');
Route::get('agregaelemento',[ventascontroller::class,'agregaelemento'])->name('agregaelemento');
Route::get('reporteventas',[ventascontroller::class,'reporteventas'])->name('reporteventas');
Route::get('editaventa/{idven}',[ventascontroller::class,'editaventa'])->name('editaventa');
Route::get('borraventas',[ventascontroller::class,'borraventas'])->name('borraventas');

//recuperapassword
Route::get('newpassword',[logincontroller::class,'newpassword'])->name('newpassword');
Route::get('validauser',[logincontroller::class,'validauser'])->name('validauser');
Route::get('captchanuevo',[logincontroller::class,'captchanuevo'])->name('captchanuevo');
Route::get('cambiapass',[logincontroller::class,'cambiapass'])->name('cambiapass');


//recuperapassword2
Route::get('newpassword2',[logincontroller::class,'newpassword2'])->name('newpassword2');
Route::get('validauser2',[logincontroller::class,'validauser2'])->name('validauser2');
Route::get('reinicia/{idu}',[logincontroller::class,'reinicia'])->name('reinicia');
Route::get('reinicia/{idu}',[logincontroller::class,'reinicia'])->name('reinicia');


Route::get('/prueba',function(){
  //  return new notificacion("Joel");
  $response=Mail::to('j.herreracr@hotmail.com')
                  ->cc('shalojoey3@gmail.com')
                  ->send(new notificacion("Joel","213434"));
  dump($response);
});

