<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(){
        $categories = Categories::all();
        return view('category.categorylist', compact('categories'));
    }

   public function createcategory()
   {
     return view('category.createcategory');
   }
   public function store(Request $request){
        Categories::create([
            'catogories_name' => $request->categoryName
        ]);
        return dd('success');
    }

       // LISTING IN YAJRA DATATABLE
       public function getdata(Request $request)
       {   
           if ($request->ajax()) {
               $data = Categories::latest()->get();
               return Datatables::of($data)
                   ->addIndexColumn()
                   ->addColumn('action', function ($row) {
                       $actionBtn = '<a href="' . route('edit', $row->id) . '" class="edit btn btn-success btn-sm">Edit</a>
                       <a href="' . route('delete', $row->id) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                       return $actionBtn;
                   })
                   ->rawColumns(['action'])
                   ->make(true);
           }
       }
}
