<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $service) {}
    public function index()
    {

        $records = $this->service->filterd(request('filters', []));
        return view('users.index', compact('records'));
    }

    public function create()
    {

        return view('users.create');
    }
    public function store(CreateUserRequest $request)
    {
        $result = $this->service->create($request->validated());
        if ($result['status']) {
            return redirect()->route('users.index')->with('success', 'User created successfully');
        }
        return back()->with('error', $result['message']);
    }

    public function edit(string $id)
    {
        $result = $this->service->find($id);
        if ($result['status']) {
            return view('users.edit', ['record' => $result['data']]);
        }
        return back()->with('error', $result['message']);
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $result = $this->service->update($id, $request->validated());
        if ($result['status']) {
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        }
        return back()->with('error', $result['message']);
    }
    public function destroy(string $id)
    {
        $result = $this->service->delete($id);
        if ($result['status']) {
            return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
        }
        return back()->with('error', $result['message']);
    }
}
