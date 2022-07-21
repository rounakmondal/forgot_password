<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\personal_detail;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class forgotpassword extends Controller
{
    
    public function resetphone(Request $request){
        $phone=$request->phone;
        $rr=substr($phone, 3);     
        $userdata=DB::table('personal_details')->where('mobile',$rr)->first();
        if( $userdata){
            session()->put('f_phone',$rr);
            return response()->json(["success" => "1"]);
        }
      else{

          return response()->json(["error" => "0"]);
      }

    }

    public function updatepassword(Request $req){
    if(session()->has('f_phone')){
        $pass=$req->pass;
        $cpass=$req->cpass;
        if($pass==$cpass){
            $resetpassword = User::join('personal_details', 'users.email', '=', 'personal_details.email')
            ->where('mobile', '=',session('f_phone'))->first();
            $ccpassword=Hash::make($req->cpass);
           $resetpassword->password=$ccpassword;
           $resetpassword->update();
           $req->session()->forget('f_phone');
           return redirect('/login')->with('success','passwordupdated sucessfully,Please login');
        }
        else{
            return back()->with('error','password and confirm password dont match');
        }
    }
    else{
        return view('components.user.forgotpassword')->with('error','confirm your mobile verify first');
    }

    
    }
}
