<?php

namespace App\Services\product;

use App\Repositories\product\CategoryRepository;

class CategoryService
{
    private $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function updateOrCreate($category)
    {
        return $this->categoryRepository->updateOrCreate($category);
    }

    public function get()
    {
        return $this->categoryRepository->get();
    }

    public function destroy($id): int
    {
        return $this->categoryRepository->destroy($id);
    }
}
