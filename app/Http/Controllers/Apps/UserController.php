<?php

namespace App\Http\Controllers\Apps;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{

    /**
     * Define middleware for the UserController.
     *
     * @return array
     */
    public static function middleware()
    {
        return [
            new Middleware('permission:users-data', only: ['index']),
            new Middleware('permission:users-create', only: ['create', 'store']),
            new Middleware('permission:users-update', only: ['update', 'edit']),
            new Middleware('permission:users-destroy', only: ['destroy']),
            new Middleware('permission:users-show', only: ['show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // request page data
        $currentPage = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // get all user data
        $users = User::query()
            ->with(['roles' => function ($query) {
                $query->with(['permissions' => function ($query) {
                    $query->select('id', 'name');
                }])->select('id', 'name');
            }])
            ->select('id', 'name', 'username', 'email', 'avatar')
            ->when($request->search, fn($search) => $search->where('name', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate($perPage, ['*'], 'page', $currentPage)->withQueryString();

        // render view
        return inertia('apps/users/index', [
            'users' => $users,
            'currentPage' => $currentPage,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get all role data
        $roles = Role::query()
            ->with('permissions')
            ->select('id', 'name')
            ->where('name', '!=', 'super-admin')
            ->get();

        // render view
        return inertia('apps/users/create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // assign role to user
        $user->assignRole($request->selectedRoles);

        // render view
        return to_route('apps.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // load relationship
        $user->load('roles', 'roles.permissions');

        // render view
        return inertia('apps/users/show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // get all role data
        $roles = Role::query()
            ->with('permissions')
            ->select('id', 'name')
            ->where('name', '!=', 'super-admin')
            ->get();

        // load relationship
        $user->load(['roles' => fn($query) => $query->select('id', 'name'), 'roles.permissions' => fn($query) => $query->select('id', 'name')]);

        // render view
        return inertia('apps/users/edit', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        // check if user send request password
        if ($request->password)
            // update user data password
            $user->update([
                'password' => bcrypt($request->password),
            ]);

        // update user data name
        $user->update([
            'username' => $request->username,
            'name' => $request->name,
        ]);

        // assign role to user
        $user->syncRoles($request->selectedRoles);

        // render view
        return to_route('apps.users.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // delete user data
        $user->delete();

        // render view
        return back();
    }
}
