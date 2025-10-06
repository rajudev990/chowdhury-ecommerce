<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bkash;
use App\Models\Couriore;
use App\Models\Marketing;
use App\Models\Nagad;
use App\Models\Pathau;
use App\Models\Pixel;
use App\Models\Redx;
use App\Models\Smtp;
use App\Models\SslCommerc;
use App\Models\StredFast;
use Illuminate\Http\Request;

class WebController extends Controller
{

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


    //Payment Setup---------->>>

    public function paymentSetup()
    {
        $bkash = Bkash::first();  
        $nagad = Nagad::first();   
        $sslcz = SslCommerc::first();   

        return view('admin.payment.setup', compact('bkash', 'nagad', 'sslcz'));
    }

    public function bkash(Request $request, $id)
    {
        $bkash = Bkash::findOrFail($id);
        $bkash->update($request->all());
        return redirect()->back()->with('success', 'Bkash updated successfully');
    }

    public function nagad(Request $request, $id)
    {
        $nagad = Nagad::findOrFail($id);
        $nagad->update($request->all());
        return redirect()->back()->with('success', 'Nagad updated successfully');
    }

    public function sslcz(Request $request, $id)
    {
        $nagad = SslCommerc::findOrFail($id);
        $nagad->update($request->all());
        return redirect()->back()->with('success', 'SSLcommerz updated successfully');
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


    //CURIORE--------->>>

    public function curiore()
    {
        $stredfast = StredFast::first();   
        $pathau = Pathau::first();   
        $redx = Redx::first();   
        $curiore = Couriore::first();  

        return view('admin.curiore.setup', compact('stredfast', 'pathau', 'curiore', 'redx'));
    }

    public function stredfast(Request $request, $id)
    {
        $stredfast = StredFast::findOrFail($id);
        $stredfast->update($request->all());
        return redirect()->back()->with('success', 'StredFast updated successfully');
    }

    public function pathau(Request $request, $id)
    {
        $pathau = Pathau::findOrFail($id);
        $pathau->update($request->all());
        return redirect()->back()->with('success', 'Pathau updated successfully');
    }

    public function redx(Request $request, $id)
    {
        $redx = Redx::findOrFail($id);
        $redx->update($request->all());
        return redirect()->back()->with('success', 'REDX updated successfully');
    }

    public function curiores(Request $request, $id)
    {
        $curiore = Couriore::findOrFail($id);
        $curiore->update($request->all());
        return redirect()->back()->with('success', 'Curiore updated successfully');
    }
}
