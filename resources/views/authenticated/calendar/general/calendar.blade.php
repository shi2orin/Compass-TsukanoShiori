@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="top_area w-75 m-auto pt-5 pb-5">
    <div class="m-auto" style="width:90%;">

      <h4 class="text-center">{{ $calendar->getTitle() }}</h4>
      <div class="">
        {!! $calendar->render() !!}
      </div>
      <div class="adjust-table-btn text-right mt-5">
        <input type="submit" class="btn btn-primary " value="予約する" form="reserveParts">
      </div>
    </div>

  </div>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
      <div class="modal__content w-75">
        <div class="w-75 m-auto">
        <p class="reserveDay"></p>
        <p class="reservePart"></p>
        <p>上記の予約をキャンセルしてもよろしいでしょうか？</p>
        </div>
          <div class="w-75 m-auto d-flex justify-content-between">
            <div class="modal-close  btn btn-primary d-block ">閉じる</div>
            <input type="submit" class="btn btn-danger delete-btn d-block" value="キャンセル" form="deleteParts">
          </div>
      </div>
    </div>
</div>
@endsection
