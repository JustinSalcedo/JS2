<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // $posts = Blog::get(); // Collection of all
        $posts = Blog::latest()->with(['user', 'likes'])->paginate(20);

        // dd($posts->getUrlRange(1, 2));

        return view('blog.index', [
            'posts' => $posts
        ]);
    }

    public function show(Blog $blog)
    {
        return view('blog.show', [
            'entry' => $blog
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'sum' => 'required|max:255',
            'category' => 'required|max:100'
        ]);

        $request->user()->blogs()->create([
            'title' => $request->title,
            'sum' => $request->sum,
            'category' => $request->category,
            // 'tags' => json_encode($request->tags)
            'tags' => '["Haha", "Hehe", "Hoho"]'
        ]);

        return back();
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);
        $blog->delete();

        return back();
    }
}
