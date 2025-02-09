@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <p>
    {{Auth::user()->name }}さんお疲れ様です！
  </p>
</div>

<div class="attendance__content">
  <div class="attendance__panel">
    <form class="attendance__button" action="/attendance" method="post">
      @csrf
      <button class="attendance__button-submit" type="submit" id="attendance_start">勤務開始</button>
    </form>
    <form class="attendance__button" action="/attendance/update" method="post">
      @method('PATCH')
      @csrf
      <button class="attendance__button-submit" type="submit" id="attendance_end">勤務終了</button>
    </form>
  </div>
  <br>
  <div class="attendance__panel">
    <form class="attendance__button" action="/rest" method="post">
      @csrf
      <button class="attendance__button-submit" type="submit">休憩開始</button>
    </form>
    <form class="attendance__button" action="/rest/update" method="post">
      @method('PATCH')
      @csrf
      <button class="attendance__button-submit" type="submit">休憩終了</button>
    </form>
  </div>
</div>
<script>
</script>
@endsection