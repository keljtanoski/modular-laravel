<?php

namespace App\Modules\Example\Services;

use App\Modules\Example\Exceptions\ExampleDestroyException;
use App\Modules\Example\Exceptions\ExampleIndexException;
use App\Modules\Example\Exceptions\ExampleNotFoundException;
use App\Modules\Example\Exceptions\ExampleSearchException;
use App\Modules\Example\Exceptions\ExampleStoreException;
use App\Modules\Example\Exceptions\ExampleUpdateException;
use App\Modules\Example\Interfaces\ExampleInterface;
use Exception;

class ExampleService
{
    public $exampleRepository;

    public function __construct(ExampleInterface $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ExampleNotFoundException
     */
    public function getById(int $id)
    {
        try {
            return $this->exampleRepository->findById($id);
        } catch (Exception $exception) {
            throw new ExampleNotFoundException($exception);
        }
    }

    /**
     * @return mixed
     * @throws ExampleIndexException
     */
    public function getAll()
    {
        try {
            return $this->exampleRepository->findAll();
        } catch (Exception $exception) {
            throw new ExampleIndexException($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ExampleStoreException
     */
    public function create(array $data)
    {
        try {
            return $this->exampleRepository->create($data);
        } catch (Exception $exception) {
            throw new ExampleStoreException($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ExampleUpdateException
     */
    public function update(array $data)
    {
        try {
            return $this->exampleRepository->update($data['id'], $data);
        } catch (Exception $exception) {
            throw new ExampleUpdateException($exception);
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     * @throws ExampleDestroyException
     */
    public function delete(int $id)
    {
        try {
            return $this->exampleRepository->delete($id);
        } catch (Exception $exception) {
            throw new ExampleDestroyException($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed|void
     * @throws ExampleSearchException
     */
    public function search(array $data)
    {
        try {
            return $this->exampleRepository->search($data);
        } catch (Exception $exception) {
            throw new ExampleSearchException($exception);
        }
    }
}
