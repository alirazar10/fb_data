<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class dataController extends Controller
{
    public function home(){

        return view('/welcome');
    }

    public function search(Request $req){
        $req->validate([
            'search'=> 'required|numeric'
        ]);

        $search = DB::table('data')->where('phone', $req->search)->first();
        
        return response()->json([$search],200);
        return view('/welcome');
        return $search;
        return 123;
    }
    public function addData(Request $Req){
        $file = fopen("C:/Users/HP/Desktop/Afghanistan.txt", "r") or exit("Unable to open file!");
                $data = array();
                $i = 0;
                while(!feof($file)) {

                     $phone = explode(':',fgets($file));
                     $index = count($phone);
                     $data [$i] = ['no' => $i ,'phone' => $phone[0], 'id'=>$phone[1], 'name'=> $phone[2], 'lastname'=>$phone[3], 'gender'=>$phone[4], 'address1'=>$phone[5], 'address2'=>$phone[6], 'marital_status'=>$phone[7], 'education'=> $phone[8],];
                    //  var_dump($phone);
                    // $insert = \DB::table('data')->insert($data[$i]);
                    
                    
                     if($i == 558390-4){
                        // return $phone;
                         break;
                     }
                     $i++;
                }
                ini_set('max_execution_time', 3000);
                // \DB::beginTransaction();

                // // Your inserts here
                foreach ( \array_chunk($data, 1000) as $key => $value){
                    $insert = \DB::table('data')->insert($value);
                    
                }
                return  \DB::getDatabaseName();
                // \DB::commit();
                if($insert){
                    return 1;
                }else{
                    return  0;
                }
                print_r($data[558390]); print_r($data[55890]); print_r($data[557390]);
                    // return $data;
                fclose($file);
    }
}