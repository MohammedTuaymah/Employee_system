<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SendMail;
use App\Models\User;

class MailController extends Controller
{
    public function create(){
        return view('admin.mail.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'file'=>'mimes:docx,doc,pdf,jpeg,png,jpg',
            'body'=>'required'
        ]);

        $image = $request->file('file');
        $details = [
            'body'=>$request->body,
            'file'=>$image
        ];
        //dd($request->all());

        //get all the Users Come from the choosing department, and loop it
        if($request->department){
            $users = User::where('department_id',$request->department)->get();
            foreach($users as $user){
                \Mail::to($user->email)->send(new SendMail($details));//($details)=> passing the details to the Email
            }
        }elseif($request->person){
            $user = User::where('id',$request->person)->first();
            $userEmail=$user->email;
            \Mail::to($user->email)->send(new SendMail($details));//($details)=> passing the details to the Email

        }else{//if not selected anything, sent to all Users
            $users = User::get();
            foreach($users as $user){
                \Mail::to($user->email)->send(new SendMail($details));//($details)=> passing the details to the Email
            }
        }
        return redirect()->back()->with('message','Email Sent');
    }
}
