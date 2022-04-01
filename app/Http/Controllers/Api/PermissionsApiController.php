<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsApiController extends Controller
{
    use ApiResponser;

    public function index()
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::orderby('created_at', 'DESC')->get();
        return $this->success(['permissions' => $permissions]);
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());

        return $this->success(['permission' => $permission], 'Permission created successfully');
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $this->success(['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update($request->all());

        return $this->success(['permission' => $permission], 'Permission Updated successfully');
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();
        return $this->success('', 'Permission deleted Successfully');
    }
}
