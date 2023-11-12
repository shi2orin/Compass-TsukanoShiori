@extends('layouts.sidebar')

@section('content')
<span class="p-3">{{ $user->over_name }}</span><span>{{ $user->under_name }}さんのプロフィール</span>
<div class="vh-100 border">
  <div class="w-75 m-auto pt-5">
    <div class="top_area user_status p-3">
      <p>名前 : <span>{{ $user->over_name }}</span><span class="ml-1">{{ $user->under_name }}</span></p>
      <p>カナ : <span>{{ $user->over_name_kana }}</span><span class="ml-1">{{ $user->under_name_kana }}</span></p>
      <p>性別 : @if($user->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日 : <span>{{ $user->birth_day }}</span></p>
      <div>選択科目 :
        @foreach($user->subjects as $subject)
        <span>{{ $subject->subject }}</span>
        @endforeach
      </div>
      <div class="">
        @can('admin')
        <div class="subject_edit_btn">
        <span class="mr-3">選択科目の登録</span>
        <div class="arrow-wrap"><span class="arrow" style="color:#03AAD2;"></span></div>
        </div>
        <div class="subject_inner">
          <form action="{{ route('user.edit') }}" method="post" class="d-flex">
            @foreach($subject_lists as $subject_list)
            <div class="p-2">
              <label >{{ $subject_list->subject }}</label>
              <input type="checkbox" name="subjects[]" value="{{ $subject_list->id }}">
            </div>
            @endforeach
            <input type="submit" value="登録" class="btn btn-primary">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            {{ csrf_field() }}
          </form>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>

@endsection
