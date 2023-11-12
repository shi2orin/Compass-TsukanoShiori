@extends('layouts.sidebar')

@section('content')
<div class="vh-100 border">
  <div>
    <h5 class="m-3">自分のプロフィール</h5>
    <div class="user_status w-75 p-3">
      <p>名前：<span>{{ Auth::user()->over_name }}</span><span class="ml-1">{{ Auth::user()->under_name }}</span></p>
      <p>カナ：<span>{{ Auth::user()->over_name_kana }}</span><span class="ml-1">{{ Auth::user()->under_name_kana }}</span></p>
      <p>性別：@if(Auth::user()->sex == 1)<span>男</span>@else<span>女</span>@endif</p>
      <p>生年月日：<span>{{ Auth::user()->birth_day }}</span></p>
    </div>
  </div>
</div>
@endsection
