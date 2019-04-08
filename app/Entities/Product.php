<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace App\Entities;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['inst_id', 'name', 'description', 'index', 'interest_rate'];

    public function instituicao(){
        return $this->belongsTo(Instituicao::class, 'inst_id');
    }

    public function valueFromUser(User $user){
        $inflows = $this->movements()->product($this)->applications()->sum('value');
        $outflows = $this->movements()->product($this)->outflows()->sum('value');

        return $inflows - $outflows;
    }

    public function movements(){
        return $this->hasMany(Movement::class);
    }
}
