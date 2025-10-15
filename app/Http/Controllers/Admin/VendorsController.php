<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorWithdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class VendorsController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:view sellers')->only('index');
        $this->middleware('permission:create sellers')->only(['create', 'store']);
        $this->middleware('permission:edit sellers')->only(['edit', 'update']);
        $this->middleware('permission:delete sellers')->only('destroy');
    }
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

        // Validation
        $request->validate([
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|string|max:20',
            'country' => 'nullable|string|max:100',
            'shop_name' => 'required|string|max:255|unique:vendors,shop_name',
            'password' => 'required|string|min:3|',
    
        ]);

        $data = $request->all();

        $logo = $request->hasFile('logo') ? ImageHelper::uploadImage($request->file('logo')) : null;
        $banner = $request->hasFile('banner') ? ImageHelper::uploadImage($request->file('banner')) : null;
        $data['logo'] = $logo;
        $data['banner'] = $banner;

        $data['password'] = bcrypt($request->password);

        // Generate Shop Slug
        $data['shop_slug'] = Str::slug($request->shop_name);
        $data['name'] = $request->shop_name;


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

        // Validation
        $request->validate([
            'email' => 'required|email|unique:vendors,email,' . $data->id,
            'phone' => 'required|string|max:20',
            'country' => 'nullable|string|max:100',
            'shop_name' => 'required|string|max:255|unique:vendors,shop_name,' . $data->id,
            'password' => 'nullable|string|min:3|', // optional, only if changing
        ]);


        $logo = $request->hasFile('logo') ? ImageHelper::uploadImage($request->file('logo')) : null;
        $banner = $request->hasFile('banner') ? ImageHelper::uploadImage($request->file('banner')) : null;

        if ($request->hasFile('logo') && $data->logo) {
            Storage::disk('public')->delete($data->logo);
        }
         if ($request->hasFile('banner') && $data->banner) {
            Storage::disk('public')->delete($data->banner);
        }

        $input = $request->except('password');

        if ($logo) {
            $input['logo'] = $logo;
        }
        if ($banner) {
            $input['banner'] = $banner;
        }

      

        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        }

         // Generate Shop Slug
        $data['shop_slug'] = Str::slug($request->shop_name);
        $data['name'] = $request->shop_name;

        $data->update($input);

    
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

    // Withdrawal
    public function sellersWithdrawal(Request $request)
    {
        $status = $request->query('status', 'pending'); // ডিফল্ট pending

        $withdrawals = VendorWithdraw::where('status', $status)->get();

        return view('admin.all-sellers.withdraw.index', compact('withdrawals', 'status'));
    }

    // Update the status of the withdrawal request
    public function updateStatus(Request $request, $id)
    {
        $withdraw = VendorWithdraw::findOrFail($id);
        $withdraw->status = $request->status;
        $withdraw->save();

        return response()->json(['success' => true]);
    }
}
