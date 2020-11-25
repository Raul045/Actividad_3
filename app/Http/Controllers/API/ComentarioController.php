<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Comentarios;
use Illuminate\Database\Eloquent\Scope; 
use App\User;
use App\Mail\Email\Comentariomail;
use Illuminate\Support\Facades\Mail;

class ComentarioController extends Controller
{
    public function mostrar($id = null){
        if($id)
            return response()->json(["comentario"=>Comentarios::find($id)],200);
        return response()->json(["comentarios"=>Comentarios::all()],200);
        
    }

    public function guardarC(Request $request1){
        if ($request1->user()->tokenCan('admin')||$request1->user()->tokenCan('user')) {
            $comentario = new Comentarios();
            $comentario->titulo = $request1->titulo;
            $comentario->contenido = $request1->contenido;
            $comentario->producto_id = $request1->producto_id;
            $comentario->usuario_id = $request1->usuario_id;

            $usuario = $request1->user()['name'];
            $correoelec = $request1->user()['email']; 

            if($comentario->save()){
                $elcorreo=[ 
                    'usuario'=>$usuario,
                    'titulo'=>$comentario->titulo,
                    'contenido'=>$comentario->contenido,
                ];
                $correo = Mail::to('19170038@utt.edu.mx')->send(new Comentariomail($elcorreo));
                return response()->json(["Correo"=>$correo,"Producto"=>$comentario],201); 
            }else {
                $informacionActalizada=[
                    'username'=>$usuario,
                    'email'=>$email,
                    'proceso'=>"intento fallido de insercion de productos nuevos"

                ];
                Mail::to('19170038@utt.edu.mx')
                ->send(new Productomail($elcorreo));
            }
        }
    }
    public function CambiarCom(Request $request1, $id){
        if ($request1->user()->tokenCan('admin')|| $request1->user()->tokenCan('user')) {
            $actualizarcom = new Comentarios();
            $actualizarcom = Comentarios::find($id);
            $actualizarcom->titulo = $request1->get("titulo");
            $actualizarcom->contenido =$request1->get("contenido");
            $actualizarcom->save();

            $usuario = $request1->user()['name'];
            $correoelec = $request1->user()['email']; 

            if($comentario->save()){
                $elcorreo=[ 
                    'usuario'=>$usuario,
                    'titulo'=>$actualizarcom->titulo,
                    'contenido'=>$actualizarcom->contenido,
                ];
                $correo = Mail::to('19170038@utt.edu.mx')->send(new Comentariomail($elcorreo));
                return response()->json(["Correo"=>$correo,"Producto"=>$actualizarcom],201); 
            }else {
                $informacionActalizada=[
                    'username'=>$usuario,
                    'email'=>$email,
                    'proceso'=>"intento fallido de insercion de productos nuevos"

                ];
                Mail::to('19170038@utt.edu.mx')
                ->send(new Productomail($elcorreo));
            }
        }

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
