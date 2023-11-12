@extends('layouts.sidebar')
@section('content')
<div class="w-100 vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class=" top_area w-75 vh-25 border p-5">
      <h4 class="text-center">{{ $calendar->getTitle() }}</h4>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn mt-3 text-right">
      <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection
