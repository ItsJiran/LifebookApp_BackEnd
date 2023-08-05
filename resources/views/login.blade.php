@extends('layouts.auth')

@section('title', 'Login')

@section('auth-form')
    <form class='auth-form' method='POST' action='/login'>
        @csrf
        <input name='email' type='email' required placeholder='Email'/>
        <input name='password' type='password' required placeholder="Password"/>
        <button class='btn'>SUBMIT</button>
    </form>
@endsection

