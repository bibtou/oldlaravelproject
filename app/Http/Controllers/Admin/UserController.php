<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\RequestManageUser;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('blog.admin.user.index', ['items' => $user->with(['articles', 'categories'])->latest('created_at')->simplePaginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $route = route('blog.admin.user.store');
		$roles = Role::all();
		
		return view('blog.admin.user.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestManageUser $request)
    {
        //
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
    public function edit(User $user)
    {
		$route = route('blog.admin.user.update', ['user' => $user->id]);
		$roles = Role::all();

        return view('blog.admin.user.create', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestManageUser $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
		$name = NULL;

		if(empty($user)) {
			$status = 'user_failed';
		} else {
			$name = $user->name;

			if($user->articles->count() > 0) {
				$status = 'failed_user_has_articles';
			} elseif($user->categories->count() > 0) {
				$status = 'failed_user_has_categories';
			} else {
				$user->delete();
				$status = 'user_success';
			}
		}

		return redirect()->route('blog.admin.user.index')->with($status, $name ?? '');
    }
}
