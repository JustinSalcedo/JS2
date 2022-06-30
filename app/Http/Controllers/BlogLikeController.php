<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Blog $blog, Request $request)
    {
        if ($blog->likedBy($request->user())) {
            return response(null, 409);
        }

        $blog->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Blog $blog, Request $request)
    {
        $request->user()->likes()->where('blog_id', $blog->id)->delete();

        return back();
    }
}
