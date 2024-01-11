@extends('layouts.app')
@section('title', 'Home | Jokes')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <!-- ***** Banner Start ***** -->
        <div class="main-banner">
          <h3 class="mbh3">Welcome to SHOP N SAVE</h3>
          <div class="row">
            <div class="col-lg-7">
              <div class="header-text bantext">

                <h4><em>Browse</em> Our Popular Games Here</h4>
                <div class="main-button">
                  <a style="background-color:#418BE0" href="{{ url('/#games') }}">Browse Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Banner End ***** -->

        <!-- ***** Games Start ***** -->
        <div class="most-popular" id="games">
          <div class="row">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Interesting</em> Games </h4>
              </div>
              <div class="row">
                <!-------SOLO--------->
                <div class="col-lg-6 col-sm-6">
                  <div class="text-center item">
                    <h6 class="rclr">Solo</h6>
                  </div>
                  <div id="accordion">

                    @if( isset($localtrivia) )
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          {{ $localtrivia->name }}
                        </h5>
                      </div>
                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          {{ $localtrivia->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('game-trivia') }}">Play</a>
                        </div>
                      </div>
                    </div>
                    @endif


                    @if( isset($truefalse) )

                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          {{ $truefalse->name }}
                        </h5>
                      </div>
                      <div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          {{ $truefalse->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('game-true-false') }}">Play</a>
                        </div>
                      </div>
                    </div>

                    @endif

                    @if( isset($guessTheVoice) )

                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          {{ $guessTheVoice->name }}
                        </h5>
                      </div>
                      <div id="collapse3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        {{ $guessTheVoice->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('guess-the-voice') }}" >Play</a>
                        </div>
                      </div>
                    </div>

                    @endif

                    @if( isset($guessLocalCelebrity) )

                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          {{ $guessLocalCelebrity->name }}
                        </h5>
                      </div>
                      <div id="collapse4" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        {{ $guessLocalCelebrity->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('guess-local-celebrity')}}" >Play</a>
                        </div>
                      </div>
                    </div>

                    @endif

                  </div>
                </div>
               

                <!-------GROUP--------->
                <div class="col-lg-6 col-sm-6">
                  <div class="text-center item">
                    <h6 class="rclr">Group</h6>
                  </div>
                  <div id="accordion2">

                  @if(isset($groupGrogWheel) )
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          {{ $groupGrogWheel->name }}
                        </h5>
                      </div>
                      <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                         {{ $groupGrogWheel->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('group.grog-spin-the-wheel')}}">Play</a>
                        </div>
                      </div>
                    </div>
                  @endif

                    @if( isset($groupGuessLocation) )

                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          {{ $groupGuessLocation->name }}
                        </h5>
                      </div>
                      <div id="collapse6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          {{ $groupGuessLocation->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('group.guess-the-location') }}">Play</a>
                        </div>
                      </div>
                    </div>

                    @endif

                    @if( isset($groupGuessVoice) )

                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                         {{ $groupGuessVoice->name }}
                        </h5>
                      </div>
                      <div id="collapse7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          {{ $groupGuessVoice->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('group.guess-the-voice')}}">Play</a>
                        </div>
                      </div>
                    </div>
                  
                    @endif

                    @if( isset($groupGuessCelebrity) )

                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                         {{ $groupGuessCelebrity->name }}
                        </h5>
                      </div>
                      <div id="collapse8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                         {{ $groupGuessCelebrity->description }}
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('group.guess-local-celebrity')}}">Play</a>
                        </div>
                      </div>
                    </div>

                    @endif

                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          This or that
                        </h5>
                      </div>
                      <div id="collapse9" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          start a game to be presented with two options for various categories. Quickly tap your preferred choice between the two within a set time limit.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('group.this-or-that')}}">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Do or Drink
                        </h5>
                      </div>
                      <div id="collapse10" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          gather around with friends, each taking turns to press the "Spin" button. Complete the challenge or dare displayed, or opt to take a sip of your drink as a forfeit. Keep playing in rounds, aiming for laughs and memorable moments while adhering to responsible drinking guidelines.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg" href="{{ route('group.do-or-drink')}}">Play</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Games End ***** -->


        <!-- ***** Most Popular Start ***** -->

        <div class="most-popular">
          <div class="row">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Popular</em> Jokes Categories</h4>
              </div>
              <div class="row">

                @if( count($jokes_category) > 0 )
                @foreach( $jokes_category as $jc )

                <div class="col-lg-3 col-sm-6 jokeCat">
                  <a href="{{ route('jokes',['c'=>$jc->id]) }}">
                    <div class="item" style="text-align:center">

                      <h4>{{ $jc->category }}</h4>

                    </div>
                  </a>
                </div>


                @endforeach
                @endif

              </div>
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="{{ route('jokes') }}">Browse More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ***** Most Popular End ***** -->

      </div>
    </div>
  </div>
</div>
</div>

@endsection