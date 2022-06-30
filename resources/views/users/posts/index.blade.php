@extends('layouts.app')

@section('content')
    <main class="resume-body">
        User posts
        <div>This is Jelly {{ $user->name }} and received {{ $user->receivedLikes->count() }}</div>

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
                <p>{{ $user->name }} hasn't posted yet</p>
            </div>
        @endif
    </main>
@endsection
