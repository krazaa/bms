<?php

namespace App\Http\Controllers\category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Category;
use DB;

class CategoriesController extends Controller
{
    public function index()
    {
    	$cats = Category::where('sub_id','=','')->orderBy('id','desc')->with('subcats')->paginate(50); 
    	return response()->json($cats);
    }

    public function SubCats()
    {
        $cats = Category::where('sub_id', '>', 0)->paginate(50); 
        return response()->json($cats);
    }

    public function ChangeStatus($id)
        {
            $cats = Category::find($id);

            if($cats->isActive == 1)
             { 
                DB::table('categories')->where('id', $id)->update(['isActive' => 0]);
             
             }elseif ($cats->isActive == 0) {
                 DB::table('categories')->where('id', $id)->update(['isActive' => 1]);
             }

            return ['message' => ' successfully Updated'];
        }

     public function CatStore(Request $request) 
    {
        // $this->validate($request, [
        //     'bank' => 'required',
        //     'account' => 'required',
        //     'branchcode' => 'required',
        //     'phone' => 'required',
        //     'address' => 'required',
        //     'city' => 'required'
        // ]);

        $bank = new Category();
        $bank->type = $request->type;
        //$bank->ctype = $request->ctype;
        $bank->category = $request->category;
        $bank->sub_id = $request->ctype;
        $bank ->save();

        return ['message' => 'successfully Stored'];
    }

    public function CatSearch(request $request)
    {   
        $search = $request->search;
        $cats = Category::where('category','LIKE', "%$search%")
        ->paginate(50);
        return $cats->toArray();    
    }

    public function SearchCat(request $request)
    {
         if ($request->ajax())
        {
            $vendors = Category::where('category', '=', $request->name)->count();
                if($vendors) {
                    $count = 'Not Available';
                    return Response($count);
                } else {
                    $count = 'Available';
                return Response($count);
            }
        }
    }
    public function CatDelete($id)
    {
        $data = Category::where('sub_id',$id)->where('id',$id)->count();
        ///return ['error' => 'Category have sub category']; 
            if($data) {
                return ['error' => 'Category have sub category you cannot delete this'];
               } else {
                $count = Category::find($id)->delete();
                return ['message' => 'Successfully Deleted'];
            }
    }
    public function SubCatDelete($id)
    {
        $data = Category::find($id)->delete();
        return ['message' => 'successfully Deleted'];
    }
}
