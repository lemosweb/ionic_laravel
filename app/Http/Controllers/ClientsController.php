<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Http\Requests;
use CodeDelivery\Services\ClientServices;

class ClientsController extends Controller
{

    private $repository;
    /**
     * @var ClientServices
     */
    private $service;

    public function __construct(ClientRepository $repository, ClientServices $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }



    public function index()
    {

        $clients = $this->repository->paginate(5);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function edit($id)
    {
        $client = $this->repository->find($id);

        return view('admin.clients.edit', compact('client'));

    }

    public function store(AdminClientRequest $request)
    {
        $data = $request->all();

        $this->service->create($data);

        return redirect()->route('admin.clients.index');

    }

    public function update(AdminClientRequest $request, $id)
    {
        $data = $request->all();

        $this->service->update($data, $id);

        return redirect()->route('admin.clients.index');
    }
}
