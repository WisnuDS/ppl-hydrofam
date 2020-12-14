<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemSelected;
use App\Lib\ResponseBase;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
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

    public function checkout()
    {
        try {
            DB::beginTransaction();
            //check if user has incomplete transaction
            $transaction = Transaction::where('user_id', auth()->id())
                ->where('status',1)
                ->get();
            if (sizeof($transaction) > 0){
                DB::rollBack();
                return response()->json(ResponseBase::failedResponse(400,"You haven't completed the previous transaction"));
            }

            $newTransaction = Transaction::create([
                "invoice" => uniqid("INV"),
                "order_note" => null,
                "status" => 1,
                "user_id" => auth()->id(),
                "image" => null,
                "paid_at" => null
            ]);

            $carts = ItemSelected::where('user_id', auth()->id())
                ->where('status',1)
                ->get();

            foreach ($carts as $cart){
                $cart->transaction_id = $newTransaction->id;
                $cart->status = 2;
                $cart->save();
                $item = Item::find($cart->item_id);
                if ($item->unit - $cart->quantity < 0){
                    DB::rollBack();
                    return response()->json(ResponseBase::failedResponse(400,"Out of stock"));
                }
                $item->unit = $item->unit - $cart->quantity;
                $item->save();
            }
            DB::commit();
            return response()->json(ResponseBase::successResponse("Success Checkout",["data" => $newTransaction]));
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(ResponseBase::failedResponse(500,"Something went wrong",["data" => $exception]));
        }
    }

    public function detailCheckout($id)
    {
        $transaction = Transaction::find($id);

        if (empty($transaction)){
            abort(404);
        }

        $selected = ItemSelected::with('item')->where('transaction_id',$id)->get();

        $total = 0;

        foreach ($selected as $select){
            $total+=$select->quantity*$select->item->price;
        }

        return view('checkout')->with([
            "transaction" => $transaction,
            "carts" => $selected,
            "total" => $total
        ]);
    }
}
