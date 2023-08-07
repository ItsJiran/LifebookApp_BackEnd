@extends('layouts.journal_editor')

@section('title','Add Journal')

@section('layout-main-header-left')
    <a href='javascript:confirmSwitchPage("/journal")'><img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/back-square.svg'/></a>
@endsection

@section('layout-main-header-right')
    <a href='javascript:createJournal()'><img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/add-circle.svg'/></a>
@endsection

@section('layout-main-content')
    <div class='layout-main-content flex-column bg-white-1'>
        <div class='form-1'>
            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>Title</label>
                <input id='input-journal-title' class='input-1 mb-10' name='title' value='{{old("title")}}' required placeholder='Journal Title'/>
            </div>

            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>Date</label>
                <input id='input-journal-date' class='input-1 mb-10' type='date' value='{{old("date")}}' name='date' required placeholder='Journal Date'/>
            </div>

            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>Time</label>
                <input id='input-journal-time' class='input-1 mb-10' type='time' value='{{old("time")}}' name='time' required placeholder='Journal Date'/>
            </div>

            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>Note</label>
                <div id='journal-editor' class='journal-editor'></div>
            </div>

            @if($errors->any())
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

            <button class='btn btn-center label-2 bold shadow-1' style='display:hidden;visibility:collapse;'>SUBMIT</button>
        </div>
    </div>
@endsection
