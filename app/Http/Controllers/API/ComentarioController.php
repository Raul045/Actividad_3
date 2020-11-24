<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Comentarios;

class ComentarioController extends Controller
{
    public function mostrar($id = null){
        if($id)
            return response()->json(["comentario"=>Comentarios::find($id)],200);
        return response()->json(["comentarios"=>Comentarios::all()],200);
        
    }

    public function guardarC(Request $request1){
        $comentario = new Comentarios();
        $comentario->titulo = $request1->titulo;
        $comentario->contenido = $request1->contenido;
        $comentario->producto_id = $request1->producto_id;
        $comentario->usuario_id = $request1->usuario_id;

        if($comentario->save())
            return response()->json(["comentarios"=>$comentario],201);
        return response()->json(null,400);
    }
    public function CambiarCom(Request $request1, $id){
        $actualizarcom = new Comentarios();
        $actualizarcom = Comentarios::find($id);
        $actualizarcom->titulo = $request1->get("titulo");
        $actualizarcom->save();
        return response()->json(["comentarios"=>$actualizarcom],201);
        return response()->json(null,400);

    }
    public function EliminarCom($id){
        $quitarCom = new Comentarios();
        $quitarCom = Comentarios::find($id);
        $quitarCom->delete();

        return response()->json(["comentarios"=>Comentarios::all()],200);
    }
    public function obtenerCP($id){
        $cp = Comentarios::where('producto_id',$id)->get();
        return response()->json($cp);
    }
}
