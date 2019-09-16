<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $taggable = $this->taggable;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tag' => $this->tag,
            'campaign' => $this->campaign ? $this->campaign->name : null,
            'taggable' => [
                'name' => $taggable->getName(),
                'type' => $taggable->getType(),
                'image' => $taggable->getImage(),
                'url' => $taggable->formattedLink()
            ]
        ];
    }
}
