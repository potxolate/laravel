<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$categories = Category::with('subcategories')->get();
        $categories = Category::all();        
        return view('categories.index', compact('categories'));
    }

    public function data(Request $request)
    {
        $data = Category::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="'.route('categories.edit', $row->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <form action="'.route('categories.destroy', $row->id).'" method="POST" style="display:inline;">
                              '.csrf_field().'
                              '.method_field("DELETE").'
                              <button type="submit" class="delete btn btn-danger btn-sm">Delete</button>
                          </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = Category::create([
            'name' => $request->input('name'),            
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = $category->with('products')->find($category->id); // Eager load products
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.show', [$id])
            ->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }

    
}
