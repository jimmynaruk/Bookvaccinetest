<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class bookvaccineController extends Controller
{

    public function index (Request $request)
    {  
       
        if(Session::get('haslogin') == 0 ){
            
            return redirect('register');
           
        }
        
        return view('bookvaccine');
    }


    public function saveBookVac(Request $request)
    {
        \Log::info("[".__METHOD__."]"."start");
        try{
            $data = $request->json()->all();

            $fnamelname = $request->input('nametxt');
            $tel = $request->input('teltxt');
            $datebook = $request->input('datetxt');
            $timebook = $request->input('timetxt');
            $place = $request->input('placetxt');
            $checktel = $this->check_tel($tel);
            $checkstart = $this->checkdate($datebook);
            $data = array('fnamelname' => $fnamelname,
            'tel' => $tel,
            'datebook' => $datebook,
            'timebook' => $timebook,
            'place' => $place
             );
            

             DB::table("vaccination_detail")->insert( $data);
          

            return \Response::json(['message' => 'จองคิวฉีดวัคซีนเรียบร้อยแล้ว'], 200);

        }catch(\Exception $e){
        
            \Log::error('[' . __METHOD__ . '][' . $e->getFile() . '][line : ' . $e->getLine() . '][' . $e->getMessage() . ']');

            return \Response::json(['message' => $e->getMessage()], 500);
            
        }
    }

    //เช็คเบอร์มือถือห้ามทำรายการซ้ำ
    public function check_tel($tel){ 


        $checktel_sql =  $this->sql_check_tel($tel);
        if($checktel_sql){

            throw new  \Exception("หมายเลขโทรศัพท์นี้ทำการจองวัคซีนไปแล้ว สามารถตรวจสอบข้อมูลการจองฉีดวัคซีนได้ที่ปุ่ม ดูข้อมูลการจองของคุณ");

        }else{
        
        }

    }
    public function sql_check_tel($tel){
        $sql = "select tel from vaccination_detail
        where tel = \"$tel\"";
        $dataset= DB::select($sql);

        return $dataset;
    }

    //ห้ามจองย้อนวันและจองล่วงหน้า1วัน
    private function checkdate($datebook){  
        \Log::info('checkdatetime');

        $timenow = \Carbon\Carbon::now()->timezone('Asia/Bangkok');
        \Log::info($timenow);
        
        $time2 = new \DateTime($datebook,new \DateTimeZone('Asia/Bangkok'));
        
        $interval = $timenow->diff($time2);
        \Log::info(json_encode($interval));
        if($interval->invert == 1 ){
            
            if($interval->d > 0){
            throw new  \Exception ("ห้ามจองย้อนเวลาปัจจุบัน");
            }elseif($interval->d == 0){ 
                throw new  \Exception("จองล่วงหน้า1วัน");
            }
        }elseif($interval->invert == 0 ){
            
          if($interval->d > 0){
           
            }
        }
        
    }

        public function checkbookdata(Request $request)
    {
        \Log::info("[".__METHOD__."]"."start");
        try{
            $data = $request->json()->all();

            $tel = $request->input('teltxt');
            $datadetail = $this->check_username($tel);
            \Log::info($tel);
           
           

            return \Response::json(['message' => 'ตรวจสอบข้อมูลการลงทะเบียนฉีดวัคซีน'], 200);

        }catch(\Exception $e){
        
            \Log::error('[' . __METHOD__ . '][' . $e->getFile() . '][line : ' . $e->getLine() . '][' . $e->getMessage() . ']');

            return \Response::json(['message' => $e->getMessage()], 500);
            
        }
    }

    public function check_username($tel){


        $checkdata_sql =  $this->sql_check_bookdata($tel);
        if(empty($checkdata_sql)){

            throw new  \Exception("ท่านยังไม่ได้ทำการจองวัคซีนกรุณาทำรายก่อนเข้าดูข้อมูล");

        }else{
        
        }

    }
    //เช็คว่ามีข้อมูลจองแล้วหรือยัง
    public function sql_check_bookdata($tel){
    $sql = "select tel from vaccination_detail
    where tel = \"$tel\"";
    $dataset= DB::select($sql);
    \Log::info($dataset);
    return $dataset;
    }

}