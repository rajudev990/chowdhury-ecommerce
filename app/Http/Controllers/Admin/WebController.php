<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StredFast;
use Illuminate\Http\Request;

class WebController extends Controller
{

    public function StreadFastIndex($id)
    {
        $data = StredFast::findOrFail($id);
        return view('admin.stred-fast.index', compact('data'));
    }


    public function StreadFast(Request $request, $id)
    {
        
        // Suppose tumaar model: StredFast
        $input = StredFast::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }
}
