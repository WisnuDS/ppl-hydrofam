<?php


namespace App\Lib;


class ResponseBase
{
    public static function successResponse($message, $additionalResponse=array())
    {
        if (empty($additionalResponse)){
            return [
                "status" => 200,
                "message" => $message
            ];
        }else{
            return array_merge([
                "status" => 200,
                "message" => $message
            ],$additionalResponse);
        }
    }

    public static function failedResponse($code, $message, $additionalResponse=array())
    {
        if (empty($additionalResponse)){
            return[
                "status" => $code,
                "message" => $message
            ];
        }else{
            return array_merge([
                "status" => $code,
                "message" => $message
            ],$additionalResponse);
        }
    }

}
