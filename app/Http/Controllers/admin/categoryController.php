<?php

namespace App\Http\Controllers\admin;

use App\Models\cr;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()   
    {
       
    }


     /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('admin.category.create');
        
    }



    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',
            'status' => 'required'
        ]);

        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            session()->flash('success','new category created successfully');
            return response()->json([
                'status' => true,
                'message' => 'new category created',
                'errors' => []
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'there is a problem check again all fields',
            'errors' => $validator->errors()
        ]);
       
    }

   
// paginate(3)
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $categories = Category::oldest();
        if(!empty($request->search)){
            $categories->where('name','like','%'.$request->search.'%')
                         ->orWhere('slug','like','%'.$request->search.'%');
        }
        $categories = $categories->paginate(9);
        return view('admin.category.list',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
