<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\RequestManageCategory;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $items = $category->with(['user', 'articles'])
			->withCount('articles')
			->simplePaginate();
			
		return view('blog.admin.category.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $route = route('blog.admin.category.store');

		return view('blog.admin.category.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestManageCategory $request, Category $category)
    {
		$validated = (object) $request->validated();
		$category->title = $validated->title;
		$category->slug = Str::slug($validated->slug);
		$category->description = $validated->description;
		$category->user_id = auth()->user()->id;
		$category->save();
		
		return response()->json([
			'category_id' => $category->id,
			'created_at' => $category->created_at
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
		$route = route('blog.admin.category.update', ['category' => $category->id]);

        return view('blog.admin.category.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestManageCategory $request, Category $category)
    {
		try {
			$validated = (object) $request->validated();
			$category->title = $validated->title;
			$category->slug = Str::slug($validated->slug);
			$category->description = $validated->description;
			$category->user_id = auth()->user()->id;
			$category->save();
		} catch (\Exception $ex) {
			exit($ex->getMessage());
			return redirect()->route('blog.admin.category.edit', ['category' => $category->id])
				->withErrors(['error_update' => $ex->getMessage()])
				->withInput();
		}
		
		return response()->json([
			'category_id' => $category->id,
			'updated_at' => $category->updated_at
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$category = Category::find($id);

		if(empty($category)) {
			$status = 'failed_category';
		} else {
			if($category->articles->count() > 0) {
				$status = 'failed_category_has_articles';
			} else {
				$status = 'success_category';
				$category->delete();
			}
		}
//exit($status);
		return redirect()->route('blog.admin.category.index')->with($status, $category->title ?? '');
    }
}
