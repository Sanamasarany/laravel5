<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class firstcontroller extends Controller
{
 
    public function check_user(Request $request){
        $emaill = $request-> input('email');
        $passwordd=$request-> input('pass');
        
        if (!$emaill || !$passwordd){
           return response()->json(['message'=>'enter both of your email and password pls '],400);
        }

        $filepath = 'C:\xampp\htdocs\userslist.json';
        $filecontent= file_get_contents($filepath);
        $jsoncontent =json_decode($filecontent,true);
        foreach($jsoncontent as $value){
               if($value['email']==$emaill && $value['password']==$passwordd){
                $token = base64_encode($emaill);
               return response()->json(['message'=>'token : ',$token]);
            
               }else{
                return response()->json(['message'=>'invaled email or password ']);
               }
               
        }

       
    }

    public function deleteproduct(Request $request){
        $emaill = $request-> input('email');
        $product=$request-> input('product');
        $price=$request-> input('price');
        
        if (!$emaill || !$product || !$price ){
           return response()->json(['message'=>'enter all your product informatois pls '],400);
        }
        $filepath = 'C:\xampp\htdocs\emails.json';
        $filecontent= file_get_contents($filepath);
        $jsoncontent =json_decode($filecontent,true);
        foreach($jsoncontent as &$value){
            if($value['email']==$emaill ){
             unset($value['product']);
             file_put_contents($filepath,json_encode($jsoncontent)) ;

                 return response()->json(['message'=>'product deleted','data'=>$jsoncontent]);
           
         
            }else{
             return response()->json(['message'=>'invaled email ']);
            } 
    }


    }
    public function test(Request $request){
       // $name = $request-> input('name');
        $email = $request-> input('email');
        $password=$request-> input('password');
       // $password_confirm=$request-> input('password_confirm');
        if (!$email || !$password ){
            return response()->json(['message'=>'enter all your  informatois pls '],422);
         }else
         {
            $token = base64_encode($email);
        return response()->json(['message'=>'it worked ','token'=>$token],200);
         }
    }    
}
