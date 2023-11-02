@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    @foreach($reservePersons as $reservePerson)
    <p><span>{{$date}}</span><span class="ml-3">{{$part}}部</span></p>
      @foreach($reservePerson->users as $user)
        <div class="h-75 border">
          <table class="">
            <tr class="text-center">
              <th class="w-25">ID</th>
              <th class="w-25">名前</th>
              <th class="w-25">場所</th>
            </tr>
            <tr class="text-center">
              <td class="w-25">{{ $user->id }}</td>
              <td class="w-25">{{ $user->over_name }}{{ $user->under_name }}</td>
              <td class="w-25">リモート</td>
            </tr>
          </table>
        </div>
      @endforeach
    @endforeach
  </div>
</div>
@endsection
