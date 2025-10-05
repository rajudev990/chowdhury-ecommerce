<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Couriore;
use App\Models\Pathau;
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
        
        
        $input = StredFast::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }


    // Curiore

     public function CuriorIndex($id)
    {
        $data = Couriore::findOrFail($id);
        return view('admin.curiore.index', compact('data'));
    }


    public function Curiore(Request $request, $id)
    {
        
        
        $input = Couriore::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }



    // Pathau

     public function pathauIndex($id)
    {
        $data = Pathau::findOrFail($id);
        return view('admin.pathau.index', compact('data'));
    }


    public function pathau(Request $request, $id)
    {
        
        $input = Pathau::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }
}
