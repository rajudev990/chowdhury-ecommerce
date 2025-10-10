<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Bannar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Bannar::first();
        return view('admin.bannar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Bannar::findOrFail($id);
        $image =$request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')): '';

        if($request->hasFile('image') && $data->image){
            Storage::disk('public')->delete($data->imgae);
        };

        $input=$request->all();

        if($image){
            $data ['image'] = $image;
        }
        $data->update($input);

        return redirect()->back()->with('success', 'Banner updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
