<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllBrand(){

        $brands=Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function AddBrand(Request $request){

        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $brand_image=$request->file('brand_image');

   /*     $name_gen=hexdec(uniqid());
        $img_ext=strtolower($brand_image->getClientOriginalExtension());
        $img_name=$name_gen.'.'.$img_ext;
        $up_location='image/brand/';
        $last_img=$up_location.$img_name;
        $brand_image->move($up_location,$img_name);
*/

        $img_name=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$img_name);
        $last_img='image/brand/'.$img_name;



        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_img,
            'created_at'=> Carbon::now()
        ]);

        return redirect()->back()->with('success','brand insert successfully');

    }
    public function Edit($id){

       $brands= Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function  Update(Request $request,$id){

        $validateData=$request->validate([
            'brand_name'=>'required|min:4',
        ]);

        $old_image = $request->old_image;

        $brand_image =  $request->file('brand_image');

        if($brand_image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $img_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/brand/';
            $last_image = $up_location . $img_name;
            $brand_image->move($up_location, $img_name);

            unlink($old_image);
            Brand::find($id)->update([

                'brand_name' => $request->brand_name,
                'brand_image' => $last_image,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('all.brand')->with($notification);
        }else{
            Brand::find($id)->update([

                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'info'
            );

            return redirect()->route('all.brand')->with($notification);

        }


    }

    public function Delete($id){
        $image=Brand::find($id);
        $old_image=$image->brand_image;
        unlink($old_image);

        $brand=Brand::find($id)->delete();
        return redirect()->route('all.brand')->with('success','brand  deleted successfully');
    }

    public function Multipics(){
        $images=Multipic::all();
        return view('admin.multipic.index',compact('images'));

    }
    public function MultipicsShow(Request $request){


        $images=$request->file('image');

        foreach ($images as $image) {

            $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('image/brand/' . $img_name);
            $last_img = 'image/brand/' . $img_name;


            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->back()->with('success','image insert successfully');



    }
}
