<?php

namespace hitpress\Http\Controllers;

use hitpress\Category;
use hitpress\Comment;
use hitpress\Photo;
use hitpress\Post;
use Illuminate\Http\Request;

use hitpress\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $categories=Category::lists('name','id');
        return view('admin.posts.create',compact('categories'));

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
        $post=Post::find($id);
        unlink(public_path(). $post->photo->file);

        $post->delete();
        
        Session::flash('deleted_post','Post has been deleted Successfully');

        return redirect()->route('admin.post.index');
    }

    public function post($id){

        $post=Post::findOrFail($id);
        $comments=$post->comments()->orderBy('id','DESC')->get();
        return view('post',compact('post','comments'));
    }
    
    public function home(){
        $posts=Post::orderBy('created_at','DESC')->get();

        return view('front-page',compact('posts'));
    }
}
