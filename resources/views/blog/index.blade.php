@extends('layouts.app')

@section('content')
    <main class="blog-feed-body">
        {{-- Blog feed
        <div>You are {{ auth()->user()->name }}</div> --}}
        <section class="sec-form">
            <form action="{{ route("blog") }}" method="POST">
                @csrf
                <div class="input-group @error('title') missing @enderror">
                    <label for="title" class="sr-only">Title</label>
                    <input type="text" name="title" id="title" placeholder="Your post title">
                    @error('title')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group @error('sum') missing @enderror">
                    <label for="sum" class="sr-only">Summary</label>
                    <textarea name="sum" id="sum" cols="30" rows="4" placeholder="Post something!"></textarea>
                    @error('sum')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group @error('category') missing @enderror">
                    <label for="category" class="sr-only">Category</label>
                    <input type="text" name="category" id="category" placeholder="Category">
                    @error('category')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group @error('tags') missing @enderror">
                    <label for="tags" class="sr-only">Tags</label>
                    <input type="text" name="tags" id="tags" placeholder="Split by coma">
                </div>

                <div class="input-group">
                    <button type="submit">Post it</button>
                </div>
            </form>
        </section>

        @if ($posts->count())
            <div class="blog-feed-container">
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach
            </div>
            {{-- {{ $posts->links() }} --}}
            @if ($posts->hasPages())
                <div class="blog-feed-pagination">
                    <ul class="pagination-bar">
                        @php
                            $currPg = $posts->currentPage();
                        @endphp
                        @if (!$posts->onFirstPage())
                            <li class="arrow"><a href="{{ $posts->previousPageUrl() }}"><</a></li>
                        @endif
                        @if (ceil($posts->total() / $posts->perPage()) < 8)
                            @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                @if ($currPg == $i)
                                    <li class="selected">{{ $i }}</li>
                                @else
                                    <li><a href="{{ $posts->url($i) }}">{{ $i }}</a></li>
                                @endif
                            @endfor
                        @else
                            @php
                                $middlePages = range(2, $posts->lastPage() - 1);
                                $firstMid = array_slice($middlePages, 0, 3);
                                $lastMid = array_slice($middlePages, -3, 3);
                                $linkSet = [];
                                if ($posts->onFirstPage() || in_array($currPg, $firstMid)) {
                                    $linkSet = array_merge($firstMid, [$firstMid[2] + 1], ["..."]);
                                }
                                if ($posts->onLastPage() || in_array($currPg, $lastMid)) {
                                    $linkSet = array_merge(["..."], [$lastMid[0] - 1], $lastMid);
                                }
                                if ($currPg > $firstMid[2] && $currPg < $lastMid[0]) {
                                    $linkSet = ["...", $currPg - 1, $currPg, $currPg + 1, "..."];
                                }
                                $linkSet = array_merge([1], $linkSet, [$posts->lastPage()])
                            @endphp
                            @for ($i = 0; $i < count($linkSet); $i++)
                                @if ($currPg == $linkSet[$i])
                                    <li class="selected">{{ $linkSet[$i] }}</li>
                                @else
                                    <li><a href="{{ $posts->url($linkSet[$i]) }}">{{ $linkSet[$i] }}</a></li>
                                @endif
                            @endfor
                        @endif
                        @if (!$posts->onLastPage())
                            <li class="arrow"><a href="{{ $posts->nextPageUrl() }}">></a></li>
                        @endif
                    </ul>
                </div>
            @endif
        @else
            <div class="blog-feed-footnote">
                <p><b>Oops!</b></p>
                <p>No posts found yet</p>
            </div>
        @endif
        {{-- <div class="blog-feed-container">
            <div class="blog-item">
                <a href="#" class="blog-img">
                    <img src="media/blog-image.jpg" alt="susu.jpg">
                </a>
                <div class="blog-desc">
                    <div class="blog-title">
                        <a href=""><h2>Hey, here's a title</h2></a><a href="#" class="blog-category">Category</a>
                    </div>
                    <p class="blog-sum">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <ul class="blog-tags">
                        <li><a href="">Haha</a></li>
                        <li><a href="">Hehe</a></li>
                        <li><a href="">Hihi</a></li>
                    </ul>
                </div>
            </div>
            <div class="blog-item">
                <a href="#" class="blog-img">
                    <img src="media/blog-image.jpg" alt="susu.jpg">
                </a>
                <div class="blog-desc">
                    <div class="blog-title">
                        <a href=""><h2>Hey, here's a title</h2></a><a href="#" class="blog-category">Category</a>
                    </div>
                    <p class="blog-sum">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <ul class="blog-tags">
                        <li><a href="">Haha</a></li>
                        <li><a href="">Hehe</a></li>
                        <li><a href="">Hihi</a></li>
                    </ul>
                </div>
            </div>
            <div class="blog-item">
                <a href="#" class="blog-img">
                    <img src="media/blog-image.jpg" alt="susu.jpg">
                </a>
                <div class="blog-desc">
                    <div class="blog-title">
                        <a href=""><h2>Hey, here's a title</h2></a><a href="#" class="blog-category">Category</a>
                    </div>
                    <p class="blog-sum">Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                    <ul class="blog-tags">
                        <li><a href="">Haha</a></li>
                        <li><a href="">Hehe</a></li>
                        <li><a href="">Hihi</a></li>
                    </ul>
                </div>
            </div>
        </div> --}}
    </main>
@endsection
