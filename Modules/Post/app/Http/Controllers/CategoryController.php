<?php

namespace Modules\Post\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Post\Http\Requests\Category\StoreRequest;
use Modules\Post\Http\Requests\Category\UpdateRequest;
use Modules\Post\Models\Category;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::query()
        ->latest('id')
        ->paginate();

        return response()->success('',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $category = Category::query()->create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
        ]);

        return response()->success('دسته بندی با موفقیت ثبت شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,$id)
    {
        $category = Category::query()->findOrFail($id);
        $category->update([
            'name' => $request->name,
            'status' => $request->input('status'),
        ]);

        return response()->success('دسته بندی با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();

        return response()->success('دسته بندی با موفقیت حذف شد.');
    }
}
