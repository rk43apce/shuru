<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function __construct(
        protected Model $model
    ) {
    }

    public function all(): Collection
    {
        return $this->model->newQuery()->get();
    }

    public function find(int $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    public function create(array $attributes): Model
    {
        return $this->model->newQuery()->create($attributes);
    }

    public function update(int $id, array $attributes): ?Model
    {
        $model = $this->find($id);

        if (! $model) {
            return null;
        }

        $model->update($attributes);

        return $model->fresh();
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);

        if (! $model) {
            return false;
        }

        return (bool) $model->delete();
    }
}
