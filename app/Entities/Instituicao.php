<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Instituicao.
 *
 * @package namespace App\Entities;
 */
class Instituicao extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    public $timestamps = true;

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function products(){
        return $this->hasMany(Product::class, 'inst_id');
    }
}
