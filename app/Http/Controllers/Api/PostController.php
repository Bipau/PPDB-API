<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


//import post model
use App\Models\Post;

//import resource PostResource
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        //get all post

        $post = Post::latest()->paginate(5);

        //return collection of posts as a resource
        return new PostResource(true, 'List Data Post', $post);
    }
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
        
    }

    public function show($id)
    {
        $post = Post::find($id);

        return new PostResource(true, 'Detail Data Post', $post);
    }
    

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    

    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::find($id);
        
        	//check image upload
            if ($request->hasFile('image')) {
                // Upload new image
                $image = $request->file('image');
                $image->storeAs('public/posts', $image->hashName());
            
                // Delete old image if exists
            
                Storage::delete('public/posts/'.basename($post->image));
                
                // Update with new image
                $post->update([
                    'image' => $image->hashName(),
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
            } else {
                // Update without image
                $post->update([
                    'title' => $request->title,
                    'content' => $request->content,
                ]);
            }

            return new PostResource(true, 'Data Post berhasil di edit', 422);
    }
    public function destroy($id)
    {
        $post = Post::find($id);

        //delete image
        Storage::delete('public/posts/'.basename($post->image));

        $post->delete();

        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
