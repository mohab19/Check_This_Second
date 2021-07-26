<?php

namespace App\Repository\EloquentDB;

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Collection;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(User $model)
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
}
