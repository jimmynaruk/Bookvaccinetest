<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class regisController extends Controller
{
    public function index(Request $request)
    {   

        $data = $request->json()->all();
        $getdetailtel =  $this->sql_datadetail($tel);

        

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
        //\Log::info($dataset);
        return $dataset;
    }
    
   
  
    public function login(Request $request){
        \Log::info("[".__METHOD__."]"."start");
      try{
        $tel = $request->input('idteltxt');
       \Log::info($tel);
       //\Log::info($checktellogin);
       $getdetailtel =  $this->sql_check_telbase($tel);
       if(empty($getdetailtel)){
        Session::put('haslogin',0);
        
       
        throw new  \Exception("เบอร์โทรศัพท์นี้ยังไม่ได้ลงทะเบียนกรุณาลงทะเบียน");
       
    }
      
        Session::put('getuser',$tel);
        Session::put('haslogin',1);
      
        if(Session::get('haslogin') == 0 ){
            
            return Redirect::to('register');
            
        }
        
        return \Response::json(['message' => "เข้าสู่ระบบเรียบร้อย"]);
        
        }catch(\Exception $e){
    
            \Log::error('[' . __METHOD__ . '][' . $e->getFile() . '][line : ' . $e->getLine() . '][' . $e->getMessage() . ']');

            return \Response::json(['message' => $e->getMessage()], 500);
            
        }

    }

    //เช็คเบอร์โทรศัพท์ว่าลงทะเบียนแล้วหรือยัง
    public function sql_check_telbase($tel){
        $sql1 = "select tel from user_tb
        where tel = \"$tel\"";
        $dataset= DB::select($sql1);
        \Log::info($dataset);
        return $dataset;
    }
    
    public function sql_datadetail($tel){
        $sql1 = "select tel from vaccination_detail
        where tel = \"$tel\"";
        $dataset= DB::select($sql1);
        \Log::info($dataset);
        return $dataset;
    }
    
}
