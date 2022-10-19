<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTag;
use App\Http\Requests\UpdateTag;
use App\Models\Tag;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        //use skip to paginate data
        $skip = $request->has('skip') ? $request->skip : 0;
        $tags = new Tag();
        $count = $tags->count();
        //if not send skip will retarn all data
        if ($request->has('skip')) {
            $tags = $tags->skip($skip)->take(10);
        }
        $tags = $tags->get();
        $fractal = fractal()
            ->collection($tags)
            ->transformWith(new TagTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200, ['count' => $count]);
    }
    public function show($id)
    {
        $tag =  Tag::findOrFail($id);

        $fractal = fractal()
            ->item($tag)
            ->transformWith(new TagTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }

    public function store(StoreTag $storeTag)
    {

        $tag =  Tag::create($storeTag->all());

        $fractal = fractal()
            ->item($tag)
            ->transformWith(new TagTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }

    public function update($id, UpdateTag $updateTag)
    {

        $tag =  Tag::findOrFail($id);

        $tag->title = $updateTag->title ?? $tag->title;
        $tag->save();

        $fractal = fractal()
            ->item($tag)
            ->transformWith(new TagTransformer())
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }
    public function destroy($id)
    {
        Tag::destroy($id);

        return $this->responseData(message: 'Success delete', code: 200);
    }
}
