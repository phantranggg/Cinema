<?php
namespace App\Repositories;

abstract class EloquentRepository implements RepositoryInterface {
    // var \Illuminate\Database\Eloquent\Model
    protected $model;
    
    public function __construct() {
        $this->model = $this->setModel();
    }
    
    abstract function getModel();

    public function setModel() {
        return app()->make($this->getModel());
    }
    
    public function getAll() {
        return $this->model->all();
    }
    
    public function find($id) {
        $result = $this->model->find($id);
        return $result;
    }
    
    public function create(array $attributes) {
        return $this->model->create($attributes);
    }
    
    public function update($id, array $attributes) {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return FALSE;
    }
    
    public function delete($id) {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return TRUE;
        }
        return FALSE;
    }
}
