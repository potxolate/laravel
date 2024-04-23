<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Link;

class ProductosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Product::WithLinks()->get();
        return view('productos.index', compact('productos'));
    }

    public function show(Product $product)
    {
        $product = Product::with('links')->find($product->id);        
        $category = Category::with('products')->find($product->category_id);

        // get previous product
        $previous = Product::where('id', '<', $product->id)->select('id','slug')->orderby('id','desc')->first();        
        // get next product
        $next = Product::where('id', '>', $product->id)->select('id','slug')->orderby('id','asc')->first();     
        
        return view(
            'productos.show',
            [
                'product' => $product,
                'previous' => $previous,
                'next' => $next,
                'category' => $category
            ]
        );
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $links = $product->links;
        $categories = Category::pluck('name', 'id')->toArray();

        // get previous product
        $previous = Product::where('id', '<', $product->id)->select('id','slug')->orderby('id','desc')->first();        
        // get next product
        $next = Product::where('id', '>', $product->id)->select('id','slug')->orderby('id','asc')->first(); 

        return view(
            'productos.update',
            [
                'product' => $product,
                'previous' => $previous,
                'next' => $next,
                'links' => $links,
                'categories' => $categories,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        if ($request->has('link') && $request->input('link') != "") {
            $link = $product->links()->create(['url' => $request->input('link'), 'id' => $id]);
            // Recupera el precio del producto usando getPriceFromUrl()
            $link->update(['price' => $link->getPriceFromUrl()]);
        }

        return redirect()->route('product', [$product->slug])
            ->with('success', 'Product updated successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $productos = Product::where('name', 'like', "%$search%")->get();

        return view('productos.index', ['productos' => $productos]);
    }

    public function removeLink(Product $product, Link $link)
    {
        $product->links()->delete($link->id);

        return back()->with('success', 'Enlace eliminado correctamente.');
    }
}
