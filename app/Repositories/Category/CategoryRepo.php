<?php

namespace App\Repositories\Category;

use App\Models\Asset\Asset;
use Illuminate\Support\Str;
use App\Models\Branch\Branch;
use App\Models\Category\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CategoryRepo extends BaseRepository
{
    protected $model;

    public function __construct(Category $model)
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

    public function createCategory($request)
    {
        $created = $this->model->create($request->validated());

        if ($created) {

            // if ($request->hasFile('img1')) {
            //     $this->model->imageUpload('/category', $created, $request->file('img1'), 'img');
            // }


            if ($request->hasFile('img1')) {
                // $upload = $request->file('img1');
                // $image = Image::read($upload)
                //     ->resize(300, 200);

                // Storage::put(
                //     Str::random() . '.' . $upload->getClientOriginalExtension(),
                //     $image->encodeByExtension($upload->getClientOriginalExtension(), quality: 70)
                // );


                $upload = $request->file('img1');
                // $image = Image::read($upload)->resize(300, 400);
                $image = Image::read($upload)->resize(450, 600);
                $filename = Str::random() . '.' . $upload->getClientOriginalExtension();

                Storage::disk('public')->put(
                    'category/' . $filename,
                    $image->encodeByExtension($upload->getClientOriginalExtension(), quality: 70)
                );

                $created->img = 'category/' . $filename;  // Assuming you're saving the resized image path
                $created->save();
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
