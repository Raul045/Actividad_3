<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function MostrarUser($id = null){
        if($id)
            return response()->json(["user"=>User::find($id)],200);
        return response()->json(["users"=>User::all()],200);
    }

    public function guardarUser(Request $request){
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = $request->password;

        if($usuario->save())
            return response()->json(["users"=>$usuario],201);
        return response()->json(null,400);
    }
    public function CambiarUser(Request $request, $id){
        $actualizardatosU = new User();
        $actualizardatosU = User::find($id);
        $actualizardatosU->name = $request->get("name");
        $actualizardatosU->save();
        return response()->json(["users"=>$actualizardatosU],201);
        return response()->json(null,400);

    }
    public function EliminarUser($id){
        $quitarU = new User();
        $quitar = User::find($id);
        $quitar->delete();

        return response()->json(["users"=>User::all()],200);
    }
    public function ConsultaAv($id){
        $users = User::join("comentarios","usuario_id","=","id")
     ->where('users.name','=',"josesito")
     ->get();
    }
}
