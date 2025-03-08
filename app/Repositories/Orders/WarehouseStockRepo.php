<?php

namespace App\Repositories\Orders;

use App\Repositories\BaseRepository;
use App\Models\ImportOrder\ImportOrder;
use App\Models\Warehouse\WarehouseStock;

class WarehouseStockRepo extends BaseRepository
{
    protected $model;

    public function __construct(ImportOrder $model)
    {
        $this->model = $model;
    }

    public function __call($method, $parameters)
    {
        // Forward calls to the model instance
        $isExisit = $this->model->$method(...$parameters);

        if ($isExisit) {
            return $isExisit;
        }

        throw new \BadMethodCallException("Method {$method} does not exist on the model.");
    }

    public function getAllStocks()
    {
        try {
            $model = WarehouseStock::query();

            return $model;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getAllStocksForUploadToJTI()
    {
        try {
            $model = WarehouseStock::query();

            return $model;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getAccessPermission(): array
    {
        return [
            'isView' => false,
            'isEdit' => false,
            'isDelete' =>  false,
            'isPrint' => false
        ];
    }
}
