<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class memberController extends Controller
{
    //
    function addMember(Request $req)
    {
        $member = new Member;

        $req->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|min:3|max:15',
            'email' => 'required|max:30',
            'password' => 'required|min:8|max:30',

        ]);

        $member->first_name = $req->first_name;
        $member->last_name = $req->last_name;
        $member->email = $req->email;
        $member->password = $req->password;
        $member->save();

        $data ="dear ".($req->first_name ." ".$req->last_name) ." your account has been created . Please login" ;
        $req->session()->flash('note',$data);
        return redirect ('login');
    }

    function memberSignin(Request $req)
    {
        $req->validate([
            'email' => 'required|max:30',
            'password' => 'required|min:8|max:30'

        ]);

        $check = Member::where([
            ['email','=',$req->email],
            ['password','=',$req->password]
        ])->first();

        if ($check)
        {
            $req->session()->put( 'user', $check->first_name);
            //$req->session()->put( 'email', $check->email);

            return redirect('memberDashboard');

        }
        else
        {
            $data = "Your email or password is incorrect";
            $req->session()->flash('note',$data);
            return redirect ('login');

        }



    }
}
