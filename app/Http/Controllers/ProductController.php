<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\prd_cat;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $categories = Category::where('user_id', $id)->get();

        return view('products.index', compact('categories'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $image = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('files', 'public');

        $request->request->add(['image' => $image]);
        $request->request->add(['path' => $path]);

        $categories = $request->input('categories');
        $request->request->remove('categories');

        $prd = Product::create($request->all());

        // foreach ($categories as $cat){ 
        //     $rel = new prd_cat;

        //     $rel->prd_id = dd($prd->id);
        //     $rel->cat_id = $cat;

        //     $rel->save();
        //     }

        return redirect()->route('home',['categories'=> $categories])->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $prd = Product::find($id);
      return view('products.show',compact('prd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prd = Product::find($id);
        return view('products.edit',compact('prd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        if ($request->hasFile('file')) {
        $image = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('files', 'public');

        $request->request->add(['image' => $image]);
        $request->request->add(['path' => $path]);
        }

        $prd = Product::find($id);
        $prd->update($request->all());

        return redirect()->route('home')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Product::find($id);
        $post->delete();

       return redirect()->route('home')
                       ->with('success','Product deleted successfully');
    }
}
