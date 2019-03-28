<?php

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

use App\Address;
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create/user',function(){
    DB::insert('insert into users(name,email,password) values (?,?,?)',['Tom','vanhoutte@gmail.com',bcrypt(123)]);
});
Route::get('/create/address',function(){
    $user=User::findorFail(1);
    /*dd($user);*/
    $addresses= new Address(['name'=>'Oostnieuwkerksesteenweg 115, 8800 Roeselare']);
    $user->address()->save($addresses);
});
Route::get('/read/address',function(){
    $user=User::findorFail(1);
    /*dd($user->address);*/
    $addresses=$user->address;
    foreach ($addresses as $address){
        echo $address->name.'<br>';
    }
});
Route::get('update/address',function(){
    $user=User::findorFail(1);
    $user->address()->whereId(1)->update(['name'=>'nieuw adres']);
});

Route::get('/delete',function(){
    $user=User::findorFail(1);
    $user->address()->whereId(2)->delete();
});
