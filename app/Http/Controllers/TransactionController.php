<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        //get all transaction
        $transactions = Transaction::with(['user','itemsSelecteds'])->get();

        //return view
        return view('transaction')->with(["transactions" => $transactions]);
    }

    public function show($id)
    {
        //find transaction
        $transaction = Transaction::with('user','itemsSelecteds.item')
            ->where('id','=',$id)
            ->get()->first();

        //return view and data
        return view('transaction_details')->with("transaction",$transaction);
    }

    public function confirm($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 3;
        $transaction->paid_at = date(now());
        $transaction->save();
        toastSuccess("Success confirmed payment");
        return redirect()->back();
    }
}
