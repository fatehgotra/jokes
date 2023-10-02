@extends('layouts.app')
@section('title', 'Home | Jokes')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <!-- ***** Banner Start ***** -->
        <div class="main-banner">
          <div class="row">
            <div class="col-lg-7">
              <div class="header-text">
                <h6>Welcome To SHOP N SAVE</h6>
                <h4><em>Browse</em> Our Popular Games Here</h4>
                <div class="main-button">
                  <a href="{{ url('/#games') }}">Browse Now</a>
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
                <h4><em>Intresting</em> Games </h4>
              </div>
              <div class="row">
                <!-------SOLO--------->
                <div class="col-lg-6 col-sm-6">
                  <div class="text-center item">
                    <h6 class="rclr">Solo</h6>
                  </div>
                  <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Local Trivia Questions
                        </h5>
                      </div>
                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          select your location to get community-specific questions. Choose from categories like "Famous Landmarks" or "Local Celebrities" and answer multiple-choice questions within a time limit. Use lifelines like "50/50" for help and compete for the top spot on the local leaderboard.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          True or False
                        </h5>
                      </div>
                      <div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          start the game to receive statements related to various topics. Swipe right for "True" and left for "False" within a set time limit for each statement. Use lifelines like "Skip" or "50/50" when stuck, and aim for a high score.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Guess The Voice
                        </h5>
                      </div>
                      <div id="collapse3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          Listen to short audio snippets and choose who you think the voice belongs to from multiple-choice options. Use lifelines like "Replay Voice" or "50/50" for help, and aim to top the local leaderboard. Whether it's local celebrities, politicians, famous local sports stars, influencers etc
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Guess the local celebrity
                        </h5>
                      </div>
                      <div id="collapse4" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          "Guess the Local Celebrity" is a fun and interactive mobile game that tests your knowledge of famous faces in your community. Identify the blurred or pixelated faces from multiple-choice options within a time limit. Use lifelines like "Hint" or "50/50" when stuck, and compete for the top spot on the local leaderboard.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-------GROUP--------->
                <div class="col-lg-6 col-sm-6">
                  <div class="text-center item">
                    <h6 class="rclr">Group</h6>
                  </div>
                  <div id="accordion2">
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Grog spin the wheel
                        </h5>
                      </div>
                      <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          tap the screen to spin a virtual wheel filled with various prizes or challenges. Wait for the wheel to stop to see what you've won or must do during your grog session. Accumulate points or rewards based on the wheel's outcome, aiming for high scores or rare prizes.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Guess the location
                        </h5>
                      </div>
                      <div id="collapse6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          view the displayed image of a place. Choose the correct location from multiple-choice options within a time limit.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Guess the voice
                        </h5>
                      </div>
                      <div id="collapse7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          Listen to short audio snippets and choose who you think the voice belongs to from multiple-choice options. Use lifelines like "Replay Voice" or "50/50" for help, and aim to top the local leaderboard. Whether it's local celebrities, politicians, famous local sports stars, influencers etc.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 text-center" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                          <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                          Guess the local celebrity
                        </h5>
                      </div>
                      <div id="collapse8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion2">
                        <div class="card-body">
                          "Guess the Local Celebrity" is a fun and interactive mobile game that tests your knowledge of famous faces in your community. Identify the blurred or pixelated faces from multiple-choice options within a time limit. Use lifelines like "Hint" or "50/50" when stuck, and compete for the top spot on the local leaderboard.
                        </div>
                        <div class="text-center mb-1">
                          <a class="btn btn-success lbg">Play</a>
                        </div>
                      </div>
                    </div>
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
                          <a class="btn btn-success lbg">Play</a>
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
                          <a class="btn btn-success lbg">Play</a>
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

                <div class="col-lg-3 col-sm-6">
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


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script>
  // -----wheel-spin-js------
  var padding = {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
    w = 400 - padding.left - padding.right,
    h = 400 - padding.top - padding.bottom,
    r = Math.min(w, h) / 2,
    rotation = 0,
    oldrotation = 0,
    picked = 100000,
    oldpick = [],
    color = d3.scale.category20(); //category20c()
  //randomNumbers = getRandomNumbers();

  // var data = [{
  //         "label": "0x",
  //         "value": 1,
  //         "xp": "you Lost 0x"
  //     },
  //     {
  //         "label": "2x",
  //         "value": 1,
  //         "xp": "you Win 2x"
  //     },
  //     {
  //         "label": "0x",
  //         "value": 1,
  //         "xp": "you Lost 0x"
  //     },
  //     {
  //         "label": "2x",
  //         "value": 1,
  //         "xp": "you Win 2x"
  //     },
  //     {
  //         "label": "0x",
  //         "value": 1,
  //         "xp": "you Lost 0x"
  //     },
  //     {
  //         "label": "2x",
  //         "value": 1,
  //         "xp": "you Win 2x"
  //     }
  // ];

  var data = @json($jokes);

  var svg = d3.select('#spinwheel')
    .append("svg")
    .data([data])
    .attr("xmlns", "http://www.w3.org/2000/svg")
    .attr('viewBox', '0 0 ' + w + ' ' + w + '')
    .attr("width", w)
    .attr("height", h + padding.top + padding.bottom);
  var container = svg.append("g")
    .attr("class", "chartholder")
    .attr("transform", "translate(" + (w / 2 + padding.left) + "," + (h / 2 + padding.top) + ")");
  var vis = container.append("g");

  var pie = d3.layout.pie().sort(null).value(function(d) {
    return 1;
  });
  // declare an arc generator function
  var arc = d3.svg.arc().outerRadius(r);
  // select paths, use arc generator to draw
  var arcs = vis.selectAll("g.slice")
    .data(pie)
    .enter()
    .append("g")
    .attr("class", "slice");

  arcs.append("path")
    .attr("fill", function(d, i) {
      return color(i);
    })
    .attr("d", function(d) {
      return arc(d);
    });
  // add the text
  arcs.append("text").attr("transform", function(d) {
      d.innerRadius = 0;
      d.outerRadius = r;
      d.angle = (d.startAngle + d.endAngle) / 2;
      return "rotate(" + (d.angle * 180 / Math.PI - 90) + ")translate(" + (d.outerRadius - 60) + ")";
    }).attr('font-size', '20').attr('fill', '#ffffff')
    .attr("text-anchor", "end")
    .text(function(d, i) {
      return data[i].label;
    });
  $('#spin').on("click", spin);

  function spin(d) {

    $('#spin').on("click", null);
    //all slices have been seen, all done
    //console.log("OldPick: " + oldpick.length, "Data length: " + data.length);
    if (oldpick.length == data.length) {
      console.log("done");
      $('#spin').on("click", null);
      return;
    }
    var ps = 360 / data.length,
      pieslice = Math.round(1440 / data.length),
      rng = Math.floor((Math.random() * 1440) + 360);

    rotation = (Math.round(rng / ps) * ps);
    //console.log(rotation);

    picked = Math.round(data.length - (rotation % 360) / ps) + 2;

    picked = picked >= data.length ? (picked % data.length) : picked;
    if (oldpick.indexOf(picked) !== -1) {
      d3.select(this).call(spin);
      return;
    } else {
      oldpick.push(picked);
    }
    rotation += 90 - Math.round(ps / 1);
    var interval = setInterval(function() {
      $('.wheeldots').addClass('active-dots');
      setTimeout(function() {
        $('.wheeldots').removeClass('active-dots');
      }, 100);
    });
    vis.transition()
      .duration(3000)
      .attrTween("transform", rotTween)
      .each("end", function() {
        clearInterval(interval);
        //mark question as seen
        d3.select(".slice:nth-child(" + (picked + 1) + ") path")
        //populate question
        d3.select("#question h1").text(data[picked].question);
        oldrotation = rotation;
        $('#exampleModal').find('.modal-body').html(data[picked].value);
        $('#exampleModal').modal('show');
        //alert(data[picked].xp);

        //container.on("click", spin);
      });
  }
  //make arrow
  // svg.append("g")
  //     .attr("transform", "translate(" + (w + padding.left + padding.right) + "," + ((h/2)+padding.top) + ")")
  //     .append("path")
  //     .attr("d", "M-" + (r*.15) + ",0L0," + (r*.05) + "L0,-" + (r*.05) + "Z")
  //     .style({"fill":"black"});
  //draw spin circle
  container.append("circle")
    .attr("cx", 0)
    .attr("cy", 0)
    .attr("r", 30)
    .style({
      "fill": "#ffffff"
    });
  //spin text
  // container.append("text")
  //     .attr("x", 0)
  //     .attr("y", 15)
  //     .attr("text-anchor", "middle")
  //     .text("SPIN")
  //     .style({"font-weight":"bold", "font-size":"30px"});


  function rotTween(to) {
    var i = d3.interpolate(oldrotation % 360, rotation);
    return function(t) {
      return "rotate(" + i(t) + ")";
    };
  }


  function getRandomNumbers() {
    var array = new Uint16Array(1000);
    var scale = d3.scale.linear().range([360, 1440]).domain([0, 100000]);
    if (window.hasOwnProperty("crypto") && typeof window.crypto.getRandomValues === "function") {
      window.crypto.getRandomValues(array);
      console.log("works");
    } else {
      //no support for crypto, get crappy random numbers
      for (var i = 0; i < 1000; i++) {
        array[i] = Math.floor(Math.random() * 100000) + 1;
      }
    }
    return array;
  }
</script>
@endpush