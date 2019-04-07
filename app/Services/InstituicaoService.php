<?php

namespace App\Services;

use App\Repositories\InstituicaoRepository;
use App\Validators\InstituicaoValidator;
use Prettus\Validator\Contracts\ValidatorInterface;


class InstituicaoService{

    private $repository;
    private $validator;

    public function __construct(InstituicaoRepository $repository, InstituicaoValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data){
        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $inst = $this->repository->create($data);

            return[
                'success' => true,
                'messages' => 'Instituição cadastrada',
                'data' => $inst
            ];
        } catch (\Exception $th) {
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