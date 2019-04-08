<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\InstituicaoCreateRequest;
use App\Http\Requests\InstituicaoUpdateRequest;
use App\Repositories\InstituicaoRepository;
use App\Validators\InstituicaoValidator;
use App\Services\InstituicaoService;

/**
 * Class InstituicaosController.
 *
 * @package namespace App\Http\Controllers;
 */
class InstituicaosController extends Controller
{
    
    protected $repository;

    protected $service;

    /**
     * InstituicaosController constructor.
     *
     * @param InstituicaoRepository $repository
     * @param InstituicaoValidator $validator
     */
    public function __construct(InstituicaoRepository $repository, InstituicaoService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inst = $this->repository->all();
        return view('instituicao.index', ['inst' => $inst]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InstituicaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(InstituicaoCreateRequest $request)
    {
        $request = $this->service->store($request->all());
        $inst = $request['success'] ? $request['data'] : $request['messages'];

        session()->flash('success', [
            'success' => $request['success'],
            'messages' => $request['messages']
        ]);

       return redirect()->route('instituicao.index');
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
        $instituicao = $this->repository->find($id);

        return view('instituicao.show', ['inst' => $instituicao]);
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
        $instituicao = $this->repository->find($id);

        return view('instituicao.edit', ['inst' => $instituicao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InstituicaoUpdateRequest $request
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

       return redirect()->route('instituicao.index');
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Instituicao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Instituicao deleted.');
    }
}
