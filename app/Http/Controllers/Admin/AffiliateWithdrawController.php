<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateWithdraw;
use Illuminate\Http\Request;

class AffiliateWithdrawController extends Controller
{
     public function __construct()
    {
        $this->middleware('permission:view affiliate-withdraw')->only('index');
        $this->middleware('permission:create affiliate-withdraw')->only(['create', 'store']);
        $this->middleware('permission:edit affiliate-withdraw')->only(['edit', 'update']);
        $this->middleware('permission:delete affiliate-withdraw')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    // Display the list of withdrawals with filters
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending'); // ডিফল্ট pending

        $withdrawals = AffiliateWithdraw::where('status', $status)->get();

        return view('admin.all-users.withdraw.index', compact('withdrawals', 'status'));
    }


        // Update the status of the withdrawal request
        public function updateStatus(Request $request, $id)
        {
            $withdraw = AffiliateWithdraw::findOrFail($id);
            $withdraw->status = $request->status;
            $withdraw->save();

            return response()->json(['success' => true]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
