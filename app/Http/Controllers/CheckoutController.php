<?php

namespace CodeDelivery\Http\Controllers;


use CodeDelivery\Services\ClientServices;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{

    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $service;
    /**
     * @var ClientServices
     */
    private $client;

    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $service,
        ClientServices $client
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;

        $this->service = $service;
        $this->client = $client;
    }

    public function index()
    {

        $clientId =  $this->userRepository->find(1)->client->id;
        $orders = $this->repository->scopeQuery(function($query) use($clientId){

            return $query->where('client_id','=',$clientId);

        })->paginate();

        return view('customer.order.index', compact('orders'));

    }


    public function create()
    {
        $products = $this->productRepository->getList();

        return view('customer.order.create', compact('products'));
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        $this->service->create($data);


        return redirect()->route('order.index');

    }


}
