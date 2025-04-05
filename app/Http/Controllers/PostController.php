<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostCreateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $posts = Post::with('user')->get(); 
        return view("posts_crud.index",compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     return view('posts_crud.create');   
    }

    /**
     * 
     * 
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
       
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null; 
        }
    
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath, 
            'user_id' => Auth::id(), 
        ]);
    
        return redirect()->route('posts.index');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);   
        return view('posts_crud.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

    if (Auth::id() !== $post->user_id) {
        return redirect()->route('posts.index');
    }

    return view('posts_crud.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */ 
    public function update(Request $request, string $id)
    {

        $post = Post::findOrFail($id);  
    if ($request->hasFile('image')) {
        if ($post->image && file_exists(public_path('storage/' . $post->image))) {
            unlink(public_path('storage/' . $post->image));  
        }
        $imagePath = $request->file('image')->store('images', 'public');
        $post->image = $imagePath;  
    }

    $post->update([
        'title' => $request->title,
        'content' => $request->content,
    ]);


        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{

    // Rasmni o‘chirish
    if ($post->image) {
        $imagePath = public_path('storage/' . $post->image);
        
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $post->delete();

    return redirect()->route('posts.index');
}

    
}