<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index()
    {
        $records = $this->service->all();
        return view('categories.index', compact('records'));
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $result = $this->service->create($request->only(['name']));
        if ($result['status']) {
            return redirect(route('admin.categories.index'))->with('success', "record Created successfuly ");
        }
        return back()->with('error', $result['message']);
    }
    public function edit(Category $category)
    {
        return view('categories.edit', ['record' => $category]);
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $result = $this->service->update($category, $request->only(['name']));
        if ($result['status']) {
            return redirect(route('admin.categories.index'))->with('success', "record updated successfuly ");
        }
        return back()->with('error', $result['message']);
    }


    public function destroy(string $id)
    {


        $result = $this->service->delete($id);
        record:
        if ($result['status']) {
            return redirect(route('admin.categories.index'))->with('success', "record Deleted successfuly ");
        }
        return back()->with('error', $result['message']);
    }
}
