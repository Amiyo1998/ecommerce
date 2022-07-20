<?php

namespace App\Http\Controllers\backend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $data['title'] = __("Post");
        $data['posts'] = Post::with('category','tags')->paginate(6);
        return view('backend.pages.post.index', $data);
    }
    public function create()
    {
        $data['title'] = __("Post/Create");
        $data['categories'] = Category::select('id','name')->get();
        $data['tags'] = Tag::all();
        return view('backend.pages.post.create', $data);
    }
    public function store(PostRequest $request)
    {
        $path = '';
        if($request->hasFile("image")){
            $path = $request->file("image")->store('images/posts');
        }
        $post =Post::create([
            'cat_id' =>$request->get('cat_id'),
            'tag_id' =>$request->get('tag_id'),
            'title' =>$request->get('title'),
            'short_description' =>$request->get('short_description'),
            'description' =>$request->get('description'),
            'image' => $path
        ]);
        $post->tags()->attach($request->tag_id);
        if(empty($post))
        {
            return redirect()->back();
        }
        return redirect()->route('posts.index')->with('message', 'Post created successfull!!');
    }
    public function show($id)
    {
        //
    }
    public function edit(Post $post)
    {
        $data['title'] = __("Post/Edit");
        $data['post'] = $post;
        $data['tags'] = Tag::all();
        return view('backend.pages.post.edit', $data);
    }
    public function update(PostRequest $request, Post $post)
    {
        $path = '';
        if($post->image){
            Storage::delete($post->image);
        }
        if($request->hasFile("image")){
            $path = $request->file("image")->store('images/posts');
        }
        $params = $request->only(['cat_id','tag_id','title','short_description','description']);
        $params['image'] = $path;
        if($post->update($params))
        {
            $params = $post->tags()->sync($request->tags);
            return redirect()->route('posts.index')->with('message', 'Post edited successfull!!');
        }
    }
    public function destroy(Post $post)
    {
        if( Storage::delete($post->image)){
            $post->delete();
        }
        return redirect()->route('posts.index')->with('message', 'Post deleted successfull!!');
    }
}
