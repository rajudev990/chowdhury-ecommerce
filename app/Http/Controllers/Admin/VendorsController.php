<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $data = Vendor::latest()->get();
        return view('admin.all-sellers.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.all-sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $logo = $request->hasFile('logo') ? ImageHelper::uploadImage($request->file('logo')) : null;
        $banner = $request->hasFile('banner') ? ImageHelper::uploadImage($request->file('banner')) : null;
        $data['logo'] = $logo;
        $data['banner'] = $banner;

        $data['password'] = Hash::make($request->password);

        Vendor::create($data);
        return redirect()->route('admin.all-sellers.index')->with('success', 'Sellers Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Vendor::findOrFail($id);
        return view('admin.all-sellers.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Vendor::findOrFail($id);
        $logo = $request->hasFile('logo') ? ImageHelper::uploadImage($request->file('logo')) : null;
        $banner = $request->hasFile('banner') ? ImageHelper::uploadImage($request->file('banner')) : null;

        if ($request->hasFile('logo') && $data->logo) {
            Storage::disk('public')->delete($data->logo);
        }
         if ($request->hasFile('banner') && $data->banner) {
            Storage::disk('public')->delete($data->banner);
        }

        $input = $request->all();

        if ($logo) {
            $input['logo'] = $logo;
        }
        if ($banner) {
            $input['banner'] = $banner;
        }

        if($request->password)
        {
            $input['password'] = Hash::make($request->password);
            $data->update($input);
        }else{
            $data->update($input);
        }
        return redirect()->route('admin.all-sellers.index')->with('success', 'Sellers Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Vendor::findOrFail($id);

        if ($data->logo) {
            Storage::disk('public')->delete($data->logo);
        }
         if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();
        return redirect()->back()->with('success', 'Sellers Delete Successfully');
    }
}
