<?php

namespace App\Http\Controllers\APIAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\MessageBag;
use App\Mail\Email\Correos;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index(Request $request){
        if($request->user()->tokenCan('user:info') && $request->user()->tokenCan('admin:admin'))
            return response()->json(["users"=> User::all()], 200);
        if($request->user()->tokenCan('user:info'))
            return response()->json(["perfil" => $request->user()], 200);
        abort(401, "no fue valido");
    }
    public function Salir(Request $request){
        return response()->json(["Afectados" => $request->user()->tokens()->delete()], 201);
    }
    public function entrarAd(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email'|'password' => ['Credenciales incorrectas :(']
            ]);
        }

        $token = $user->createToken($request->email, ['admin'])->plainTextToken;
        return response()->json(["token" => $token], 201);
    }
    public function entrarU(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email'|'password' => ['Credenciales incorrectas :(']
            ]);
        }

        $token = $user->createToken($request->email, ['user'])->plainTextToken;
        return response()->json(["token" => $token], 201);
    }
    public function regis(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password' => 'required',
            'name' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);


        if($user->save())
            $elcorreo=[
                'nombre'=>$user->name,
                'email'=>$user->email,
                'password'=>$user->password,

                'URL'=>url("/api/AuthController@login")
            ];
            $correo=Mail::to($user->email)
                    ->send(new Correos($elcorreo));
            
             return response()->json(["Correo"=>$correo,"personas"=>$user],200);
    }
    public function darpermisos(Request $request){
        if($request->user()->tokenCan('admin'))
           $request->validate([
            'email'=>'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            throw ValidationException::withMessages([
                'email'=>["El usuario no es correcto. Verifica tus datos"],
            ]);
            $token = $user->createToken($request->email, ['user'])->plainTextToken;
            return response()->json(["token"=>$token],201);
        }
    }
}
