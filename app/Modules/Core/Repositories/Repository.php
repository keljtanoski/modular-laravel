<?php

namespace App\Modules\Core\Repositories;

use App\Modules\Core\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{
    /**
     * Model::class
     */
    public $model;

    /**
     * @var array
     */
    public $filters = [];

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->model::all();
    }

    /**
     * @param string $column
     * @param $value
     * @return mixed
     */
    public function findBy(string $column, $value)
    {
        return $this->model::where($column, $value);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model::create($data)->fresh();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model::insert($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data)
    {
        $item = $this->findById($id);
        $item->fill($data);
        $item->save();
        return $item->fresh();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model::find($id);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function delete(int $id)
    {
        $this->model::destroy($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function restore(int $id)
    {
        $object = $this->findByIdWithTrashed($id);
        if ($object && method_exists($this->model, 'isSoftDelete')) {
            $object->restore($id);
            return $object;
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findByIdWithTrashed(int $id)
    {
        if (method_exists($this->model, 'isSoftDelete')) {
            return $this->model::withTrashed()->find($id);
        }
    }
}
