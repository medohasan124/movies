<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('permission:settings-read')->only('index');
          $this->middleware('permission:settings-update')->only('update');

     }
    public function index()
    {
        $settings = Setting::get()->first();

        return view("admin.Settings.index",compact('settings'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keyword' => 'required',

        ]);

        $settings = Setting::find($id);
        $settings->name = $request->name;
        $settings->email = $request->email;
        $settings->keyword = $request->keyword;

        if ($request->image) {
            Storage::disk('public')->delete($request->image);
            $settings->image = $request->image->store('settings', 'public');
        }
        $settings->save();
        notify()->success(__('admin.u_settings'));
        return redirect()->route('admin.settings.index');
    }

}
