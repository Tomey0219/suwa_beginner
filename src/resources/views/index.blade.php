@extends('layout.layout')

@section('ttl')
    InputPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('header_btn')
    <div class="div_header_btn">
        <form class="form_header_btn" action="/" method="get">
        @csrf
            <button class="header_btn">ホーム</button>
        </form>
        <form class="form_header_btn" action="/attendance" method="get">
        @csrf
            <button class="header_btn">日付一覧</button>
        </form>
        <form class="form_header_btn" action="/alluser" method="get">
        @csrf
            <button class="header_btn">ユーザ一覧</button>
        </form>
        <form class="form" action="/logout" method="post">
        @csrf
            <button class="header_btn">ログアウト</button>
        </form>
    </div>
@endsection

@section('content')
    <h2>{{ $user }}さんお疲れ様です！</h2>

    <div class="grid">
        <form class="form_work_start" action="/workstart" method="post">
        @csrf
            @empty($input_status)
                <button class="work_start_btn">勤務開始</button>
            @else
                <button class="work_start_btn" disabled>勤務開始</button>
            @endempty
        </form>
        <form class="form_work_end" action="/workend" method="post">
        @csrf
            @empty($input_status)
                <button class="work_end_btn" disabled>勤務終了</button>
            @else
                @empty($break_status)
                    <button class="work_end_btn">勤務終了</button>
                @else
                    <button class="work_end_btn" disabled>勤務終了</button>
                @endempty
            @endempty
        </form>
        <form class="form_break_start" action="/breakstart" method="post">
        @csrf
            @empty($input_status)
                <button class="break_start_btn" disabled>休憩開始</button>
            @else
                @empty($break_status)
                    <button class="break_start_btn">休憩開始</button>
                @else
                    <button class="break_start_btn" disabled>休憩開始</button>
                @endempty
            @endempty
        </form>
        <form class="form_break_end" action="/breakend" method="post">
        @csrf
            @empty($input_status)
                    <button class="break_end_btn" disabled>休憩終了</button>
            @else
                @empty($break_status)
                    <button class="break_end_btn" disabled>休憩終了</button>
                @else
                    <button class="break_end_btn">休憩終了</button>
                @endempty
            @endempty
        </form>
    </div>

@endsection