<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryInterface $category
    )
    {
        $this->breadcrumb[] = [
            'page' => '/',
            'title' => 'Trang chủ',
        ];
    }

    public function index()
    {
        $this->breadcrumb[] = [
            'title' => 'Danh mục sản phẩm',
        ];
        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title' => 'Danh mục sản phẩm..'
        ];
        return view('pages.categories.index', $data_view);
    }

    public function getAll(): JsonResponse
    {
        $categories = $this->category->getModel()->get();

        $categories->prepend([
            'id' => 0,
            'parent_id' => -1,
            'name' => 'Danh mục'
        ]);

        return $this->response($categories, 'Lấy dữ liệu thành công!');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(['id', 'name','parent_id', 'description', 'status', 'seo_slug', 'seo_title', 'seo_description']);
        $category = $this->category->getModel()->updateOrCreate([
            'id' => $data['id']
        ], $data);
        return $this->response($category, 'Đã cập nhật các thay đổi');
    }

    public function destroy($category_id): JsonResponse
    {
        $this->category->destroy($category_id);
        return $this->response(null, 'Đã xoá danh mục thành công!');
    }
}
