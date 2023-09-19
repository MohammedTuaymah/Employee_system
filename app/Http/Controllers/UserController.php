<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string',
            'department_id'=>'required',
            'role_id'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'start_from'=>'required',
            'designation'=>'required'
        ]);

        $data = $request->all();
        //dd($data);
        if($request->hasFile('image')){//if user uploaded the new file Image or not
            $image = $request->image->hashName();
            $request->image->move(public_path('profile'),$image);

        }else{//if user Not uploaded Image, Save The Default Image
            $image = 'avatar2.png';
        }
        $data['name'] = $request->firstname.' '.$request->lastname;
        $data['image']=$image;
        $data['password']= bcrypt($request->password);
        User::create($data);
        return redirect()->back()->with('message','User created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|string|email|max:255|unique:users,email,'.$id,
            'department_id'=>'required',
            'role_id'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'start_from'=>'required',
            'designation'=>'required'
        ]);
        $data = $request->all();
        $user = User::find($id);
        if($request->hasFile('image')){
            $image = $request->image->hashName();
            $request->image->move(public_path('profile'),$image);
        }else{
            $image = $user->image;
        }
        if($request->password){// if user add new password
            $password = $request->password;
        }else{// else keep the old password
            $password = $user->password;
        }
        $data['image']=$image;
        $data['password']= bcrypt($password);
        $user->update($data);// update all Data
        return redirect()->back()->with('message','User updated Successfully');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('message','User deleted Successfully');
    }
}
