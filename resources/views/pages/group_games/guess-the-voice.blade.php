@extends('layouts.app')
@section('title', 'Guess The Voice')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content">

                <!-- ***** Featured Games Start ***** -->
                <div class="row">
                    <div class="col-lg-8">

                        <div class="heading-section text-center">
                            <h4> <em>Guess </em> The Voice</h4>
                        </div>

                        {{-- @if( count($jokes) > 0 )
                        @foreach( $jokes as $joke )

                        <div class="card card-body m-2 jcards">

                            <div class="text-white"> <audio style="width:234px" controls>
                                    <source src="{{ asset('audios/'.$joke->joke) }}" type="audio/mp3">
                                    Your browser does not support the audio tag.
                            </audio>
                            </div>
                            <p class="text-white">~ {{ $joke->user->name }}</p>
                            <div class="main-border-button1">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>

                        @endforeach
                        @endif --}}

                        <div class="nav1">
                            {{-- $jokes->appends(request()->query())->links('pagination::bootstrap-5') --}}
                        </div>


                    </div>

                    <!----Jokes Artist------->
                    <div class="col-lg-4">

                        <div class="top-streamers">
                            <div class="heading-section text-center">
                                <h4> <em>Score</em> Board</h4>
                            </div>
                            <ul class="spanel">

                                {{--@if( count($users) > 0 )
                                @foreach( $users as $k =>$user )

                                <li>
                                    <img src="{{ $user->avatar }}" alt="" style="max-width: 46px; border-radius: 50%; margin-right: 15px;">
                                    <h6><i class="fa fa-check"></i> {{ $user->name }} </h6>
                                    <div class="main-button">
                                        <a href="{{ route('jokes',['a'=>$user->id ]) }}">Browse</a>
                                    </div>
                                </li>
                                @endforeach
                                @endif--}}

                            </ul>
                        </div>

                


                    </div>


                </div>
                <!-- ***** Featured Games End ***** -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush