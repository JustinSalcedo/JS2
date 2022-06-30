@props(['post' => $post])

<div class="blog-item">
    <a href="#" class="blog-img">
        <img src="media/blog-image.jpg" alt="susu.jpg">
    </a>
    <div class="blog-desc">
        <div class="blog-title">
            <a href=""><h2>{{ $post->title }}</h2></a><a href="#" class="blog-category">{{ $post->category }}</a>
        </div>
        <p class="blog-sum">{{ $post->sum }}</p>
        <p><a href="{{ route('user.posts', $post->user) }}">{{ $post->user->name }}</a> - {{ $post->created_at->diffForHumans() }}</p>
        <div class="" style="display: flex; flex-direction:row; margin: -.5rem 0 .5rem;">
            @auth
                @if (!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.likes', $post) }}" method="POST">
                        @csrf
                        <button type="submit">Like</button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unlike</button>
                    </form>
                @endif

                @can('delete', $post)
                    <form action="{{ route('blog.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                @endcan
            @endauth
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        </div>
        <ul class="blog-tags">
            @foreach (json_decode($post->tags) as $tag)
                <li><a href="">{{ $tag }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
