<?php

namespace App\Modules\ExampleType\Services;

use App\Modules\ExampleType\Exceptions\ExampleTypeDestroyException;
use App\Modules\ExampleType\Exceptions\ExampleTypeIndexException;
use App\Modules\ExampleType\Exceptions\ExampleTypeNotFoundException;
use App\Modules\ExampleType\Exceptions\ExampleTypeSearchException;
use App\Modules\ExampleType\Exceptions\ExampleTypeStoreException;
use App\Modules\ExampleType\Exceptions\ExampleTypeUpdateException;
use App\Modules\ExampleType\Interfaces\ExampleTypeInterface;
use Exception;

class ExampleTypeService
{
    /**
     * @var ExampleTypeInterface
     */
    public $exampleTypeRepository;

    /**
     * @param ExampleTypeInterface $exampleTypeRepository
     */
    public function __construct(ExampleTypeInterface $exampleTypeRepository)
    {
        $this->exampleTypeRepository = $exampleTypeRepository;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ExampleTypeNotFoundException
     */
    public function getById(int $id)
    {
        try {
            return $this->exampleTypeRepository->findById($id);
        } catch (Exception $exception) {
            throw new ExampleTypeNotFoundException($exception);
        }
    }

    /**
     * @return mixed
     * @throws ExampleTypeIndexException
     */
    public function getAll()
    {
        try {
            return $this->exampleTypeRepository->findAll();
        } catch (Exception $exception) {
            throw new ExampleTypeIndexException($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ExampleTypeStoreException
     */
    public function create(array $data)
    {
        try {
            return $this->exampleTypeRepository->create($data);
        } catch (Exception $exception) {
            throw new ExampleTypeStoreException($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ExampleTypeUpdateException
     */
    public function update(array $data)
    {
        try {
            return $this->exampleTypeRepository->update($data['id'], $data);
        } catch (Exception $exception) {
            throw new ExampleTypeUpdateException($exception);
        }
    }

    /**
     * @param int $id
     * @return mixed|void
     * @throws ExampleTypeDestroyException
     */
    public function delete(int $id)
    {
        try {
            return $this->exampleTypeRepository->delete($id);
        } catch (Exception $exception) {
            throw new ExampleTypeDestroyException($exception);
        }
    }

    /**
     * @param array $data
     * @return mixed|void
     * @throws ExampleTypeSearchException
     */
    public function search(array $data)
    {
        try {
            return $this->exampleTypeRepository->search($data);
        } catch (Exception $exception) {
            throw new ExampleTypeSearchException($exception);
        }
    }
}
