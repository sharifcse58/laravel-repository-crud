<?php

namespace App\Repository\Eloquent;

use App\Models\Job;
use App\Models\Product;
use App\Repository\JobRepositoryInterface;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{

    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }

}
