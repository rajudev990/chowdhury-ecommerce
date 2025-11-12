<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Camping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CampingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $data = Camping::latest()->get();
        return view('admin.camping.index', compact('data'));
    }

    public function create()
    {
        return view('admin.Camping.create');
    }

    public function store(Request $request)
    {
        $data= $request->all();

        $logo = $request->hasFile('logo') ? ImageHelper::uploadImage($request->file('logo')) : null;
        $bannar = $request->hasFile('bannar') ? ImageHelper::uploadImage($request->file('bannar')) : null;
        $bannar_1 = $request->hasFile('bannar_1') ? ImageHelper::uploadImage($request->file('bannar_1')) : null;
        $bannar_2 = $request->hasFile('bannar_2') ? ImageHelper::uploadImage($request->file('bannar_2')) : null;
        $bannar_3 = $request->hasFile('bannar_3') ? ImageHelper::uploadImage($request->file('bannar_3')) : null;
        $bannar_4 = $request->hasFile('bannar_4') ? ImageHelper::uploadImage($request->file('bannar_4')) : null;
        $bannar_5 = $request->hasFile('bannar_5') ? ImageHelper::uploadImage($request->file('bannar_5')) : null;
        $bannar_6 = $request->hasFile('bannar_6') ? ImageHelper::uploadImage($request->file('bannar_6')) : null;
        $bannar_7 = $request->hasFile('bannar_7') ? ImageHelper::uploadImage($request->file('bannar_7')) : null;
        $bannar_8 = $request->hasFile('bannar_8') ? ImageHelper::uploadImage($request->file('bannar_8')) : null;
        $bannar_9 = $request->hasFile('bannar_9') ? ImageHelper::uploadImage($request->file('bannar_9')) : null;
        $bannar_10 = $request->hasFile('bannar_10') ? ImageHelper::uploadImage($request->file('bannar_10')) : null;
        $image_1 = $request->hasFile('image_1') ? ImageHelper::uploadImage($request->file('image_1')) : null;
        $image_2 = $request->hasFile('image_2') ? ImageHelper::uploadImage($request->file('image_2')) : null;
        $image_3 = $request->hasFile('image_3') ? ImageHelper::uploadImage($request->file('image_3')) : null;
        $why_buy_image = $request->hasFile('why_buy_image') ? ImageHelper::uploadImage($request->file('why_buy_image')) : null;
        $about_image = $request->hasFile('about_image') ? ImageHelper::uploadImage($request->file('about_image')) : null;

        if($logo){
            $data['logo']=$logo;
        }
        if($bannar){
            $data['bannar']=$bannar;
        }
        if($bannar_1){
            $data['bannar_1']=$bannar_1;
        }
        if($bannar_2){
            $data['bannar_2']=$bannar_2;
        }
        if($bannar_3){
            $data['bannar_3']=$bannar_3;
        }
        if($bannar_4){
            $data['bannar_4']=$bannar_4;
        }
        if($bannar_5){
            $data['bannar_5']=$bannar_5;
        }
        if($bannar_6){
            $data['bannar_6']=$bannar_6;
        }
        if($bannar_7){
            $data['bannar_7']=$bannar_7;
        }
        if($bannar_8){
            $data['bannar_8']=$bannar_8;
        }
        if($bannar_9){
            $data['bannar_9']=$bannar_9;
        }
        if($bannar_10){
            $data['bannar_10']=$bannar_10;
        }
        if($image_1){
            $data['image_1']=$image_1;
        }
        if($image_2){
            $data['image_2']=$image_2;
        }
        if($image_3){
            $data['image_3']=$image_3;
        }
        if($why_buy_image){
            $data['why_buy_image']=$why_buy_image;
        }
        if($about_image){
            $data['about_image']=$about_image;
        }


        Camping::create($data);
        return redirect()->route('admin.campings.index')->with('success', 'Data created successfully!');
    }

    public function edit( $id)
    {
        $data=Camping::findOrFail($id);
        return view('admin.Camping.edit', compact('data'));
    }

    public function update(Request $request, $id  )
    {
        $data=Camping::findOrFail($id);

        $logo = $request->hasFile('logo') ? ImageHelper::uploadImage($request->file('logo')) : null;
        $bannar = $request->hasFile('bannar') ? ImageHelper::uploadImage($request->file('bannar')) : null;
        $bannar_1 = $request->hasFile('bannar_1') ? ImageHelper::uploadImage($request->file('bannar_1')) : null;
        $bannar_2 = $request->hasFile('bannar_2') ? ImageHelper::uploadImage($request->file('bannar_2')) : null;
        $bannar_3 = $request->hasFile('bannar_3') ? ImageHelper::uploadImage($request->file('bannar_3')) : null;
        $bannar_4 = $request->hasFile('bannar_4') ? ImageHelper::uploadImage($request->file('bannar_4')) : null;
        $bannar_5 = $request->hasFile('bannar_5') ? ImageHelper::uploadImage($request->file('bannar_5')) : null;
        $bannar_6 = $request->hasFile('bannar_6') ? ImageHelper::uploadImage($request->file('bannar_6')) : null;
        $bannar_7 = $request->hasFile('bannar_7') ? ImageHelper::uploadImage($request->file('bannar_7')) : null;
        $bannar_8 = $request->hasFile('bannar_8') ? ImageHelper::uploadImage($request->file('bannar_8')) : null;
        $bannar_9 = $request->hasFile('bannar_9') ? ImageHelper::uploadImage($request->file('bannar_9')) : null;
        $bannar_10 = $request->hasFile('bannar_10') ? ImageHelper::uploadImage($request->file('bannar_10')) : null;
        $image_1 = $request->hasFile('image_1') ? ImageHelper::uploadImage($request->file('image_1')) : null;
        $image_2 = $request->hasFile('image_2') ? ImageHelper::uploadImage($request->file('image_2')) : null;
        $image_3 = $request->hasFile('image_3') ? ImageHelper::uploadImage($request->file('image_3')) : null;
        $why_buy_image = $request->hasFile('why_buy_image') ? ImageHelper::uploadImage($request->file('why_buy_image')) : null;
        $about_image = $request->hasFile('about_image') ? ImageHelper::uploadImage($request->file('about_image')) : null;

        if($request->hasFile('logo') && $data->logo){
            Storage::disk('public')->delete($data->logo);
        }
        if($request->hasFile('bannar') && $data->bannar){
            Storage::disk('public')->delete($data->bannar);
        }
        if($request->hasFile('bannar_1') && $data->bannar_1){
            Storage::disk('public')->delete($data->bannar_1);
        }
        if($request->hasFile('bannar_2') && $data->bannar_2){
            Storage::disk('public')->delete($data->bannar_2);
        }
        if($request->hasFile('bannar_3') && $data->bannar_3){
            Storage::disk('public')->delete($data->bannar_3);
        }
        if($request->hasFile('bannar_4') && $data->bannar_4){
            Storage::disk('public')->delete($data->bannar_4);
        }
        if($request->hasFile('bannar_5') && $data->bannar_5){
            Storage::disk('public')->delete($data->bannar_5);
        }
        if($request->hasFile('bannar_6') && $data->bannar_6){
            Storage::disk('public')->delete($data->bannar_6);
        }
        if($request->hasFile('bannar_7') && $data->bannar_7){
            Storage::disk('public')->delete($data->bannar_7);
        }
        if($request->hasFile('bannar_8') && $data->bannar_8){
            Storage::disk('public')->delete($data->bannar_8);
        }
        if($request->hasFile('bannar_9') && $data->bannar_9){
            Storage::disk('public')->delete($data->bannar_9);
        }
        if($request->hasFile('bannar_10') && $data->bannar_10){
            Storage::disk('public')->delete($data->bannar_10);
        }
        if($request->hasFile('image_1') && $data->image_1){
            Storage::disk('public')->delete($data->image_1);
        }
        if($request->hasFile('image_2') && $data->image_2){
            Storage::disk('public')->delete($data->image_2);
        }
        if($request->hasFile('image_3') && $data->image_3){
            Storage::disk('public')->delete($data->image_3);
        }
        if($request->hasFile('why_buy_image') && $data->why_buy_image){
            Storage::disk('public')->delete($data->why_buy_image);
        }
        if($request->hasFile('about_image') && $data->about_image){
            Storage::disk('public')->delete($data->about_image);
        }
        

        $input = $request->all();

      if($logo){
            $input['logo']=$logo;
        }
        if($bannar){
            $input['bannar']=$bannar;
        }
        if($bannar_1){
            $input['bannar_1']=$bannar_1;
        }
        if($bannar_2){
            $input['bannar_2']=$bannar_2;
        }
        if($bannar_3){
            $input['bannar_3']=$bannar_3;
        }
        if($bannar_4){
            $input['bannar_4']=$bannar_4;
        }
        if($bannar_5){
            $input['bannar_5']=$bannar_5;
        }
        if($bannar_6){
            $input['bannar_6']=$bannar_6;
        }
        if($bannar_7){
            $input['bannar_7']=$bannar_7;
        }
        if($bannar_8){
            $input['bannar_8']=$bannar_8;
        }
        if($bannar_9){
            $input['bannar_9']=$bannar_9;
        }
        if($bannar_10){
            $input['bannar_10']=$bannar_10;
        }
        if($image_1){
            $input['image_1']=$image_1;
        }
        if($image_2){
            $input['image_2']=$image_2;
        }
        if($image_3){
            $input['image_3']=$image_3;
        }
        if($why_buy_image){
            $input['why_buy_image']=$why_buy_image;
        }
        if($about_image){
            $input['about_image']=$about_image;
        }

        $data->update($input);

        return redirect()->route('admin.campings.index')->with('success', 'Data updated successfully!');
    }

    public function destroy($id)
    {
        $data= Camping::findOrFail($id);

        if($data->logo){
            Storage::disk('public')->delete($data->logo);
        }
        if( $data->bannar){
            Storage::disk('public')->delete($data->bannar);
        }
        if( $data->bannar_1){
            Storage::disk('public')->delete($data->bannar_1);
        }
        if($data->bannar_2){
            Storage::disk('public')->delete($data->bannar_2);
        }
        if( $data->bannar_3){
            Storage::disk('public')->delete($data->bannar_3);
        }
        if($data->bannar_4){
            Storage::disk('public')->delete($data->bannar_4);
        }
        if( $data->bannar_5){
            Storage::disk('public')->delete($data->bannar_5);
        }
        if( $data->bannar_6){
            Storage::disk('public')->delete($data->bannar_6);
        }
        if($data->bannar_7){
            Storage::disk('public')->delete($data->bannar_7);
        }
        if( $data->bannar_8){
            Storage::disk('public')->delete($data->bannar_8);
        }
        if( $data->bannar_9){
            Storage::disk('public')->delete($data->bannar_9);
        }
        if($data->bannar_10){
            Storage::disk('public')->delete($data->bannar_10);
        }
        if( $data->image_1){
            Storage::disk('public')->delete($data->image_1);
        }
        if($data->image_2){
            Storage::disk('public')->delete($data->image_2);
        }
        if($data->image_3){
            Storage::disk('public')->delete($data->image_3);
        }
        if( $data->why_buy_image){
            Storage::disk('public')->delete($data->why_buy_image);
        }
        if( $data->about_image){
            Storage::disk('public')->delete($data->about_image);
        }

        $data->delete();

        return redirect()->route('admin.campings.index')->with('success', 'Data deleted successfully!');
    }
}
