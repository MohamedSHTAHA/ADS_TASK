<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //use skip to paginate data
        $skip = $request->has('skip') ? $request->skip : 0;
        $categories = new Category();
        $count = $categories->count();
        //if not send skip will retarn all data
        if ($request->has('skip')) {
            $categories = $categories->skip($skip)->take(10);
        }
        $categories = $categories->get();
        $fractal = fractal()
            ->collection($categories)
            ->transformWith(new CategoryTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200, ['count' => $count]);
    }
    public function show($id)
    {
        $Category =  Category::findOrFail($id);

        $fractal = fractal()
            ->item($Category)
            ->transformWith(new CategoryTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }

    public function store(StoreCategory $storeTag)
    {

        $Category =  Category::create($storeTag->all());

        $fractal = fractal()
            ->item($Category)
            ->transformWith(new CategoryTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }

    public function update($id, UpdateCategory $CategoryData)
    {

        $Category =  Category::findOrFail($id);

        $Category->title = $CategoryData->title ?? $Category->title;
        $Category->save();

        $fractal = fractal()
            ->item($Category)
            ->transformWith(new CategoryTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }
    public function destroy($id)
    {
        Category::destroy($id);

        return $this->responseData(message: 'Success delete', code: 200);
    }
}
