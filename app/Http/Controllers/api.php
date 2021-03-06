<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\exchange;
use App\Models\plan;
use App\Models\idmanager;
use App\Models\User;
use App\Models\exchangeconfigure;
use App\Models\deposit;
use App\Models\iddeposit;
use App\Models\withdrawal;
use App\Models\withrecord;
use App\Models\notification;
use App\Models\idwithdrawal;
use Hash;
class api extends Controller
{
	public function __construct()
	{
		$this->key = 'awerf1d';
        // $this->defaultkey = '$2y$10$I.A5PbGr2ur7CNpSmP59Mu45JlwuhI2mwq1CThi1Hv0rGCOhXd9Dq';
	}
    public function exchange(Request $request)
    {
    	if (!empty($request->get("key"))) {
    		
    	if (Hash::check($this->key,$request->get("key"))) {
    	return json_encode(exchange::get());
    	}else{
    	return "Permission Denied.";    		
    	}
    	}else{
    	return "Key not found.";    		
    	}
    }
    public function notifications(Request $request)
    {
        if (!empty($request->get("key"))) {
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(notification::where("phone","=",$request->get("phone"))->get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }

    public function markread(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        $nt = notification::where("phone","=",$request->get("phone"))->get();
        foreach ($nt as $n)
        {
            $no = notification::find($n->id);
            $no->mode = 1;
            $no->save();
        }
        return "Updated";
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function createid(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        
            $id = new idmanager();
            $id->name = $request->get('name');
            $id->phone = $request->get('phone');
            $id->exchange = $request->get('exchange');
            $id->plan = $request->get('plan');
            $id->username = $request->get('username');
            $id->password = $request->get('password');
            $id->status = empty($request->get('status'))?'pending':$request->get('status');
            $id->mode = empty($request->get('mode'))?0:$request->get('mode');
            $id->save();

            return "Id created successfuly.";

        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function deposit(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        
            $id = new deposit();

                    // Uploading the logo to the  website
         if ($request->hasFile('screenshot'))
            {
                $r = $request->file('screenshot')
                    ->getPathName();
                // Save the image
                $path = public_path();
                $screenshot = "/image/".time() . rand() . $request->file('screenshot')
                    ->getClientOriginalName();
                move_uploaded_file($r, $path . $screenshot);
            }else{
                $screenshot= "/logo/user.png";
            }




            $id->idm = time();
            $id->exchange = $request->get('exchange');
            $id->username = $request->get('username');
            $id->phone = $request->get('phone');
            $id->amount = $request->get('amount');
            $id->currency = empty($request->get('currency'))?'USD':$request->get('currency');
            $id->screenshot = $screenshot;
            $id->status = empty($request->get('status'))?'pending':$request->get('status');
            $id->gateway = $request->get('gateway');
            $id->depositid = time();
            $id->deposittype = $request->get('deposittype');
            $id->save();

            return "Deposit Request created successfuly.";

        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function iddeposit(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        
            
                $id = new iddeposit;
                    // Uploading the logo to the  website
         if ($request->hasFile('screenshot'))
            {
                $r = $request->file('screenshot')
                    ->getPathName();
                // Save the image
                $path = public_path();
                $screenshot = "/image/".time() . rand() . $request->file('screenshot')
                    ->getClientOriginalName();
                move_uploaded_file($r, $path . $screenshot);
            }else{
                $screenshot= "/logo/user.png";
            }




            $id->idm = $request->get("idm");
            $id->gatewayinfo = '';
            $id->depositid = time();
            $id->username = soft::getuserbyphone($request->get('username'))->name;
            $id->phone = $request->get('phone');
            $id->amount = $request->get('amount');
            $id->currency = empty($request->get('currency'))?'USD':$request->get('currency');
            $id->screenshot = $screenshot;
            $id->status = empty($request->get('status'))?'pending':$request->get('status');
            $id->deposittype = $request->get('gateway');
            $id->save();

            return back()->with("success","ID Deposit Request created successfuly.");

        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
     public function withdrawal(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        
            $id = new withdrawal();


            $id->idm = time();
            $id->info = $request->get('info');
            $id->username = $request->get('username');
            $id->phone = $request->get('phone');
            $id->amount = $request->get('amount');
            $id->currency = empty($request->get('currency'))?'USD':$request->get('currency');
            $id->status = empty($request->get('status'))?'pending':$request->get('status');
            $id->gateway = $request->get('gateway');
            $id->save();

            return "withdrawal Request created successfuly.";

        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function createuser(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        
            
        // Uploading the logo to the  website
         if ($request->hasFile('file'))
            {
                $r = $request->file('file')
                    ->getPathName();
                // Save the image
                $path = public_path();
                $file = "/image/".time() . rand() . $request->file('file')
                    ->getClientOriginalName();
                move_uploaded_file($r, $path . $file);
            }else{
                $file= "/logo/user.png";
            }


        $user = new User;
        $user->name =  $request->get("name");
        $user->email =  $this->null($request->get("email"));
        $user->phone =  $this->null($request->get("phone"));
        $user->address =  $this->null($request->get("address"));
        $user->password =  $this->null(Hash::make($request->get("password")));
        $user->role =  empty($request->get("role"))?"User":$request->get("role");
        $user->image = $file;
        if ($user->role=="Admin") {
            $user->power = "All";
        }else{
            $user->power = "";
        }
        $user->save();

            return "User created successfuly.";

        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function planlist(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(plan::get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function depositlist(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(deposit::get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function withdrawallist(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(withdrawal::get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function idlist(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(idmanager::get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }
    public function userlist(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(User::get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }

    public function getuser(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
            if ($user = User::where("phone","=",$request->get("phone"))) {
        return json_encode($user->first());
            }else{
                return false;
            }
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }


    public function configurelist(Request $request)
    {
        if (!empty($request->get("key"))) {
            
        if (Hash::check($this->key,$request->get("key"))) {
        return json_encode(exchangeconfigure::get());
        }else{
        return "Permission Denied.";            
        }
        }else{
        return "Key not found.";            
        }
    }

    public static function null($value,$number=0)
    {
        if ($number==0) {
            return empty($value)?"":$value;
        }else{
            return empty($value)?"0":$value;
        }
    }
}
