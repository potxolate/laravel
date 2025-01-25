<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class linksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::paginate(15);
        return view('links.index', compact('links'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLinkRequest $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'url' => 'required|url',
        ]);
		
		if (!$validated) {
			return redirect('links/create')
				->withErrors($validated);
		} else {
			// store
			$link = new Link;
            $link->product_id   = $request->input('product_id');
            $link->url          = $request->input('url');
            $link->save();
            $link->update(['price' => $link->getPriceFromUrl()]);

			return redirect('/links');
		}
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        $link = Link::find($link->id);
        $link->update($request->all());
        $link->update(['price' => $link->getPriceFromUrl()]);
        return redirect()->route('links.index')
            ->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->route('links.index');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $productos = Product::where('name', 'like', "%$search%")->pluck('id')->toArray();
        $links =  Link::whereIn('product_id', $productos)->paginate(15);
        return view('links.index', ['links' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request): JsonResponse
    {
        $data = Product::select("name", "id")
                    ->where('name', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
        
        return response()->json($data);
    }

    public function updatePrice(Link $link)
    {
        $link->update(['price' => $link->getPriceFromUrl()]);

        $product = Product::find($link->product_id);
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

        return redirect()->route('links.index')
            ->with('success', 'Updated successfully.');
    }
}
