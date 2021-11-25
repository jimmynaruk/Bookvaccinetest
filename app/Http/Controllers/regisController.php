<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class regisController extends Controller
{
    public function index(Request $request)
    {   
        Session::put('haslogin',0);
       
        return view('register');

    }

    public function createUser(Request $request)
    {
            \Log::info("[".__METHOD__."]"."start");
        try{
            $data = $request->json()->all();

            $tel = $request->input('idteltxt');
            $checktel = $this->check_tel($tel);
           
            $data = array('tel' => $tel
             );
            
            
        DB::table("user_tb")->insert( $data);
          

            return \Response::json(['message' => 'ลงทะเบียนเรียบร้อยแล้ว'], 200);

        }catch(\Exception $e){
        
            \Log::error('[' . __METHOD__ . '][' . $e->getFile() . '][line : ' . $e->getLine() . '][' . $e->getMessage() . ']');

            return \Response::json(['message' => $e->getMessage()], 500);
            
        }
    }
    public function check_tel($tel){ 


        $checktel_sql =  $this->sql_check_tel($tel);
        if($checktel_sql){

            throw new  \Exception("เบอร์โทรศัพท์นี้ลงทะเบียนแล้ว");

        }else{
        
        }

    }
    public function sql_check_tel($tel){
        $sql = "select tel from user_tb
        where tel = \"$tel\"";
        $dataset= DB::select($sql);

        return $dataset;
    }
    
   
  
    public function login(Request $request){
        \Log::info("[".__METHOD__."]"."start");
      try{
        $tel = $request->input('idteltxt');
       
       \Log::info($tel);

        Session::put('getuser',$tel);
        Session::put('haslogin',1);
      
        
        if(Session::get('haslogin') == 0 ){
            
            return Redirect::to('home');
           
        }
        return \Response::json(['message' => "เข้าสู่ระบบเรียบร้อย"]);
        }catch(\Exception $e){
    
            \Log::error('[' . __METHOD__ . '][' . $e->getFile() . '][line : ' . $e->getLine() . '][' . $e->getMessage() . ']');

            return \Response::json(['message' => $e->getMessage()], 500);
            
        }

    }
   
  
    
}
