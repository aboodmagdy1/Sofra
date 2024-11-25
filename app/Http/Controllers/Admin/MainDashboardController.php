<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use GPBMetadata\Google\Type\Decimal;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Decimal as TypeDecimal;

use function App\Helpers\settings;

class MainDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function appSettings()
    {
        $record = Setting::first();
        return view('admin.settings', compact('record'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'about' => 'required|string',
            'commission' => 'required|numeric|min:0|max:70',
        ]);
        try {
            $record = Setting::first();
            $record->commission = (+$request->input('commission'));
            $record->about = $request->input('about');
            $record->save();

            return back()->with('success', "Settings Updated ");
        } catch (QueryException $e) {
            return back()->with('error', 'database error , please try again');
        } catch (Exception $e) {
            return back()->with('error', 'failed to update settings , try again ');
        }
    }
}
