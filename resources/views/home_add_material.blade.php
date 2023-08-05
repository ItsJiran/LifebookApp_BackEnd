@extends('layouts.home')

@section('title','Create Materials')

@section('layout-main-content')
    <div class='layout-main-content flex-column bg-white-1'>
        <label class='input-label-1 label-4 semibold text-center mb-15'>Tambah Materi Menjurnal</label>
        <form class='form-1' method='POST' action='/post/materials'>
            @csrf
            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>File Name</label>
                <input class='input-1 mb-10' name='name' required placeholder='File Name'/>
            </div>

            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>File Date</label>
                <input class='input-1 mb-10' type='date' name='date' required placeholder='File Date'/>
            </div>

            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>File Upload</label>
                <input class='mb-10' name='file' type='file' required placeholder='File Upload'/>
            </div>

            @if($errors->any())
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

            <button class='btn btn-center label-2 bold shadow-1'>SUBMIT</button>
        </form>


    </div>
@endsection
