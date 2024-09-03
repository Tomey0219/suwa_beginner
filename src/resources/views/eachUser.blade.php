@extends('layout.layout')

@section('ttl')
    EachUserPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/eachUser.css')}}">
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

    <h2>{{ $user_name }}さんの勤怠</h2>

    <table class="daily_attendance_tbl">
        <tr>
            <th>日付</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach ($attendance_array as $att)
        <tr>
            <td>{{ $att['date'] }}</td>
            <td>{{ $att['starttime'] }}</td>
            <td>{{ $att['endtime'] }}</td>
            <td>{{ $att['breaktime'] }}</td>
            <td>{{ $att['worktime'] }}</td>
        </tr>
        @endforeach
    </table>

    {{ $attendances->appends(['name'=>$user_name,'id'=>$user_id])->links('vendor.pagination.tailwind') }}

@endsection