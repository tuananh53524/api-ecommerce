<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function findById($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($data = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $data = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
