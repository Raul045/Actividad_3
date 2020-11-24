<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
      /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'producto';

    public function Comentarios(){
        return $this->hasMany("App\Modelos\Comentarios");
    }
}
