<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;


use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Services\OrderService;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class DeliverymanCheckoutController extends Controller
{

    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */

    private $service;

    /**
     * @param OrderRepository $repository
     * @param UserRepository $userRepository
     * @param OrderService $service
     * @internal param ClientServices $
     */


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
