<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAd;
use App\Http\Requests\UpdateAd;
use App\Models\Ad;
use App\Transformers\AdTransformer;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        //use skip to paginate data
        $skip = $request->has('skip') ? $request->skip : 0;
        $ads = new Ad();

        if ($request->has('type')) {
            $ads = $ads->where('type', $request->type);
        }
        if ($request->has('category_id')) {
            $ads = $ads->where('category_id', $request->category_id);
        }
        if ($request->has('user_id')) {
            $ads = $ads->where('user_id', $request->user_id);
        }
        if ($request->has('tag_id')) {
            $ads = $ads->wherehas('tags', function ($q) use ($request) {
                return $q->where('tag_id', $request->tag_id);
            });
        }
        $count = $ads->count();
        //if not send skip will retarn all data
        if ($request->has('skip')) {
            $ads = $ads->skip($skip)->take(10);
        }
        $ads = $ads->with(['user', 'category', 'tags'])->get();
        $fractal = fractal()
            ->collection($ads)
            ->transformWith(new AdTransformer())
            ->includeTags()
            ->toArray();
        return $this->responseData('Success', $fractal, 200, ['count' => $count]);
    }
    public function show($id)
    {
        $ad =  Ad::findOrFail($id);

        $fractal = fractal()
            ->item($ad)
            ->transformWith(new AdTransformer())
            ->includeTags()
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }

    public function store(StoreAd $storeAd)
    {

        $ad =  Ad::create([

            'type' => $storeAd->type,
            'title' => $storeAd->title,
            'description' => $storeAd->description,
            'category_id' => $storeAd->category_id,
            'user_id' => $storeAd->user_id,
            'start_date' => $storeAd->start_date,
        ]);
        $ad->tags()->attach($storeAd->tags);

        $fractal = fractal()
            ->item($ad)
            ->transformWith(new AdTransformer())
            ->includeTags()
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }

    public function update($id, UpdateAd $updateAd)
    {

        $ad =  Ad::findOrFail($id);

        $ad->title          = $updateAd->title ?? $ad->title;
        $ad->description    = $updateAd->description ?? $ad->description;
        $ad->type           = $updateAd->type ?? $ad->type;
        $ad->category_id    = $updateAd->category_id ?? $ad->category_id;
        $ad->user_id        = $updateAd->user_id ?? $ad->user_id;
        $ad->start_date     = $updateAd->start_date ?? $ad->start_date;
        $ad->save();

        if ($updateAd->has('tags')) {
            $ad->tags()->sync($updateAd->tags);
        }
        $fractal = fractal()
            ->item($ad)
            ->transformWith(new AdTransformer())
            ->includeTags()
            ->toArray();
        return $this->responseData('Success', $fractal, 200);
    }
    public function destroy($id)
    {
        Ad::destroy($id);

        return $this->responseData(message: 'Success delete', code: 200);
    }
}
