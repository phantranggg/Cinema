<?php

namespace App\Repositories\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class SAbstractRepository
{
    private $app;
    protected $model;
    const PAGE_SIZE = 30;

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();

    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }

    /**
     * Get model array
     * @return type
     */
    public function selectArr()
    {
        $arr = [];
        $models = self::all();
        foreach ($models as $model) {
            $arr[$model->id] = $model->name;
        }
        return $arr;
    }

    /**
     * Get all
     * @param Request $request
     * @param Boolean $toArray
     * @return mixed
     */
    public function all($request, $toArray =null)
    {
        $orderBy = is_null($request->get('order_by')) ? 'id' : $request->get('order_by');
        $orderArr = explode(',', $orderBy);
        $sortBy = in_array($request->get('sort_by'), ['asc', 'desc']) ? $request->get('sort_by') : 'desc';
        $searchBy = $request->get('search_by');
        $searchText = $request->get('search_text');
        $data = $this->model;
        foreach ($orderArr as $order) {
            $data = $data->orderBy($order, $sortBy);
        }
        if (!is_null($searchBy) && $this->checkColumn($searchBy)) {
            $data = $data->where($searchBy, 'LIKE', "%$searchText%");
        }
        if ($toArray === null) {
            return $data->get();
        }
        if ($toArray) {
            return $data->paginate(self::PAGE_SIZE)->getCollection()->toArray();
        }
        return $data->paginate(self::PAGE_SIZE);
    }

    /**
     * Get table columns
     * @return array
     */
    protected function getTableColumns()
    {
        $modelColumns = $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
        return $modelColumns;
    }

    /**
     * Check column exists
     * @param string $col
     * @return boolean
     */
    protected function checkColumn($col)
    {
        if (in_array($col, $this->getTableColumns())) {
            return true;
        } else {
            return false;
        }
    }

}
