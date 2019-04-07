<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['name', 'user_id', 'instituicao_id'];

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function instituicao(){
        return $this->belongsTo(Instituicao::class);
    }
}
