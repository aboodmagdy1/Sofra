<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct(private  RoleService $service) {}

    public function index()
    {
        $records = $this->service->all();
        return view('roles.index', compact('records'));
    }
    public function create()
    {
        return view('roles.create');
    }

    public function store(CreateRoleRequest $request)
    {

        $result = $this->service->create($request->validated());
        if ($result['status']) {
            return redirect()->route('admin.roles.index')->with('success', 'Record created successfully');
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function edit(string $id)
    {
        $result = $this->service->find($id);
        if ($result['status']) {
            return view('roles.edit', ['record' => $result['data']]);
        }
        return redirect()->back()->with('error', $result['message']);
    }
    public function update(UpdateRoleRequest $request, string $id)
    {
        $result = $this->service->update($id, $request->validated());
        if ($result['status']) {
            return redirect()->route('admin.roles.index')->with('success', 'Record updated successfully');
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function destroy(string $id)
    {
        $result = $this->service->delete($id);
        if ($result['status']) {
            return redirect()->route('admin.roles.index')->with('success', 'Record deleted successfully');
        }
        return redirect()->back()->with('error', $result['message']);
    }
}
