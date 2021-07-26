<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use App\Model\Order;

interface OrderRepositoryInterface
{
	public function all(): Collection;

	public function where(string $identifier, int $id);

    public function update(int $id, string $key, string $value);

}
