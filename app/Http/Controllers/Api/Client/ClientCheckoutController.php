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
        OrderService $service

    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->service = $service;

    }

    public function index()
    {

        $id = Authorizer::getResourceOwnerId();

        $orders = $this->repository->with(['items'])->scopeQuery(function($query) use($id){

            return $query->where('user_deliveryman_id','=',$id);

        })->paginate();

        return $orders;

    }

    public function show($id)
    {

        $o = $this->repository->with(['client','items','cupom'])->find($id);
        $o->items->each(function($item){

            $item->product;

        });

        return $o;

    }


}
