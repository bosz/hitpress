<?php

namespace hitpress\Http\Controllers;

use hitpress\Http\Requests\UsersRequest;
use hitpress\Http\Requests\UserEditRequest;
use hitpress\Role;
use hitpress\User;
use hitpress\Photo;
use Illuminate\Http\Request;

use hitpress\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users= User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=Role::lists('name','id');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //get all form data
        //check if password field is empty
        if(trim($request->password)==''){
            $input=$request->except('password');
        }else{
            $input=$request->all();
        }

        if($file=$request->photo_id){
            $name=$file->getClientOriginalName();
            $file->move('images',$name);

            //inserting data into photo table
            $photo=Photo::create(["file"=>$name]);

            //assigning id of photo in photos table to photo_id key in $input array
            $input['photo_id']=$photo->id;
        }

        $input['password']=bcrypt($request->password);
        //insert data into users table
        User::create($input);

        return redirect()->route('admin.users.index');
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
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        $roles=Role::lists('name','id');
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        if(trim($request->password)==''){
            $input=$request->except('password');
        }else{
            $input=$request->all();
        }

        //updating photo if photo is  updated by user
        if ($file = $request->photo_id) {


            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file' => $name]);

            $input['photo_id']=$photo->id;

        }

        $input['password']=bcrypt($request->password);

        $user->update($input);

        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user=User::findOrFail($id);

        if($user->photo) {
            unlink(public_path() . $user->photo->file);
        }

        $user->delete();

        Session::flash('deleted_user',"User deleted Successfully");



        return redirect()->route('admin.users.index');
    }
}
