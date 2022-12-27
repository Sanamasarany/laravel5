<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class checktokenmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */ 
    private $allowedemails =[
            'ahmed@gamil.com',
             'ali@gamil.com',
             'ameer@gamil.com'
];
    public function handle(Request $request, Closure $next)
    {
       $error = false;

    if(!$request->hasHeader('X-ITE-TOKEN' )){
       $error= true;
    }
    $token = $request -> header('X-ITE-TOKEN' );
try{
    $jsonStr = base64_decode($token);
    $jsonpayload = json_decode($jsonStr , true);
    if (!$jsonpayload){
        $error=true;
    }
    if(!isset($jsonpayload['email'])){
        $error= true;
    }
    if(!in_array($jsonpayload['email'],$this->allowedemails)){
        $error=true;

    }

} catch(\Exception $exception){
    $error=true;
}
if($error){
    return response()->json(['message'=>'missing token'],401);
}


    return $next($request);
    } 
}
