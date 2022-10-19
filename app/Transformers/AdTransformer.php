<?php

namespace App\Transformers;

use App\Models\Ad;
use League\Fractal\TransformerAbstract;

class AdTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'category', 'tags'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Ad $ad)
    {

        return [
            'id' => $ad->id,
            'type' => $ad->type,
            'title' => $ad->title,
            'description' => $ad->description,
            'category_id' => $ad->category_id,
            'category_title' => $ad->category->title,
            'user_id' => $ad->user_id,
            'user_name' => $ad->user->name,
            'start_date' => $ad->start_date,
        ];
    }
    public function includeCategory(Ad $ad)
    {
        return $this->item($ad->category, new CategoryTransformer());
    }
    public function includeTags(Ad $ad)
    {
        return $this->collection($ad->tags, new TagTransformer());
    }
}
