<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreatePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Services\Admin\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(private  PermissionService $service) {}

    public function index()
    {
        $records = $this->service->all();
        return view('permissions.index', compact('records'));
    }
    public function create()
    {
        return view('permissions.create');
    }

    public function store(CreatePermissionRequest $request)
    {
        $result = $this->service->create($request->all());
        if ($result['status']) {
            return redirect()->route('admin.permissions.index')->with('success', 'Record created successfully');
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function edit(string $id)
    {
        $result = $this->service->find($id);
        if ($result['status']) {
            return view('permissions.edit', ['record' => $result['data']]);
        }
        return redirect()->back()->with('error', $result['message']);
    }
    public function update(UpdatePermissionRequest $request, string $id)
    {
        $result = $this->service->update($id, $request->validated());
        if ($result['status']) {
            return redirect()->route('admin.permissions.index')->with('success', 'Record updated successfully');
        }
        return redirect()->back()->with('error', $result['message']);
    }

    public function destroy(string $id)
    {
        $result = $this->service->delete($id);
        if ($result['status']) {
            return redirect()->route('admin.permissions.index')->with('success', 'Record deleted successfully');
        }
        return redirect()->back()->with('error', $result['message']);
    }
}
