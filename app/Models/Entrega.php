<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    //
    use HasFactory, HasRoles;
    protected $table = 'entregas';
    protected $fillable = [
        'usuario_id',
        'proyecto_id',
        'estudiante_id',
        'enlace_github',
    ];
    public function usuarioCreador(){
        $this->belongsTo(User::class, 'id_usuario','id');
    }
    public function asignado(){
        $this->belongsTo(User::class, 'id_asignado','id');
    }
    public function proyectos(){
        $this->belongsTo(Proyecto::class,'id_proyecto','id');
    }
}
