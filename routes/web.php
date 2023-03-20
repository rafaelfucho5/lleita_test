<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;

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
    return view('welcome');
});


Route::get('/phone/{phone}', function ($phone) {
    //Validamos que el numero sea numerico
    if (!is_numeric($phone)){
        return "numero incorrecto";
    }
    //Validamos que este en el rango de longitud correcto
    $length = strlen($phone);
    if ($length < 7 || $length > 15) {
        return "numero incorrecto";
    }

    if (substr($phone, 0, 2) == "00") {//validamos si posee 00 y restamos dos a la longitud
        $length = $length - 2;
    } elseif (substr($phone, 0, 1) == "+") {//validamos si posee + y restamos uno a la longitud
        $length = $length -1;
    } elseif ($length > 12){//validamos si al restar la longitud supera el maximo de 12
        return "numero incorrecto";
    }else {
        return "numero nacional";
    }

    return "numero internacional";
});

Route::get('/sms-form', [SmsController::class, 'index']);
Route::post('/send-sms', [SmsController::class, 'sendSms']);
