<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemSelected;
use App\Lib\ResponseBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $product = Item::simplePaginate(16);
        return view('shop')->with("items",$product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('add_product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            "product_name" => "required|string",
            "product_price" => "required|integer",
            "product_stock" => "required|integer",
            "product_details" => "required|string",
            "product_thumbnail" => "required|image"
        ]);

        if ($validation->fails()){
            return back()->withErrors($validation->errors())->withInput();
        }

        if ($request->hasFile("product_thumbnail")){
            $file = $request->file('product_thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $request->file('product_thumbnail')->storeAs('/public/product',$filename);
        }else{
            return back()->withErrors("You must upload product image");
        }

        Item::create([
            "item_name" => $request->product_name,
            "item_description" => $request->product_details,
            "price" => $request->product_price,
            "unit" => $request->product_stock,
            "image" => $filename
        ]);

        toastSuccess("Success Upload new Product");
        return redirect('/shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $item = Item::find($id);
        if (!empty($item)){
            return view('product')->with("item",$item);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return view('edit_product')->with("item",$item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            "product_name" => "required|string",
            "product_price" => "required|integer",
            "product_stock" => "required|integer",
            "product_details" => "required|string",
        ]);

        if ($validation->fails()){
            return back()->withErrors($validation->errors())->withInput();
        }

        if ($request->hasFile("product_thumbnail")){
            $file = $request->file('product_thumbnail');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $request->file('product_thumbnail')->storeAs('/public/product',$filename);
            Item::where('id',$id)->update([
                "item_name" => $request->product_name,
                "item_description" => $request->product_details,
                "price" => $request->product_price,
                "unit" => $request->product_stock,
                "image" => $filename
            ]);
        }else{
            Item::where('id',$id)->update([
                "item_name" => $request->product_name,
                "item_description" => $request->product_details,
                "price" => $request->product_price,
                "unit" => $request->product_stock,
            ]);
        }

        toastSuccess("Success Update new Product");
        return redirect('/shop/'.$id);
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
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleProduct($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    public function addToCart(Request $request)
    {
        $validation = Validator::make($request->all(),[
            "item_id" => ["required","integer","exists:items,id"],
            "quantity" => ["required","integer"]
        ]);

        if ($validation->fails()){
            return response()->json(ResponseBase::failedResponse(400,"Invalid request parameter", ["error" => $validation->failed()]));
        }

        ItemSelected::create([
            "transaction_id" => null,
            "item_id" => $request->item_id,
            "user_id" => auth()->id(),
            "quantity" => $request->quantity,
            "status" => 1
        ]);

//        $item = Item::find($request->item_id);
//        $item->unit-= $request->quantity;
//        $item->save();
        return response()->json(ResponseBase::successResponse("Success Add to chart"));
    }

    public function getAllCart()
    {
        if (!auth()->guest()){
            $itemSelected = ItemSelected::with(['item'])
                ->where('status',1)
                ->where('user_id',auth()->id())
                ->get();
            return response()->json(ResponseBase::successResponse("Success get All Data Cart",["data"=>$itemSelected]));
        }else{
            return response()->json(ResponseBase::successResponse(""));
        }
    }
}
