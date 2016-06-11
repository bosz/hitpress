<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        return $request->all();
        $user=Auth::user();
        $input=$request->all();

        //photo file
        if($file=$request->photo_id){
            $name=$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;

        }

        //NOTE!! inserting data into posts table with user_id of user who is creating this note
        $user->posts()->create($input);
        return redirect()->route('admin.post.index');

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
        //
        $post= Post::findOrFail($id);
        $category=Category::lists('name','id');
        return view('admin.posts.edit',compact('post','category'));
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
        //
        $input=$request->all();
        $post=Post::findOrFail($id);
        if ($file=$request->photo_id){
            $name=$file->getClientOriginalName();
            $file->move('images',$name);
            $photo=Photo::create(['file'=>$name]);
            $input['photo_id']=$photo->id;

        }
         $post->update($input);
        return redirect()->route('admin.post.index');
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
    }
}
