@extends('layouts.mail_template')

@section('content')
    <p>
        <div>Meet App です。</div>
        <div>仮登録完了しました。</div>
        <div>ユーザー登録はまだ完了しておりません。</div>
        <div>下記リンクから登録を完了してください。</div>
        <a href="{{ config('app.spa_url') . '/email_verify?url=' . $verification_url }}">ユーザー登録を完了する</a>
    </p>
@endsection