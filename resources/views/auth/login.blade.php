@extends('layouts.auth')

@section('title', 'Login')

@section('auth-form')
    <form class='auth-form shadow-3 bg-white-1 border-rounded-1' method='POST' action='/login'>
        @csrf
        <input class='input-2' name='email' type='email' required placeholder='Email'/>
        <input class='input-2' name='password' type='password' required placeholder="Password"/>
        <button class='btn'>SUBMIT</button>
        <p class='dark-blue-1 medium label-4 text-center'> Belum punya akun ? <a class='blue-2'>Register Sekarang</a></p>
    </form>
@endsection

