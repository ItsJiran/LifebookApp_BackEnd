@extends('layouts.journal_editor')

@section('journal-data')
    <meta id='journal-id' name='journal-id' content='{{ $journal->id }}'/>
    <meta id='journal-user-id' name='journal-user-id' content='{{ $journal->user_id }}'/>
    <meta id='journal-data' name='journal-data' content='{{ $journal->data }}'/>
@endsection

@section('layout-main-header-left')
    <a href='javascript:confirmSwitchPage("/journal")'><img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/back-square.svg'/></a>
@endsection

@section('layout-main-header-right')
    <a href='javascript:saveJournal()'><img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/tick-circle.svg'/></a>
@endsection

@section('layout-main-content')
    <div class='layout-main-content flex-column bg-white-1'>
        <div class='form-1'>
            <div class='input-container'>
                <label class='input-label-2 label-5 medium mb-5'>Title</label>
                <h1 id='input-journal-title' class='head-3 dark-blue-1 mb-10'/>
                    {{$journal->title}}
                </h1>
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
