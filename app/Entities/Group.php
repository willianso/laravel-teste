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

    public function getTotalValueAttribute(){
        $total = 0;

        foreach ($this->movements as $mov) 
            $total += $mov->value;
        
        return $total;
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function instituicao(){
        return $this->belongsTo(Instituicao::class, 'instituicao_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_groups');
    }

    public function movements(){
        return $this->hasMany(Movement::class);
    }
}
