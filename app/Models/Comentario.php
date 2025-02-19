<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = ['contenido', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comentable()
    {
        return $this->morphTo();
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'comentable');
    }

    public function buscarComentarios()
    {
        return $this->hasMany(Comentario::class, 'comentable_id')
            ->where('comentable_type', self::class)
            ->with('user', 'buscarComentarios'); 
    }
}
