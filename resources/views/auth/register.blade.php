@extends('layouts.auth')

@section('title', 'Register')

@section('auth-form')
    <form class='auth-form' method='POST' action='/register'>
        @csrf
        <input value='{{old("name")}}' name='name' required placeholder='Name'/>
        <input value='{{old("email")}}' name='email' type='email' required placeholder='Email'/>
        <input name='password' type='password' required placeholder="Password"/>
        <input name='password_confirmation' type='password' required placeholder="Re-Password"/>

        @if($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif

        <button class='btn'>SUBMIT</button>
    </form>
@endsection

