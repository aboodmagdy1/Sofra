<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commision;
use App\Services\Admin\CommisionService;
use Illuminate\Http\Request;

class CommisionController extends Controller
{

    public function __construct(private CommisionService $service) {}
    public function index()
    {
        $records = $this->service->all();
        return view('commisions.index', compact('records'));
    }

    public function create()
    {
        return view('commisions.create');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'details' => 'required|string',
            'amount' => 'required|decimal:0,8',
            'restaurant_id' => 'required|exists:restaurants,id'

        ]);
        // create
        $result = $this->service->create($request->only('details', 'amount', 'restaurant_id'));
        if ($result['status']) {
            return redirect(route('admin.commisions.index'))->with('success', 'Record Created Successfuly');
        }

        return back()->with('error', 'Error Creating Record');
    }

    public function edit(Commision $commision)
    {
        return view('commisions.edit', ['record' => $commision]);
    }

    public function update(Request $request, string $id)
    {
        // 1) validate
        $request->validate([
            'details' => 'required|string',
            'amount' => 'required|decimal:0,8',
            'restaurant_id' => 'required|exists:restaurants,id'

        ]);
        // 2) update
        $result = $this->service->update($id, $request->only('details', 'amount', 'restaurant_id'));
        if ($result['status']) {
            return redirect(route('admin.commisions.index'));
        }

        return back()->with($result['message']);
    }

    public function destroy(string $id)
    {
        $result = $this->service->delete($id);
        if ($result['status']) {
            return redirect(route('admin.commisions.index'))->with('success', 'City deleted');
        }
        return back()->with('error', $result['message']);
    }
}
