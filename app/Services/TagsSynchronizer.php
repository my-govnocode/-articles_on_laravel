<?php

namespace App\Services;

use App\Models\Tag;

class TagsSynchronizer
{
  public function sync( $tags, $model)
  {
        $articleTags = $model->tags->keyBy('name');

        $tag = collect(explode(',', $tags))->keyBy(fn ($item) => $item);

        $tagsToAttach = $tag->diffKeys($articleTags);

        $syncIds = $articleTags->intersectByKeys($tag)->pluck('id')->toArray();

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }
        $model->tags()->sync($syncIds);
  }
}