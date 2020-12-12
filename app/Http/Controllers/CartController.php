<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemSelected;
use App\Lib\ResponseBase;
use App\Transaction;
use Illuminate\Http\Request;
use PHPUnit\Util\Xml\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('cart');
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
        //
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
        //
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
        //
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

    public function address()
    {
        $address = [
            "province" => auth()->user()->province,
            "city" => auth()->user()->city,
            "detail" => auth()->user()->detail,
            "postal_code" => auth()->user()->postal_code,
            "sub_district" => auth()->user()->sub_district
        ];
        return response()->json(ResponseBase::successResponse("Success load address",["data" => $address]));
    }

    public function updateCart(Request $request, $id)
    {
        $validation = \Illuminate\Support\Facades\Validator::make($request->all(),[
            "quantity" => ["required","integer"]
        ]);

        if ($validation->fails()){
            return response()->json(ResponseBase::failedResponse(422,"Request data invalid"));
        }

        $selected = ItemSelected::find($id);
        $item = Item::find($selected->item_id);

        if (!$item->exists()){
            return ResponseBase::failedResponse(404, "Data Not Found");
        }

        if (($item->unit+$selected->quantity)-$request->quantity < 0){
            return ResponseBase::failedResponse(400, "The item is out of stock");
        }

        $item->unit = ($item->unit+$selected->quantity)-$request->quantity;
        $item->save();
        $selected->quantity = $request->quantity;
        $selected->save();

        return response()->json(ResponseBase::successResponse("Success update"));
    }

    public function deleteCart($id)
    {
        $selected = ItemSelected::find($id);

        if (!$selected->exists()){
            return ResponseBase::failedResponse(404, "Data Not Found");
        }

        $selected->delete();
        return response()->json(ResponseBase::successResponse("Success Delete Data"));
    }
}
