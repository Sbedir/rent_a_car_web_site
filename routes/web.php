<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/genel/model', 'App\Http\Controllers\GenelController@model');
Route::get('/genel/ilce', 'App\Http\Controllers\GenelController@ilce');
Route::get('/genel/ofis', 'App\Http\Controllers\GenelController@ofis');
Route::get('/genel/kiralama-ucret-hesap', 'App\Http\Controllers\GenelController@kiralamaucrethesap');
Route::get('/genel/arac-search', 'App\Http\Controllers\GenelController@aracSearch');
Route::get('/genel/arac-fiyat', 'App\Http\Controllers\GenelController@aracFiyat');



Route::get('/hakkimizda', 'App\Http\Controllers\SayfaController@hakkimizda');
Route::get('/kiralama-kosullari', 'App\Http\Controllers\SayfaController@kiralamakosullari');
Route::get('/filo-kiralama', 'App\Http\Controllers\SayfaController@filokiralama');
Route::get('/sss', 'App\Http\Controllers\SayfaController@sss');
Route::get('/iletisim', 'App\Http\Controllers\SayfailetisimController@sayfailetisim');
Route::get('/transfer', 'App\Http\Controllers\TransferController@transferhizmet');
Route::get('/fiyat-listesi', 'App\Http\Controllers\AracController@aracim');
Route::get('/anasayfa', 'App\Http\Controllers\AnasayfaController@anasayfabilgi');
Route::get('/haber/{unique_name}', 'App\Http\Controllers\AnasayfaController@haber');

Route::post('/iletisim/mesaj', 'App\Http\Controllers\SayfailetisimController@mesaj')->name('iletisim.mesaj');
Route::get('/transfer/musteri', 'App\Http\Controllers\TransferController@musteri');
Route::post('/transfer/rezarvasyon', 'App\Http\Controllers\TransferController@createUpdate')->name('transfer.rezarvasyon');
Route::post('/uye-giris/kayit', 'App\Http\Controllers\UyeController@uyeekleme')->name('uye.kayit');
Route::post('/uye-giris/guncelle', 'App\Http\Controllers\UyeController@uyeekleme')->name('uye.guncelle');
Route::get('/uye-giris', 'App\Http\Controllers\UyeController@uyeler');
Route::get('/uye-giris', 'App\Http\Controllers\UyeController@uyeler')->name('uye-giris');
Route::get('/uye-paneli', 'App\Http\Controllers\UyeController@kullanicibilgi');
Route::post('/genel/login', 'App\Http\Controllers\GenelController@login')->name('genel.login');

Route::get('/uye-paneli', 'App\Http\Controllers\UyeController@kullanicibilgi')->name("uye-panel");

Route::get('/uye-panel/rezervasyonlar', 'App\Http\Controllers\RezervasyonController@rezervasyon');
Route::get('/uye-panel/transferler', 'App\Http\Controllers\UyeController@kullanicibilgi');
Route::get('/uye-panel/transferler', 'App\Http\Controllers\RezervasyonController@trezervasyon');
Route::get('/uye-panel/sifre-degistir', 'App\Http\Controllers\UyeController@kullanicibilgi');
Route::post('/uye-panel/sifre-degistir', 'App\Http\Controllers\UyeController@uyeekleme')->name("sifre.degistir");

 Route::get('/uye-panel/sifre-degistir', function () {
    return view('sifre-degistir');
 });


 Route::get('/uye-panel/cikis-yap', 'App\Http\Controllers\GenelController@logout');

// Route::get('/anasayfa', function () {
//     return view('anasayfa');
// });
// Route::get('/hakkimizda', function () {
//     return view('hakkimizda');
// });
// Route::get('/fiyat-listesi', function () {
//     return view('fiyat-listesi');
// });
// Route::get('/transfer', function () {
//     return view('transfer');
// });
// Route::get('/kiralama-kosullari', function () {
//     return view('kiralama-kosullari');
// });

// Route::get('/filo-kiralama', function () {
//     return view('filo-kiralama');
// });
// Route::get('/sss', function () {
//     return view('sss');
// });
// Route::get('/iletisim', function () {
//     return view('iletisim');
// });
// Route::get('/uye-giris', function () {
//     return view('uye-giris');
// });
