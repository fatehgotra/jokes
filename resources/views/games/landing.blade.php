@extends('layouts.app')
@section('title', 'Games')
@section('content')
<link rel="stylesheet" href="{{ asset('/assets/css/spin.css') }}">

<div class="container">

    <div class="row" style="margin: 1%;">
        <button class="float-right bkbtn" onclick="{window.location.href='{{url('/')}}'}"> Back </button>
    </div>

    <div class="row">
        <h1 class="col-md-12 shake text-center text-white gtitle"> Play Games </h1>
    </div>


    <div class="row">
        <div class="col-md-4 text-left mt-2">
            <a href="{{url('breakout')}}" class="rainbow-btn"><span>Breakout</span></a>
        </div>

        <div class="col-md-4 text-center mt-2">
            <a href="{{ url('matching') }}" class="rainbow-btn"><span>Matching</span></a>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4 text-left mt-2">
            <a href="{{ url('tic-tac-toe') }}" class="rainbow-btn"><span>Tick Tac Toe</span></a>
        </div>

        <div class="col-md-4 text-center mt-2">
            <a href="{{ url('planet-defence') }}" class="rainbow-btn"><span>PlanetDefence</span></a>

        </div>

    </div>

    <div class="row">

        <div class="col-md-6 text-center" style="margin-left:8%">
            <a href="{{ url('rock-paper-scissor') }}" class="rainbow-btn"><span>Rock Paper Scissor</span></a>
        </div>

    </div>

</div>

<style>
    body {
        background: url('../public/assets/bg.jpg');
        height: 100vh;
    }

    .container {
        position: relative;
        /* top: 20%; */
        left: 12%;
        margin-right: 0 !important;
    }

    .gtitle {
        right: 16%;
    }

    @media (max-width: 479.98px) {
        .container {
            left: 0% !important;
        }

        .gtitle {
            right: 0% !important;
        }

        .row {
            margin-right: 11px !important;
            margin-left: 3px !important;
        }
    }
</style>