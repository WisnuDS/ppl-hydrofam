<?php

namespace App\Http\Controllers;

use App\Events\ChatBrodcastEvent;
use App\Lib\ResponseBase;
use App\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function singleChat(Request $request)
    {
        $validation = Validator::make($request->all(),[
            "sender" => "required",
            "message" => "required",
            "created_at" => "required"
        ]);

        if ($validation->fails())
            return response()->json(ResponseBase::failedResponse(400,$validation->errors()->first()));

        $receiver = null;

        if ($request->receiver === null || $request->receiver === ''){
            $admin = DB::table('users')->join('user_role','user_id','=','users.id')->where('status','=',1)
                ->where('role_id','=','2')
                ->get();

            $all = $admin->all();
            $receiver = $all[rand(0,count($all)-1)];
        }else{
            $receiver = User::find($request->receiver["id"]);
        }

        DB::table('messages')->insert([
            "sender_id" => $request->sender["id"],
            "receiver_id" => $receiver->id,
            "message" => $request->message,
            "created_at" => now()
        ]);

        $data = [
            "sender" => $request->sender,
            "receiver" => [
                "id" => $receiver->id,
                "avatar" => $receiver->avatar
            ],
            "message" => $request->message,
            "created_at" => $request->created_at
        ];

        broadcast(new ChatBrodcastEvent($receiver,$data))->toOthers();

        return response()->json(ResponseBase::successResponse("success",["data" => $receiver]));
    }

    public function fetchChat($id)
    {
        $messages =Message::with(["sender:id,name,avatar","receiver:id,name,avatar"])
            ->where('sender_id','=',$id)
            ->orWhere('receiver_id','=', $id)
            ->orderBy('created_at','ASC')
            ->get();

        $idExists = [];
        $chats = [];

        foreach ($messages as $message){
            if ($message->receiver_id == $id){
                if (in_array($message->sender_id,$idExists)){
                    $index = array_search($message->sender_id,$idExists);
                    array_push($chats[$index]["messages"],$message);
                }else{
                    $param = [
                        "userId" => $message->sender_id,
                        "username" => $message->sender->name,
                        "avatar" => $message->sender->avatar,
                        "newMessage" => false,
                        "messages" => [$message]
                    ];
                    array_push($chats,$param);
                    array_push($idExists,$message->sender_id);
                }
            }else{
                if (in_array($message->receiver_id,$idExists)){
                    $index = array_search($message->receiver_id,$idExists);
                    array_push($chats[$index]["messages"],$message);
                }else{
                    $param = [
                        "userId" => $message->receiver_id,
                        "username" => $message->receiver->name,
                        "avatar" => $message->receiver->avatar,
                        "newMessage" => false,
                        "messages" => [$message]
                    ];
                    array_push($chats,$param);
                    array_push($idExists,$message->receiver_id);
                }
            }
        }

        return response()->json(ResponseBase::successResponse("Success",["data" => $chats]));
    }
}
