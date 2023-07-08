<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function setModel(Model $model);

    public function getModel();

    public function getTable(): string;

    public function destroy($id);
}
