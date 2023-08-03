@extends('layouts.auth')

@section('title', 'Register')


@section('auth-form')
        <h1></h1>
        <form class='auth-form' method='POST' action='/login'>
            <div class='auth-input-container'>
                <label>Email</label>
                <input name='email' type='email' required placeholder='Isi Email'/>
            </div>
            <div class='auth-input-container'>
                <label>Password</label>
                <input name='password' type='password' required placeholder="Isi Password"/>
            </div>
        </form>
@endsection

