@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto">投稿一覧</p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="post_comment">{{$post->commentCounts($post->id)}}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{$like->likeCounts($post->id)}}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25" style="margin-right:100px;" >
    <div class="m-4">
      <div class="post_btn btn w-100 mb-4"><a href="{{ route('post.input') }}" >投稿</a></div>
      <div class="d-flex mb-4">
        <input type="text" class="w-75 category_search" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input type="submit" class="category_btn w-25 btn "value="検索" form="postSearchRequest"style="background:#03AAD2;">
      </div>
      <div class="d-flex mb-4">
        <input type="submit" name="like_posts" class="category_btn btn  w-50" value="いいねした投稿" form="postSearchRequest" style="background:#ff9ece;">
        <input type="submit" name="my_posts" class="category_btn btn  w-50" value="自分の投稿" form="postSearchRequest"style="background:#ffd700;">
      </div>
      <div><p>カテゴリー検索</p>
      <div class="category">

     @foreach($main_categories as $main_category)
    <div class="category_item">
      <p class="main_category js-main_category border-bottom border-secondary">
        {{ $main_category->main_category }}
      </p>
      <!--/.accordion-title-->
      <div class="sub_category">
              <ul>
                @foreach($sub_categories->where('main_category_id', $main_category->id) as $sub_category)
                <li class="border-bottom border-secondary"><input type="submit" name="category_word"value="{{ $sub_category->sub_category }}"form="postSearchRequest" style="border:none;">
                </li>
                @endforeach
              </ul>
      </div>
      <!--/.accordion-content sub_category-->
    </div>
     @endforeach
     <!--/.accordion-item main_category-->

<!--/.accordion-container消した-->
</div>
<!--/.accordionはcategory-->

  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
<!-- otherareaのやつ -->
</div>
<!-- bordareaのやつ -->

@endsection
