<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Productos;
use Illuminate\Database\Eloquent\Scope; 
use App\User;
use App\Mail\Email\Productomail;
use Illuminate\Support\Facades\Mail;


class ProductoController extends Controller
{
    public function index($id = null){
        if($id)
            return response()->json(["producto"=>Productos::find($id)],200);
        return response()->json(["productos"=>Productos::all()],200);
    }

    public function guardar(Request $request){
        if ($request->user()->tokenCan('admin')) {
                $producto = new Productos();
                $producto->nombre = $request->nombre;
                $producto->descripcion = $request->descripcion;

                $usuario = $request->user()['name'];
                $correoelec = $request->user()['email']; 
             if($producto->save()){
                    $elcorreo=[ 
                        'usuario'=>$usuario,
                        'name'=>$producto->nombre,
                        'descripcion'=>$producto->descripcion,
                    ];
                    $correo = Mail::to('19170038@utt.edu.mx')->send(new Productomail($elcorreo));
                    return response()->json(["Correo"=>$correo,"Producto"=>$producto],201); 
                }else {
                    $informacionActalizada=[
                        'username'=>$usuario,
                        'email'=>$email,
                        'proceso'=>"intento fallido de insercion de productos nuevos"

                    ];
                    Mail::to('19170038@utt.edu.mx')
                    ->send(new Productomail($elcorreo));
            }
            
        }elseif ($request->user()->tokenCan('user')) {
            $usuario = $request->user()['name'];
            $correoelec = $request->user()['email'];
            $accion="A causa de falta de permisos";
            
            $elcorreo=[
                'usuario'=>$usuario,
                'email'=>$correoelec,
                'accion'=>$accion
            ];
            Mail::to('19170038@utt.edu.mx')
                ->send(new Productomail($elcorreo));
        }else {
            abort(401,"lo sentimos ");
        } 
        
    }
    public function Cambiar(Request $request, $id){ 
        if ($request->user()->tokenCan('admin')) {
                $actualizardatos = new Productos();
                $actualizardatos = Productos::find($id);
                $actualizardatos->nombre = $request->get("nombre");
                $actualizardatos->save();

                $usuario = $request->user()['name'];
                $correoelec = $request->user()['email']; 
                if($producto->save()){
                    $elcorreo=[ 
                        'usuario'=>$usuario,
                        'name'=>$actualizardatos->nombre,
                        'descripcion'=>$actualizardatos->descripcion,
                    ];
                    $correo = Mail::to('19170038@utt.edu.mx')->send(new Productomail($elcorreo));
                    return response()->json(["Correo"=>$correo,"Producto actulizado"=>$actualizardatos],201); 
                }else {
                    $informacionActalizada=[
                        'username'=>$usuario,
                        'email'=>$email,
                        'proceso'=>"intento fallido de insercion de productos nuevos"

                    ];
                    Mail::to('19170038@utt.edu.mx')
                    ->send(new Productomail($elcorreo));
        }
    }elseif ($request->user()->tokenCan('user')) {
            
        $usuario = $request->user()['name'];
        $correoelec = $request->user()['email'];
        $accion="A causa de falta de permisos";
        
        $elcorreo=[
            'usuario'=>$usuario,
            'email'=>$correoelec,
            'accion'=>$accion
        ];
        Mail::to('19170038@utt.edu.mx')
            ->send(new Productomail($elcorreo));
    }

    }
    public function Eliminar($id){
        if ($request->user()->tokenCan('admin')) {
            $quitar = new Productos();
            $quitar = Productos::find($id);
            $quitar->delete();
            return response()->json(["productos"=>Productos::all()],200);
        }
    }
}
