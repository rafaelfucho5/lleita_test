<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SmsController extends Controller
{
    public function index()
    {
        return view('form');
    }

    public function sendSms(Request $request)
    {
        $user = config('constans.lleita_user');
        $pass = config('constans.lleita_pass');
        $client = new Client();


        $response = $client->request('POST', 'https://api.lleida.net/sms/v2/', [
            'sms' => [
                'user' => $user,
                'password' => $pass,
                'dst' => [
                    'num' => $request->input('dest')
                ],
                'txt' => $request->input('message'),
            ]
        ]);
        //para debug descomenta la siguente linea
        //dd($response);
        if ($response->getStatusCode() == 200) {
            return redirect('/sms-form')->with('success', 'SMS enviado correctamente.');
        } else {
            return redirect('/sms-form')->with('error', 'Error al enviar SMS.');
        }
    }
}
