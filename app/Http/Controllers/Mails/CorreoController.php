<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\Email\Correos;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function EnviarCorreo(){
        $correo = Mail::to('anguianoraul045@gmail.com')->send(new Correos());
        return response()->json(["Correo"=>$correo],200);
    }
}
