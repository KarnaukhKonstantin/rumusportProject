<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Tag;

class CategoriesTagsComposer 
{
    protected $categories;
	protected $tags;

	public function __construct()
    {
        $this->tags = Tag::all();
        $this->categories = Category::all();
    }

    public function compose(View $view)
    {
        $view->with([
        	'categories'=>$this->categories,
        	'tags'=>$this->tags,
        ]);
    }
}

?>