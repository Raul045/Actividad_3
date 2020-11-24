<?php

namespace App\Http\Controllers\ApiMails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Mailjet\Resources;

class MailsController extends Controller
{
   public function EnviarelEmail(){
    $apikey = config('app.mjapikeypub');
    $apisecret = config('app.mjapikeypriv');
    $mj = new \Mailjet\Client($apikey,$apisecret,true,['version' => 'v3.1']);
    $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "19170038@uttcampus.edu.mx",
          'Name' => "Raul Alejandro"
        ],
        'To' => [
          [
            'Email' => "anguianoraul045@gmail.com",
            'Name' => "Raul Alejandro Anguiano"
          ]
        ],
        'Subject' => "¡¡¡Activa tu cuenta!!!",
        'TextPart' => "Bienvenido al equipo",
        'HTMLPart' => "<h3>¡¡Hey!! Bienvenido entra a <a href='APIAuth\AuthController@entrar'>login</a>!</h3><br />Esperamos trabajar contigo",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
    $response = $mj->post(Resources::$Email, ['body' => $body]);
    //$response->success() && var_dump($response->getData());
    if($response->success())
        return response()->json(["data"=>$response->getData()],200);
    return response()->json(["data"=>$response->getData()],500);
   }
}
