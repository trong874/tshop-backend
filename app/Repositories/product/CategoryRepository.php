<?php

namespace App\Repositories\product;

use App\Models\Category;

class CategoryRepository
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function updateOrCreate($category)
    {
        return $this->category->updateOrCreate([
            'id'=>$category['id'],
        ], $category);
    }

    public function destroy($category_id): int
    {
        return $this->category->destroy($category_id);
    }

    public function get()
    {
        return $this->category->query()->get();
    }
}
