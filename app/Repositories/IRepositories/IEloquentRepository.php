<?php

namespace App\Repositories\IRepositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface IEloquentRepository
 * @package App\Repositories\IRepositories
 */
interface IEloquentRepository
{
    /**
     * @param string $orderBy
     * @param string $orderTo
     * @param array $columns
     * @return Collection
     */
    public function all(string $orderBy = 'id', string $orderTo ='desc', array $columns = array('*')): Collection;

    /**
     * @param $id
     * @param array $columns
     * @return ?Model
     */
    public function find($id, array $columns = array('*')): ?Model;

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;
}
