@extends('layouts.journal')

@section('layout-main-content')
    <div class='layout-main-content flex-column'>
        <div class='page-hero border-rounded-1 white-1'>
            <img class='ilus-home-1' src='/public/assets/images/ilus-home-1.png'/>
            <h1 class='page-hero-head-1 head-4 bold'>My Own Life Book Digital</h1>
        </div>
        <div class='journals-container'>
            <div class='journals-header flex-center-between'>
                <label class='label-2 semibold blue-3'>Daftar Jurnal</label>
                <a href='/create/journals'> <img class='filter-yellow-1' src='/public/library/iconsax/bold/add-square.svg' /> </a>
            </div>
            <ul class='journals-list flex-column'>
                @if(count($journals) !== 0)
                    @foreach( $journals as $journal)
                        <li class='material-container border-rounded-1 bg-white-1 shadow-1 flex-center'>
                            <a href='/edit/journals/{{ $journal->id }}' class='material-photo bg-light-blue-1 flex-center flex-justify-center border-rounded-1'>
                                <img src='/public/library/iconsax/bold/book-1.svg' class='svg-icon filter-blue-3'/>
                            </a>
                            <div style='flex:1;' class='material-info flex-center-between dark-blue-2'>
                                <div>
                                    <a href='/edit/journals/{{ $journal->id }}'><h2 class='para-3 dark-blue-2 semibold' >{{ $journal->title }}</h2></a>
                                    <p class='para-6'>{{ $journal->date }}</p>
                                </div>
                                <a href='javascript:confirmSwitchPage("/delete/journals/{{ $journal->id }}","Yakin ingin menghapus?")'><img src='/public/library/iconsax/bold/close-circle.svg' class='svg-icon filter-red-1' src='/delete/journals/{{$journal->id}}'/></a>
                            </div>
                        </li>
                    @endforeach
                    <label class='para-3 dark-blue-4 semibold flex-center' style='margin:0px auto; margin-top:10px;' >End Content</label>
                @else
                    <label class='input-label-1 bg-light-blue-1 label-4 semibold text-center mb-15'>Kosong</label>
                @endif
            </ul>
        </div>
    </div>
@endsection
