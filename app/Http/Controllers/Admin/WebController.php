<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bkash;
use App\Models\Couriore;
use App\Models\Marketing;
use App\Models\Pathau;
use App\Models\Pixel;
use App\Models\Redx;
use App\Models\Smtp;
use App\Models\StredFast;
use Illuminate\Http\Request;

class WebController extends Controller
{

    //Stred..............>>
    
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


    // Curiore................>>
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



    // Pathau..................>>
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

     // SMTP...............>>

     public function smtpindex($id)
    {
        $data = Smtp::findOrFail($id);
        return view('admin.smtp.index', compact('data'));
    }


    public function smtp(Request $request, $id)
    {
        
        $input = Smtp::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }

     // Pixel...............>>

     public function pixelindex($id)
    {
        $data = Pixel::findOrFail($id);
        return view('admin.pixel.index', compact('data'));
    }


    public function pixel(Request $request, $id)
    {
        
        $input = Pixel::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }

     // REDX...............>>

     public function redxindex($id)
    {
        $data = Redx::findOrFail($id);
        return view('admin.redx.index', compact('data'));
    }

    public function redx(Request $request, $id)
    {  
        $input = Redx::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }

     // BKASH...............>>
     
     public function bkashindex($id)
    {
        $data = Bkash::findOrFail($id);
        return view('admin.bkash.index', compact('data'));
    }

    public function bkash(Request $request, $id)
    {  
        $input = Bkash::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }

    // Marketing...............>>
     
     public function marketingindex($id)
    {
        $data = Marketing::findOrFail($id);
        return view('admin.marketing.index', compact('data'));
    }

    public function marketing(Request $request, $id)
    {  
        $input = Marketing::findOrFail($id);
        $data = $request->all();

        $input->update($data);

        return redirect()->back()->with('success', 'Updated successfully');
    }
}
