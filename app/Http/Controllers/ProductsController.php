<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProductRequest;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Http\Requests;

class ProductsController extends Controller
{

    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }



    public function index()
    {

        $products = $this->repository->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function edit($id)
    {
        $Product = $this->repository->find($id);

        return view('admin.products.edit', compact('Product'));

    }

    public function store(AdminProductRequest $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('admin.products.index');

    }

    public function update(AdminProductRequest $request, $id)
    {
        $data = $request->all();

        $this->repository->update($data, $id);

        return redirect()->route('admin.products.index');
    }
}
