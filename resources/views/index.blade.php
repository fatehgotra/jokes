@extends('layouts.app')
@section('title', 'Home | Jokes')
@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/spin.css') }}">
<div class="container text-center mb-5 mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="title_spin zoom-in-zoom-out">Spin wheel to read jokes</h2>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col-md-12 text-center">
            <div class="wheel-spin-box">
                <div id="spinwheel">
                    <div class="wheeldotsround">
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                        <div class="wheeldots"></div>
                    </div>
                </div>
                <div id="spin-arrow" class="wheel-spin-arrow">
                    <svg width="83" height="74" viewBox="0 0 83 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.9489 5.12466C33.8289 3.59888 35.0943 2.3319 36.618 1.45104C38.1417 0.570174 39.8701 0.106445 41.6294 0.106445C43.3888 0.106445 45.1171 0.570174 46.6409 1.45104C48.1646 2.3319 49.43 3.59888 50.31 5.12466L80.9178 58.1922C81.7993 59.7185 82.264 61.4504 82.265 63.2137C82.2659 64.9769 81.8032 66.7094 80.9234 68.2366C80.0435 69.7639 78.7776 71.0322 77.2529 71.9139C75.7282 72.7955 73.9986 73.2595 72.238 73.2591H11.0223C9.26269 73.259 7.53405 72.7951 6.01016 71.9139C4.48627 71.0327 3.22083 69.7653 2.34102 68.2391C1.46121 66.7128 0.998036 64.9815 0.998047 63.2192C0.998058 61.4569 1.46125 59.7256 2.34108 58.1994L32.9489 5.12466Z" fill="#2F911E" />
                    </svg>
                </div>
            </div>

        </div>
        <div class="col-md-12 text-center mb-4">
            <button id="spin" class="spin-click-button zoom-in-zoom-out">Spin the Wheel</button>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 text-left mt-2">
            <a href="{{ url('user/login') }}" class="rainbow-btn"><span>Login</span></a>
        </div>

        <div class="col-md-4 text-center mt-2">
            <a href="{{ url('games') }}" class="rainbow-btn"><span>More Games</span></a>
        </div>

        <div class="col-md-4 text-right mt-2">
            <a href="{{ url('user/signup') }}" class="rainbow-btn"><span>Signup</span></a>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content" style="text-align:center;font-size:23px">
            <div class="modal-body">
              
            </div>
            <div class="text-right m-1">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: url('{{ asset("/assets/bg.jpg")}}') no-repeat;
        background-size: cover;
      
    }
</style>
<div>
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