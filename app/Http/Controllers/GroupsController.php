<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use App\Services\GroupService;
use App\Repositories\InstituicaoRepository;
use App\Repositories\UserRepository;
use App\Entities\Group;

/**
 * Class GroupsController.
 *
 * @package namespace App\Http\Controllers;
 */
class GroupsController extends Controller
{
    /**
     * @var GroupRepository
     */
    protected $repository;

    /**
     * @var GroupValidator
     */
    protected $service;
    protected $instituicaoRepository;
    protected $userRepository;

    /**
     * GroupsController constructor.
     *
     * @param GroupRepository $repository
     * @param GroupValidator $validator
     */
    public function __construct(GroupRepository $repository, UserRepository $userRepository,
        GroupService $service, InstituicaoRepository $instituicaoRepository)
    {
        $this->repository = $repository;
        $this->instituicaoRepository = $instituicaoRepository;
        $this->userRepository = $userRepository;
        $this->service  = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->repository->all();
        $inst = $this->instituicaoRepository->selectBoxList();
        $usuarios = $this->userRepository->selectBoxList();
        return view('groups.index', ['groups' => $groups, 'usuarios' => $usuarios, 'inst' => $inst]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(GroupCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        $groups = $request['success'] ? $request['data'] : $request['messages'];
 
         session()->flash('success', [
             'success' => $request['success'],
             'messages' => $request['messages']
         ]);
 
        return redirect()->route('group.index');
    }

    public function userStore(Request $request, $group_id){
        $request = $this->service->userStore($request->all(), $group_id);
 
         session()->flash('success', [
             'success' => $request['success'],
             'messages' => $request['messages']
         ]);
 
        return redirect()->route('group.show', $group_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = $this->repository->find($id);
        $user_list = $this->userRepository->selectBoxList();
        return view('groups.show', ['group' => $group, 'user_list' => $user_list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $inst = $this->instituicaoRepository->selectBoxList();
        $usuarios = $this->userRepository->selectBoxList();

        return view('groups.edit', ['group' => $group, 'inst' => $inst, 'usuarios' => $usuarios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        $request = $this->service->update($request->all(), $id);
 
        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages']
        ]);

       return redirect()->route('group.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = $this->service->destroy($id);
 
        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages']
        ]);

        return redirect()->route('group.index');
    }
}
