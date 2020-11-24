<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Productos;
use App\Mail\Email\Correos;
use Illuminate\Support\Facades\Mail;


class ProductoController extends Controller
{
    public function index($id = null){
        if($id)
            return response()->json(["producto"=>Productos::find($id)],200);
        return response()->json(["productos"=>Productos::all()],200);
    }

    public function guardar(Request $request){
        $producto = new Productos();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;

        $correo = Mail::to('anguianoraul045@gmail.com')->send(new Correos());
        if($producto->save())
            return response()->json(["productos"=>$producto],201);
            return response()->json(["Correo"=>$correo,"producto creado:"->nombre],200);
        return response()->json(null,400);

        $correo = Mail::to('anguianoraul045@gmail.com')->send(new Correos());
        
    }
    public function Cambiar(Request $request, $id){
        $actualizardatos = new Productos();
        $actualizardatos = Productos::find($id);
        $actualizardatos->nombre = $request->get("nombre");
        $actualizardatos->save();
        return response()->json(["productos"=>$actualizardatos],201);
        return response()->json(null,400);

    }
    public function Eliminar($id){
        $quitar = new Productos();
        $quitar = Productos::find($id);
        $quitar->delete();

        return response()->json(["productos"=>Productos::all()],200);
    }
}
