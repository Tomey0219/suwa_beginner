@extends('layout.layout')

@section('ttl')
    LoginPage    
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header_btn')
    <div></div>
@endsection

@section('content')
    <h2>ログイン</h2>

    <form class="form_login_tbl" action="/login" method="post">
    @csrf
        <table class="login_tbl">
            <tr>
                <td>
                    <input class="login_tbl_input" type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}" >
                </td>
            </tr>
            <tr>
                <td class="login_tbl_margin">
                    @error('email')
                        @foreach ($errors->get('email') as $error)
                            {{ $error }}
                        @endforeach
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <input class="login_tbl_input" type="text" name="password" placeholder="パスワード">
                </td>
            </tr>
            <tr>
                <td class="login_tbl_margin">
                    @error('password')
                        @foreach ($errors->get('password') as $error)
                            {{ $error }}
                        @endforeach
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <button class="login_btn" type="submit">ログイン</button>
                </td>
            </tr>
            <tr><td class="login_tbl_margin"></td></tr>
            <tr>
                <td class="login_tbl_registerlink">
                    <p>アカウントをお持ちの方はこちらから</p>
                    <a class="login_tbl_registerlink_btn" href="http://localhost/register">会員登録</a>
                </td>
            </tr>
        </table>
    </form>
@endsection