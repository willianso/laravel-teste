<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;

class DashboardController extends Controller
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index(){
        return 'logado';
    }

    public function auth(Request $request){
        
        try {
            \Auth::attempt([
                'email' => $request->get('username'), 
                'password' => $request->get('passw')], 
            false);

            return redirect()->route('user.dashboard');
        } catch (\Exception $th) {
            return $th->getMessage();
        }
        
        dd($request->all());
    }
}
