<?php

namespace App\helpers;
class helper {
    function setresponse($flag, $data, $error)
    {
        if($flag=='false'){
            return response()->json(['flag' => $flag, 'error' => $error]);
        }else{
            return response()->json(['flag' => $flag, 'data' => $data, 'error' => $error]);
        }

    }
    function responseWithMessage($flag, $data, $message)
    {
        if($flag=='false'){
            return response()->json(['flag' => $flag, 'message' => $message]);
        }else{
            return response()->json(['flag' => $flag, 'data' => $data, 'message' => $message]);
        }
    }

}

