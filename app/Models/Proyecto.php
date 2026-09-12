<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'proyectos';
    protected $fillable = [
        'usuario_id',
        'entrega_id',
        'titulo',
        'descripcion',
        'fecha_limite'
    ];

    public function usuario(){
        $this->belongsTo(User::class, 'id_usuario','id');
    }
    public function entrega(){
        $this->belongsTo(entrega::class,'id_entrega','id');
    }
}
