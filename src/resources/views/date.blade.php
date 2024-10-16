@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__alert">
  <p>
    {{Auth::user()->name }}
  </p>
</div>

<div class="attendance__content">
  <div class="row">
    @foreach($rows as $row)
    @if($row->image_path)
    <div class="attendance__list">
        <div class="portfolio-item" style="text-align:center">
            <a class="portfolio-link" href="{{ route('attendance.show', $attendance->id) }}">
                <img src="{{ $attendance->image_path }}" height="200" width="200">
            </a>
            <div class="portfolio-caption" style="margin-top:10px">
                <div class="portfolio-caption-heading">{{ $attendance->name }}</div>
                <div class="portfolio-caption-subheading text-muted">{{ $attendance->workdate }}</div>
                <div class="portfolio-caption-subheading text-muted">{{ $attendance->players_minimum }}~{{ $attendance->players_max }}</div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
</div>
@endsection