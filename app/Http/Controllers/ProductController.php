<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product->orderBy('id', 'DESC')->get();
        return view('admin.product_list')
            ->with('product_list', $this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_parent', 1)->get();
        $sub_categories = Category::where('is_parent', 0)->get();
        return view('admin.product_form', ['categories' => $categories, 'sub_categories' => $sub_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'stock' => 'numeric|nullable',
            'price' => 'numeric|required',
            'discount' => 'numeric|nullable',
            'image' => 'required',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|exists:brands,id',
            'size' => 'nullable',
            'conditions' => 'nullable',
        ]);


        $data = $request->except('image');

        $file_name = uploadImage($request->image, "product", '125x125');
        if ($file_name) {
            $data['image'] = $file_name;
        }

        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->product->getSlug($data['title']);
        $data['discount'] = 0;
        // $price = ($request->price - (($request->price * $request->discount) / 100));
        // $data['price'] = $price;
        $this->product->fill($data);
        $status = $this->product->save();
        if ($status) {
            $request->session()->flash('success', 'Product added successfully');
        } else {
            $request->session()->flash('error', 'Sorry! There was problem while adding product');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->product = $this->product->find($id);
        if (!$this->product) {
            request()->session()->flash('error', 'Product does not exists');
            return redirect()->route('product.index');
        }
        $categories = Category::where('is_parent', 1)->get();
        $sub_categories = Category::where('is_parent', 0)->get();

        return view('admin.product_form')
            ->with('product_list', $this->product)
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories);
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
        $this->product = $this->product->find($id);
        if (!$this->product) {
            $request->session()->flash('error', 'Product not found');
            return redirect()->route('product.index');
        }

        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'stock' => 'numeric|nullable',
            'price' => 'numeric|required',
            'discount' => 'numeric|nullable',
            'image' => 'nullable',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|exists:brands,id',
            'size' => 'nullable',
            'conditions' => 'nullable',
        ]);

        $data = $request->except('image');

        if (isset($request->image)) {
            $file_name = uploadImage($request->image, "product", '125x125');
            if ($file_name) {
                if ($this->product->image != null && file_exists(public_path() . 'uploads/product/' . $this->product->image)) {
                    unlink(public_path() . 'uploads/product/' . $this->product->image);
                    unlink(public_path() . 'uploads/product/Thumb-' . $this->product->image);
                }

                $data['image'] = $file_name;
            }
        }
        $this->product->fill($data);
        $status = $this->product->save();
        if ($status) {
            $request->session()->flash('success', 'Product updated successfully');
        } else {
            $request->session()->flash('error', 'Sorry! There was problem while updating product');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->find($id);

        if (!$this->product) {
            request()->session()->flash('error', 'Product does not exists');
            return redirect()->route('product.index');
        }

        $image = $this->product->image;
        $del = $this->product->delete();

        if ($del) {
            if (!empty($image) && file_exists(public_path() . '/uploads/product/' . $image)) {
                unlink(public_path() . '/uploads/product/' . $image);
                unlink(public_path() . '/uploads/product/Thumb-' . $image);
            }
            request()->session()->flash('success', 'Product deleted successfully');
        } else {
            request()->session()->flash('error', 'Sorry! There was error in deleting product');
        }
        return redirect()->route('product.index');
    }
}
