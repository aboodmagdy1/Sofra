<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardClientService;
use Illuminate\Http\Request;

class DashboardClientController extends Controller
{
    public function __construct(private DashboardClientService $service) {}

    public function index(Request $request)
    {
        // if serach : then get one record
        if ($request->filled('name')) {
            $records = $this->service->filterd(['name' => $request->name]);
        } else {
            $records = $this->service->all();
        }
        return view('clients.index', compact('records'));
    }

    public function show(string $id)
    {
        $result  = $this->service->find($id);
        if (!$result['status']) {
            return redirect()->route('admin.clients.index')->with('error', $result['message']);
        }

        return view('clients.show', ['record' => $result['data']]);
    }
    public function update(string $id)
    {

        $result = $this->service->update($id, [
            'is_active' => request('is_active')
        ]);
        if (!$result['status']) {
            return redirect()->route('admin.clients.index')->with('error', $result['message']);
        }
        return redirect(route('admin.clients.index'))->with('success', 'Record updated successfully');
    }
    public function destroy(string $id)
    {
        $result  = $this->service->delete($id);
        if (!$result['status']) {
            return redirect()->route('admin.clients.index')->with('error', $result['message']);
        }

        return redirect(route('admin.clients.index'))->with('success', 'Record deleted successfully');
    }
}
