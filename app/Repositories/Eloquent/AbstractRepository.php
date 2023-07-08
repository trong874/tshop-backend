<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\CategoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    protected Model $originalModel;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->originalModel = $model;
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getTable(): string
    {
        return $this->model->getTable();
    }

    public function destroy($id): int
    {
        return $this->model->destroy($id);
    }
}
