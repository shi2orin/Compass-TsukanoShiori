@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-75 m-auto h-75">
    @foreach($reservePersons as $reservePerson)
    <h4><span>{{$reserveDate}}</span><span class="ml-3">{{$part}}部</span></h4>
        <div class="top_area  border p-1">
          <table class="reserve_detail text-center w-100">
            <tr class="">
              <th class="pl-5">ID</th>
              <th class="w-50 ">名前</th>
              <th class="w-50 ">場所</th>
            </tr>
            @foreach($reservePerson->users as $user)
            <tr class="">
              <td class="pl-5">{{ $user->id }}</td>
              <td class="w-50 ">{{ $user->over_name }}{{ $user->under_name }}</td>
              <td class="w-50 ">リモート</td>
            </tr>
            @endforeach
          </table>
        </div>

    @endforeach
  </div>
</div>
@endsection
