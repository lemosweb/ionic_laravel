<?php

namespace CodeDelivery\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Models\Order;


/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{

    public function getByIdAndDeliveryMan($id, $idDeliveryman)
    {
        $result = $this->with(['client', 'items', 'cupom'])->findWhere([
            'id' => $id,
            'user_deliveryman_id' => $idDeliveryman
        ]);

        if($result instanceof Collection){
            $result = $result->first();
        }

        return $result;

    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
