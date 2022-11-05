<?php

namespace App\Repositories\Eloquent;

use App\Models\Layout;
use App\Repositories\IRepositories\ILayoutRepository;

class LayoutRepository extends BaseRepository implements ILayoutRepository
{
    /**
     * LayoutRepository constructor.
     *
     * @param Layout $model
     */
    public function __construct(Layout $model)
    {
        parent::__construct($model);
    }
}
