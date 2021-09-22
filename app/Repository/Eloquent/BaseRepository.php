<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function factory(): \Illuminate\Database\Eloquent\Factories\Factory
    {
        return $this->model::factory();
    }

    public function getDbQuery()
    {
        return DB::connection($this->model->getConnectionName())->table($this->model->getTable());
    }

    public function first()
    {
        return $this->getQuery()->first();
    }

    public function all()
    {
        return $this->getQuery()->get();
    }

    public function count()
    {
        return $this->getQuery()->count();
    }

    public function paginate($limit = 10)
    {
        return $this->getQuery()->paginate($limit);
    }

    public function find($id, $withTrash = false)
    {
        if ($withTrash) {
            return $this->getQuery()->withTrashed()->find($id);
        }

        return $this->getQuery()->find($id);
    }

    public function where($column, $id, $first = false)
    {
        $query = $this->getQuery()->where($column, $id);

        return ($first) ? $query->first() : $query->get();
    }

    public function store($request)
    {
        return $this->getQuery()->create($request);
    }

    public function with($relation)
    {
        return $this->getQuery()->with($relation);
    }

    public function update($id, array $requestData, $withTrash = false)
    {
        if ($withTrash) {
            $app = $this->getQuery()->withTrashed()->find($id);
        } else {
            $app = $this->getQuery()->find($id);
        }

        $app->update($requestData);

        return $app;
    }

    public function destroy($id)
    {
        return $this->getQuery()->find($id)->delete();
    }
}
