<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat(){

        $category=Category::latest()->paginate(10);
        $trashCat=Category::onlyTrashed()->latest()->paginate(5);

         return view('admin.category.index',compact('category','trashCat'));

    }
    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
            [
                'category_name.required' => 'Please input name',
                'category_name.max' => 'category less than 255chars',
            ]);

  /*      Category::insert([
            'category_name'=>$request->category_name,
            'user_id'=> Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);*/

        $category = new Category();
        $category->category_name=$request->category_name;
        $category->user_id=Auth::user()->id;
        $category->save();
        return redirect()->back()->with('success','category insert successfully');
    }
    public function Edit($id){
      //  dd('adad');

        $categories=Category::find($id);
        return view('admin.category.edit',compact('categories'));

    }
    public function  Update(Request $request,$id){

        $update=Category::find($id)->update([

            'category_name'=>$request->category_name,
            'user_id' =>Auth::user()->id,
        ]);

        return redirect()->route('all.category')->with('success','category updated successfully');

    }
    public function SoftDelete($id){

            $delete=Category::find($id)->delete();
            return redirect()->back()->with('success','category deleted successfully');

    }
    public function restore($id){
        $restore=Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','category restored successfully');

    }
    public function pdelete($id){
        $restore=Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success','category permanantaly deleted successfully');
    }
}
