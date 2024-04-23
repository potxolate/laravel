<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        //dd($request->all);
        // validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'product_id'       => 'required',
			'url'      => 'required|url'			
		);

        $link = new Link;
        $link->product_id   = $request->input('product_id');
        $link->url          = $request->input('url');
        $link->save();
        
        return redirect()->route('productos');
		#$validator = Validator::make(Input::all(), $rules);

		// process the login
		// if ($validator->fails()) {
		// 	return Redirect::to('nerds/create')
		// 		->withErrors($validator)
		// 		->withInput(Input::except('password'));
		// } else {
		// 	// store
		// 	$nerd = new Nerd;
		// 	$nerd->name       = Input::get('name');
		// 	$nerd->email      = Input::get('email');
		// 	$nerd->nerd_level = Input::get('nerd_level');
		// 	$nerd->save();

		// 	// redirect
		// 	Session::flash('message', 'Successfully created nerd!');
		// 	return Redirect::to('nerds');
		// }
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
}
