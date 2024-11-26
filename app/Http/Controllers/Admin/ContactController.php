<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function __construct(private ContactService $service) {}

    public function index(Request $requst)
    {
        // dd($requst->all());
        $requst->validate([
            'type' => 'nullable|in:complaint,query,suggestion',
        ]);

        if (request()->filled('type')) {
            $records = $this->service->filterd($requst->all());
        } else {
            $records = $this->service->all();
        }

        return view('contacts.index', compact('records'));
    }

    public function destroy(string $id)
    {
        $result = $this->service->delete($id);

        if ($result['status']) {
            return redirect()->route('admin.contacts.index')->with('success', 'record deleted successfully');
        }
        return back()->with('error', $result['message']);
    }
}
