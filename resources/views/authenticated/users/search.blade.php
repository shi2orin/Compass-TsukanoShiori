@extends('layouts.sidebar')

@section('content')
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span >ID : </span><span class="person_bold">{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="person_bold">{{ $user->over_name }}</span>
          <span class="person_bold">{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span class="person_bold">({{ $user->over_name_kana }}</span>
        <span class="person_bold">{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span class="person_bold">男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span class="person_bold">女</span>
        @else
        <span>性別 : </span><span class="person_bold">その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span class="person_bold">{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span class="person_bold">教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span class="person_bold">教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span class="person_bold">講師(英語)</span>
        @else
        <span>権限 : </span><span class="person_bold">生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目 :</span>
        @foreach($user->subjects as $subject)
        <span class="person_bold">{{$subject->subject}}</span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 ">
    <div class="w-100 m-0">
      <h3>検索</h3>
      <div>
        <input type="text" class="free_word user_search" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div >
        <label class="d-block">カテゴリ</label>
        <select form="userSearchRequest" name="category" class="user_search">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <label class="d-block">並び替え</label>
        <select name="updown" form="userSearchRequest" class="user_search">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="mt-5">
        <div class="m-0 w-75 search_conditions border-bottom border-secondary">
          <span class="" style="color:#44617b;">検索条件の追加</span>
        <div class="arrow-wrap"><span class="arrow"></span></div>
        </div>

        <div class="search_conditions_inner">
          <div>
            <label>性別</label>
            <div>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
            </div>
          </div>
          <div>
            <label>権限</label>
            <div>
            <select name="role" form="userSearchRequest" class="engineer user_search">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
            </div>
          </div>
          <label class="">選択科目</label>
          <div class="selected_engineer d-flex">
              @foreach($subjects as $subject)
              <div class="">
                <input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
                <span>{{ $subject->subject }}</span>
              </div>
              @endforeach
          </div>
        </div>
      </div>
      <div>
        <input type="submit" class="btn btn-primary w-75 my-3" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div>
        <input type="reset" value="リセット" form="userSearchRequest" class="w-75" style="border:none;color:#03AAD2;">
      </div>

    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
