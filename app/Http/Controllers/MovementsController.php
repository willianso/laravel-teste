<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovementCreateRequest;
use App\Http\Requests\MovementUpdateRequest;
use App\Repositories\MovementRepository;
use App\Validators\MovementValidator;

use App\Entities\{Product, Group, Movement};
use Auth;

/**
 * Class MovementsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovementsController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(MovementRepository $repository, MovementValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index(){
        return view('movement.index', ['product_list' => Product::all()]);
    }

    public function application(){

        $user = Auth::user();
        $group_list = $user->groups->pluck('name', 'id');
        // $product_list = $user->groups->first()->instituicao->products->pluck('name', 'id');
        $product_list = Product::all()->pluck('name', 'id');

        return view('movement.application', [
            'product_list' => $product_list,
            'group_list' => $group_list
        ]);
    }

    public function storeApplication(Request $request){
        $movimento = Movement::create([
            'user_id' => Auth::user()->id, 'group_id' => $request->get('group_id'),
            'product_id' =>$request->get('product_id') , 'value' =>$request->get('value') , 
            'type' => 1
        ]);

        session()->flash('success', [
            'success' => true,
            'messages' => "Aplicação de $movimento->value realizada em ". $movimento->product->name
        ]);

        return redirect()->route('movement.application');
    }

    public function all(){
        $movement_list = Auth::user()->movements;
        
        return view('movement.all', ['movement_list' => $movement_list]);
    }
}
