<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'desc')->paginate(10);
        return view('manage.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return Create Page
        return view('manage.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//dd($request);
        // Validation
        $this->validate($request, [
            'item' => 'required',
            'brand' => 'required',
            'style' => 'required',
            'color' => 'required',
            'size' => 'required',
            'price' => 'required',
            'product_image' => 'required|image'
        ]);

        // Handle file upload
        if ($request->hasFile('product_image')) {
            # Get the filename with extension
            $filenameWithExt = $request->file('product_image')->GetClientOriginalName();

            # Get FileName Only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            # Get Extension Only
            $extension = $request->file('product_image')->GetClientOriginalExtension();

            # Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            # Upload the Image
            $path = $request->file('product_image')->storeAs('public/images/product_images', $fileNameToStore);

        } else {
            # Set default file
            $fileNameToStore = 'noimage.jpg';
        }

        // Create new Post instance
        $product = new Product;

        $product->item = $request->input('item');

        $product->brand = $request->input('brand');

        $product->style = $request->input('style');

        $product->color = $request->input('color');

        $product->size = $request->input('size');

        $product->price = $request->input('price');

        /*$str = $product->post_title;

        $sep='-';
        
        $res = strtolower($str);
        $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
        $res = preg_replace('/[[:space:]]+/', $sep, $res);
        $slug = trim($res, $sep);

        $product->slug = $slug;*/

        //$post->page_id = $request->page_id;

        $product->product_image = $fileNameToStore;

        $product->save();

        Session::flash('success', 'Product created successfully');

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        // Return Show Page
        return view('manage.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    // Fetch product data from DB
        $product = Product::find($id);
        $products = Product::all();
        // $pages = Page::all();
    // Check correct user authentication
    /*if (Auth::user()->id != $post->user_id) {
        # Redirect user to Post Index route
        return redirect('/posts')->with('error', 'Unauthorized Access!');
    }*/

    // Return edit view with data
        return view('manage.products.edit')->with('product', $product)->with('products', $products);
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
        dd($request);
        // Validation
        $this->validate($request, [
            'post_title' => 'required',
            'post_content' => 'required',
            'product_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            # Get the filename with extension
            $filenameWithExt = $request->file('cover_image')->GetClientOriginalName();

            # Get FileName Only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            # Get Extension Only
            $extension = $request->file('cover_product_image')->GetClientOriginalExtension();

            # Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            # Upload the Image
            $path = $request->file('product_image')->storeAs('public/images/product_images', $fileNameToStore);
        }

        // Find Product in DB by ID
        $product = Product::find($id);

        $product->item = $request->input('item');

        $product->brand = $request->input('brand');

        $product->style = $request->input('style');

        $product->color = $request->input('color');

        $product->size = $request->input('size');

        $product->price = $request->input('price');

        /*$str = $product->post_title;

        $sep='-';
        
        $res = strtolower($str);
        $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
        $res = preg_replace('/[[:space:]]+/', $sep, $res);
        $slug = trim($res, $sep);
        

        $product->slug = $slug;*/

        if ($request->hasFile('product_image')) {
            # Replace Feature Image
            $product->product_image = $fileNameToStore;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);

        //
        $product->delete();

        //
        return redirect()->route('manage.products.index');
    }
}
