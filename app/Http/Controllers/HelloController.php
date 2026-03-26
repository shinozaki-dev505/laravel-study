<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //実際に処理を行う「関数（メソッド）」を作ります
    public function show($name){
        $hour = date('H');

        if ($hour >=5 && $hour < 11){
            $message="おはようございます";
        }elseif($hour>=11 && $hour<18){
            $message="こんにちは";
        }else{
            $message="こんばんは";
        }

        $now=date('Y年m月d日 H時i分s秒');

        if($name==='嘉之'){
            $message="マスター、おかえりなさい！";
        }

        return view('hello',[
            'time'=>$now,
            'name'=>$name,
            'message'=>$message
        ]);
    }
}
