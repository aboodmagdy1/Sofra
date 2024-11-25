<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Services\Admin\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct(private PaymentMethodService $service) {}

    public function index()
    {
        $records = $this->service->all();
        return view('paymentMethods.index', compact('records'));
    }


    public function create()
    {
        return view('paymentMethods.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $result = $this->service->create($request->only(['name']));
        if ($result['status']) {
            return redirect(route('admin.payment-methods.index'))->with('success', "record Created successfuly ");
        }
        return back()->with('error', $result['message']);
    }
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('paymentMethods.edit', ['record' => $paymentMethod]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $result = $this->service->update($id, $request->only(['name']));
        if ($result['status']) {
            return redirect(route('admin.payment-methods.index'))->with('success', "record updated successfuly ");
        }
        return back()->with('error', $result['message']);
    }


    public function destroy(string $id)
    {


        $result = $this->service->delete($id);
        record:
        if ($result['status']) {
            return redirect(route('admin.payment-methods.index'))->with('success', "record Deleted successfuly ");
        }
        return back()->with('error', $result['message']);
    }
}
