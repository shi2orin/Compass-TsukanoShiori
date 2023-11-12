@extends('layouts.sidebar')

@section('content')
<div class="top_area w-75 vh-100 m-auto p-5">
  <div class="w-100">
    <h4 class="text-center">{{ $calendar->getTitle() }}</h4>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection
