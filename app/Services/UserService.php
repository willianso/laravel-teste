<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;
use Illuminate\Database\QueryException;

class UserService{

    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data){
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $usuario = $this->repository->create($data);
            
            return[
                'success' => true,
                'messages' => 'Usuário cadastrado',
                'data' => $usuario
            ];
        } catch (Exception $th) {
            switch (get_class($th)) {
                case QueryException::class:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                    break;
                
                case ValidatorException::class:
                return ['success' => false, 'messages' =>  $th->getMessageBag()];
                break;
                
                case Exception::class:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                break;

                default:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                    break;
            }
        }
    }
    public function update($data, $id){
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $usuario = $this->repository->update($data, $id);
            
            return[
                'success' => true,
                'messages' => 'Usuário atualizado',
                'data' => $usuario
            ];
        } catch (Exception $th) {
            switch (get_class($th)) {
                case QueryException::class:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                    break;
                
                case ValidatorException::class:
                return ['success' => false, 'messages' =>  $th->getMessageBag()];
                break;
                
                case Exception::class:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                break;

                default:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                    break;
            }
        }
    }
    public function destroy($id){
        try {
            $usuario = $this->repository->delete($id);
            
            return[
                'success' => true,
                'messages' => 'Usuário deletado',
                'data' => $usuario
            ];
        } catch (Exception $th) {
            switch (get_class($th)) {
                case QueryException::class:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                    break;
                
                case ValidatorException::class:
                return ['success' => false, 'messages' =>  $th->getMessageBag()];
                break;
                
                case Exception::class:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                break;

                default:
                return ['success' => false, 'messages' =>  $th->getMessage()];
                    break;
            }
            return[
                'success' => false,
                'messages' => 'Erro de execução'
            ];
        }
    }
}