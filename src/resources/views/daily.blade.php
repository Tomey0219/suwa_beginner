@extends('layout.layout')

@section('ttl')
    DailyPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/daily.css')}}">
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
        <form class="form" action="/logout" method="post">
        @csrf
            <button class="header_btn">ログアウト</button>
        </form>
    </div>
@endsection

@section('content')
    <div class="div_date_chg">
        <form class="form_date_chg" action="/attendance" method="post">
        @csrf
            <button class="back_date_chg_btn" name="back_btn" type="submit">&lt;</button>
            <input class="date" type="text" name="current_date" value="{{ $date }}" readonly>
            <button class="next_date_chg_btn" name="next_btn"  type="submit">&gt;</button>
        </form>
    </div>
    <table class="daily_attendance_tbl">
        <tr>
            <th>名前</th>
            <th>勤務開始</th>
            <th>勤務終了</th>
            <th>休憩時間</th>
            <th>勤務時間</th>
        </tr>
        @foreach ($attendance_array as $att)
        <tr>
            <td>{{ $att['name'] }}</td>
            <td>{{ $att['starttime'] }}</td>
            <td>{{ $att['endtime'] }}</td>
            <td>{{ $att['breaktime'] }}</td>
            <td>{{ $att['worktime'] }}</td>
        </tr>
        @endforeach
    </table>

    {{ $attendances->links('vendor.pagination.tailwind') }}
    
@endsection