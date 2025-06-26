<?php

namespace App\Livewire\Utils;

use Illuminate\Support\Str;

trait Slug
{
    /**
     * Generate a slug from the given string.
     *
     * @return string
     */
    public function generateSlug(): void
    {
        if (property_exists($this, 'title')) {
            $this->slug = Str::slug($this->title);
        }
    }
}
