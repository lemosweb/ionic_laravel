<?php

namespace CodeDelivery\Http\Controllers\Api\Client;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Services\ClientServices;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ClientCheckoutController extends Controller
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

        $id = Authorizer::getResourceOwnerId();

        $clientId =  $this->userRepository->find($id)->client->id;
        $orders = $this->repository->with(['items'])->scopeQuery(function($query) use($clientId){

            return $query->where('client_id','=',$clientId);

        })->paginate();

        return $orders;

    }


    public function create()
    {
        $products = $this->productRepository->getList();

        return view('customer.order.create', compact('products'));
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $clientId = $this->userRepository->find(Authorizer::getResourceOwnerId())->client->id;
        $data['client_id'] = $clientId;
        $o = $this->service->create($data);
        $o = $this->repository->with('items')->find($o->id);

        return $o;

    }

    public function show($id)
    {

        $o = $this->repository->with(['client','items','cupom'])->find($id);


        return $o;
    }


}
