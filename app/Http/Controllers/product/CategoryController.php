<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Services\product\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $breadcrumb = [];
    private $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->breadcrumb[] = [
            'page'=>'/',
            'title'=>'Trang chủ',
        ];

        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $this->breadcrumb[] = [
            'title'=>'Danh mục sản phẩm',
        ];
        $data_view = [
            'breadcrumbs' => $this->breadcrumb,
            'page_title'=>'Danh mục sản phẩm..'
        ];
        return view('pages.categories.index',$data_view);
    }

    public function getAll()
    {
        $categories = $this->categoryService->get();
        return $this->res($categories,'Lấy dữ liệu thành công!');
    }
    public function store(Request $request): JsonResponse
    {
        $data = $request->only(['id','name','description','status','seo_slug','seo_title','seo_description']);
        $category = $this->categoryService->updateOrCreate($data);
        return $this->res($category,'Đã cập nhật các thay đổi');
    }

    public function destroy($category_id)
    {
        $this->categoryService->destroy($category_id);
        return $this->res(null,'Đã xoá danh mục thành công!');
    }
    private function res($data = null, $message = '', $status = 1): JsonResponse
    {
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data,
        ]);
    }
}
