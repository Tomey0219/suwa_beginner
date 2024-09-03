@extends('layout.layout')

@section('ttl')
    AllUserPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/allUser.css')}}">
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

    <div class="scroll_box">
        <table class="user_tbl">
            <tr>
                <th colspan="2">名前</th>
            </tr>
            @foreach($users as $user)
                <form action="/eachuser" method="POST">
                @csrf
                <tr>
                    <td>
                        {{ $user['name'] }}
                        <input type="hidden" name="id" value="{{ $user['id'] }}">
                        <input type="hidden" name="name" value="{{ $user['name'] }}">
                    </td>
                    <td>
                        <button class="attendance_btn" type="submit">勤怠</button>
                    </td>
                </tr>
                </form>
            @endforeach
        </table>
    </div>

@endsection