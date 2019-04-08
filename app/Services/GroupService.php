<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;
use Illuminate\Database\QueryException;

class GroupService{

    private $repository;
    private $validator;

    public function __construct(groupRepository $repository, groupValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data){
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $groups = $this->repository->create($data);
            
            return[
                'success' => true,
                'messages' => 'Grupo cadastrado',
                'data' => $groups
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

    
    public function userStore($request, $group_id){
        try {
            $group = $this->repository->find($group_id);
            $user_id = $request['user_id'];

            $group->users()->attach($user_id);

            return[
                'success' => true,
                'messages' => 'Usuário relacionado!',
                'data' => null
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
            $group = $this->repository->update($data, $id);

            return[
                'success' => true,
                'messages' => 'Grupo atualizado',
                'data' => null
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
            $grupo = $this->repository->delete($id);
            
            return[
                'success' => true,
                'messages' => 'Grupo deletado',
                'data' => $grupo
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
}