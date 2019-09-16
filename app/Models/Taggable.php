<?php


namespace App\Models;


trait Taggable
{
    public function tags() {
        return $this->morphMany('App\\Models\\Tag', 'taggable');
    }

    public function activeTag() {
        return $this->tags()->whereActive(true)->first();
    }

    public function setTag($name, $tag, $campaign = null) {
        if($this->activeTag() && $this->activeTag()->tag == $tag)
            return $this->activeTag();

        $this->tags()->update(['active' => false]);

        return $this->tags()->create([
            'name' => $name,
            'tag' => $tag,
            'campaign_id' => $campaign ? $campaign->id : null,
            'active' => true
        ]);
    }

    public function generateTag() {
        return $this->setTag($this->getName(), $this->generateSlug(), $this->getCampaign());
    }
}