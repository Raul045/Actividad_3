<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comentario';
    
    public function productos(){
        return $this->belongsTo("App\Modelos\Productos");
    }

    public function users(){
        return $this->belongsTo("App\User");
    } 
}
