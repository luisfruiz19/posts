<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use App\Mail\Notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailAPIController extends Controller
{
    //

    public function sendMail(SendMailRequest $request)
    {
        $input = $request->all();

        Mail::to('luisfruiz19@gmail.com')->send(new Notificacion(
            $input['name'],
            $input['email'],
            $input['proyect'],
            $input['dni'],
            $input['phone'],
            $input['contacted'],
            $input['comments']));
        return 'enviado';
    }
}
