<?php

namespace App\Repositories\Product;

use App\Models\Asset\Asset;
use App\Models\Branch\Branch;
use App\Models\Product\Product;
use App\Models\Category\Category;
use Illuminate\Support\Facades\Log;
use App\Models\Product\ProductImage;
use App\Repositories\BaseRepository;

class ProductRepo extends BaseRepository
{
    protected $model;

    public function __construct(Product $model)
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

    public function createProduct($request)
    {
        $attrValues = $request->value;
        $attr =  $request->attribute;
        $attachedmentName =  $request->attachment_attribute;

        $created = $this->model->create($request->validated());

        if ($created) {

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('gallery', 'public');
                    ProductImage::create(['product_id' => $created->id, 'image' => $path]);
                }
            }

            foreach ($attrValues as $key => $valData) {
                $created->attributes()->create([
                    'key' => $attr[$key],
                    'value' => $valData,
                ]);
            }

            if ($request->hasFile('attachment_value')) {
                foreach ($request->file('attachment_value') as $key => $attachment) {
                    $path = $attachment->store('attachment', 'public');
                    // Log::info($attachedmentName[$key]);
                    $created->files()->create([
                        'file_name' => $attachedmentName[$key],
                        'desc' => $attachedmentName[$key],
                        'path' => $path,
                    ]);
                }
            }

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
