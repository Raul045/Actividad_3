<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use App\Mail\Email\Correos;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CorreoController extends Controller
{
    public function EnviarCorreo(){
        $correo = Mail::to('19170038@uttcampus.edu.mx')->send(new Correos());
        return response()->json(["Correo"=>$correo],200);
    }
}
