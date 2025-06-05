<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleImage extends Component
{
    public $image;
    public $alt;

    public function __construct($image, $alt = null)
    {
        $this->image = $image;
        $this->alt = $alt;
    }

    public function render()
    {
        return view('components.article-image');
    }
}
