@extends('layouts.journal')

@section('layout-main-header')
    <div class='layout-main-header flex-center-between semibold'>
        <div class=''>@yield('layout-main-header-left')</div>
        <div class='page-info center flex-center'>
            <img class='svg-icon filter-blue-2' src='/public/library/iconsax/bold/book.svg' />
            <label class='blue-2'>Journal</label>
        </div>
        <div class=''>@yield('layout-main-header-right')</div>
    </div>
@endsection

@section('head-content')
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/editors@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/image@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/header@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/link@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/list@latest'></script>
    <script src='https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest'></script>
@endsection

@section('footer-script-content')
   <script src='/public/assets/js/script.editor.js'></script>
@endsection

