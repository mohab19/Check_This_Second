<?php

namespace App\Repository\Eloquent;

use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    /**
    * UserRepository constructor.
    *
    * @param Order $model
    */
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }

	/**
    * @return Collection
    */
	public function where(string $identifier, int $id)
	{
		return $this->model->where($identifier, $id)->get();
	}

}
