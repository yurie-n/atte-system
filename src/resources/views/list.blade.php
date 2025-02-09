@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__date__content">
  <form class="previous__day__button" action="/list/prev" method="get">
    @csrf
    <button class="previous__day__button-submit" type="submit">＜</button>
  </form>
  <p>
    {{$_SESSION['current_date']->format('Y-m-d') }}
  </p>
  <form class="next__day__button" action="/list/next" method="get">
    @csrf
    <button class="next__day__button-submit" type="submit">＞</button>
  </form>
</div>

<div class="attendance__alert">
  @if (session('message'))
  <div class="attendance__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if ($errors->any())
  <div class="attendance__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<div class="attendance__content">
  <div class="attendance-table">
    <table class="attendance-table__inner">
      <tr class="attendance-table__row">
        <th class="attendance-table__header">名前</th>
        <th class="attendance-table__header">勤務開始</th>
        <th class="attendance-table__header">勤務終了</th>
        <th class="attendance-table__header">休憩時間</th>
        <th class="attendance-table__header">勤務時間</th>
      </tr>
      @foreach ($attendance as $datas)
      <tr class="attendance-table__row">
        <td class="list-table__item">
          <div class="list-table__item">{{ $datas->name }}</div></td>
        <td class="list-table__item">
          <div class="list-table__item">{{ $datas->work_start_time }}</div></td>
        <td class="list-table__item">
          <div class="list-table__item">{{ $datas->work_end_time }}</div></td>
        <td class="list-table__item">
          <div class="list-table__item">{{ $datas->total_rest_time }}</div></td>
        <td class="list-table__item">
          <div class="list-table__item">{{ $worktimes[$loop->index] }}</div></td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
<script>
</script>
@endsection