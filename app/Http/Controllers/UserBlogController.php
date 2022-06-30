<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    public function index(User $user)
    {
        $posts = $user->blogs()->with(['user', 'likes'])->paginate(20);

        return view('users.posts.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
