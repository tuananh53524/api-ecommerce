<?php

namespace App\Repositories;

use App\Services\_Response\ApiResponseRepository;

abstract class BaseRepository extends ApiResponseRepository implements BaseRepositoryInterface
{
    //model muốn tương tác
    protected $model;

   //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }

    public function update($id,$data = [])
    {
        $model = $this->model->find($id);
        if ($model) {
            $model->update($data);
            return $model;
        } else {
            return null;
        }
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
