<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

use App\Repositories\IRepositories\IEloquentRepository;

class BaseRepository implements IEloquentRepository
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of model
     *
     * @param string $orderBy
     * @param string $orderTo
     * @param array $columns
     * @return Collection
     */
    public function all(string $orderBy = 'id', string $orderTo ='desc', array $columns = array('*')): Collection
    {
        return $this->model->orderBy($orderBy, $orderTo)->get($columns);
    }

    /**
     * Get a record by id value
     *
     * @param int $id
     * @param array $columns
     * @return ?Model
     */
    public function find($id, array $columns = array('*')): ?Model
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Create a record
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $record = $this->model->create($attributes);
        return $record->fresh();
    }
}
