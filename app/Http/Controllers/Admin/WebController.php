<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bkash;
use App\Models\Couriore;
use App\Models\Facebook;
use App\Models\Google;
use App\Models\Marketing;
use App\Models\Nagad;
use App\Models\Pathau;
use App\Models\Pixel;
use App\Models\Redx;
use App\Models\Smtp;
use App\Models\SslCommerc;
use App\Models\StredFast;
use App\Models\TagManager;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view smtp')->only('index');
        $this->middleware('permission:create smtp')->only(['create', 'store']);
        $this->middleware('permission:edit smtp')->only(['edit', 'update']);
        $this->middleware('permission:delete smtp')->only('destroy');

        $this->middleware('permission:view courier')->only('index');
        $this->middleware('permission:create courier')->only(['create', 'store']);
        $this->middleware('permission:edit courier')->only(['edit', 'update']);
        $this->middleware('permission:delete courier')->only('destroy');

        $this->middleware('permission:view marketing')->only('index');
        $this->middleware('permission:create marketing')->only(['create', 'store']);
        $this->middleware('permission:edit marketing')->only(['edit', 'update']);
        $this->middleware('permission:delete marketing')->only('destroy');

        $this->middleware('permission:view payment')->only('index');
        $this->middleware('permission:create payment')->only(['create', 'store']);
        $this->middleware('permission:edit payment')->only(['edit', 'update']);
        $this->middleware('permission:delete payment')->only('destroy');
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



    //Marketing
    
    public function marketingSetup()
    {
        $facebook = Facebook::first();  
        $google = Google::first();   
        $tagManager = TagManager::first();   

        return view('admin.marketing.setup', compact('facebook', 'google','tagManager'));
    }

    public function facebook(Request $request, $id)
    {
        $facebook = Facebook::findOrFail($id);
        $facebook->update($request->all());
        return redirect()->back()->with('success', 'Facebook updated successfully');
    }

    public function google(Request $request, $id)
    {
        $google = Google::findOrFail($id);
        $google->update($request->all());
        return redirect()->back()->with('success', 'Google updated successfully');
    }

    public function TagManager(Request $request, $id)
    {
        $tagManager = TagManager::findOrFail($id);
        $tagManager->update($request->all());
        return redirect()->back()->with('success', 'Google Tag Manager updated successfully');
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
