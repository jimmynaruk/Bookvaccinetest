<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class detailController extends Controller
{

    public function index (Request $request)
    {  
        
        $data = $request->json()->all();
        $tel = Session::get('getuser');
        
        $sql = "SELECT fnamelname, datebook,timebook,place FROM vaccination_detail WHERE tel = \"$tel\" ";
        \Log::info($sql);
        $dataname['dataName'] = DB::select($sql);

        return view('bookdetail',['dataname'=>$dataname]);
    }


    

    public function sql_get_tel($tel){
      
        $sql = "select * from vaccination_detail
        where tel = \"$tel\"";
        $dataset= DB::select($sql);

        return $dataset;
    }

  


}