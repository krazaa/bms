<?php

namespace App\Http\Controllers\category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\modules\Category;
class CategoriesController extends Controller
{
    public function index()
    {
    	$cats = Category::paginate(100); 
    	return response()->json($cats);
    }

     public function GetVendors()
    {
    	$cats = Category::paginate(100);
        return $cats->toArray();
    }

    public function CatSearch(request $request)
    {   
        $search = $request->search;
        $cats = Category::where('catgory','LIKE', "%$search%")
        ->paginate(100);
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
}
