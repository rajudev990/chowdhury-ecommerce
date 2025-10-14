<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AffiliatesController extends Controller
{

     public function __construct()
    {
        $this->middleware('permission:view affiliate-user')->only('index');
        $this->middleware('permission:create affiliate-user')->only(['create', 'store']);
        $this->middleware('permission:edit affiliate-user')->only(['edit', 'update']);
        $this->middleware('permission:delete affiliate-user')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Affiliate::latest()->get();
        return view('admin.all-users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.all-users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
        $data['image'] = $image;

        $data['password'] = bcrypt($request->password);

        Affiliate::create($data);
        return redirect()->route('admin.all-users.index')->with('success', 'Users Create Successfully');
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
        $data = Affiliate::findOrFail($id);
        return view('admin.all-users.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Affiliate::findOrFail($id);
        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }
        if ($image) {
            $data['image'] = $image;
        }

        $input = $request->except('password');

        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        }
        
        $data->update($input);
        
        return redirect()->route('admin.all-users.index')->with('success', 'Users Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Affiliate::findOrFail($id);
        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        return redirect()->back()->with('success', 'Users Delete Successfully');
    }
}
