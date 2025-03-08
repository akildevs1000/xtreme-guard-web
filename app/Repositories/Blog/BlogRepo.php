<?php

namespace App\Repositories\BlogRepo;

use App\Models\Asset\Asset;
use App\Models\Blogs\Blog;
use App\Models\Branch\Branch;
use App\Models\Product\Product;
use App\Models\Category\Category;
use App\Models\Contact\Contact;
use Illuminate\Support\Facades\Log;
use App\Models\Product\ProductImage;
use App\Repositories\BaseRepository;

class BlogRepo extends BaseRepository
{
    protected $model;

    public function __construct(Blog $model)
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

    public function createBlog($request)
    {
        $created = $this->model->create($request->validated());

        if ($created) {
            return $created;
        }
        return false;
    }

    public function updateCategory($request, $model)
    {
        $updated = $model->update($request->validated());
        if ($updated) {
            return $updated;
        }
        return false;
    }

    public function getAccessPermission(): array
    {
        return [
            'isView' => false,
            'isEdit' => true,
            'isDelete' =>  false,
            'isPrint' => false
        ];
    }
}
