<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    use ApiResponser;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::with(['roles', 'pharmacy'])->get();
        return $this->success(['users' => $users]);
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return $this->success(['user' => $user], 'Role created successfully');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $this->success(['user' => $user->load(['roles', 'pharmacy'])]);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return $this->success(['user' => $user], 'Role updated successfully');
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return $this->success('', 'User deleted Successfully');
    }
}
