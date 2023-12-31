@extends('layouts.app')
@section('title', 'Matching')
@section('content')
<link rel="stylesheet" href="{{asset('assets_admin/css/matching.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">

    <section class="score-panel">

        <ul class="stars">
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
            <li><i class="fa fa-star"></i></li>
        </ul>

        <span class="moves gtitle">0</span> Moves
        <span><time id="timer" class="gtitle">00Mins:00Secs</time></span>
        <div class="restart">
            <i class="fa fa-repeat"></i>
        </div>
        <div class="text-center">
            <button class="bkbtn" onclick="{window.location.href='{{url('games')}}'}">Back</button>
        </div>

    </section>

    <ul class="deck"></ul>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLongTitle">Congratulations!!🎉🎇🎊</h5>
                </div>
                <div class="modal-body text-dark">
                    <span class="moves">0</span> Moves
                    <ul class="stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary reset" data-dismiss="modal">Play Again</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        background: url('{{ asset("/assets_admin/bg.jpg")}}') no-repeat;
        height: 100vh!important;
      
    }
</style>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script>
    // Create a list that holds all of your cards

    let cards = [
        "fa fa-paper-plane-o",
        "fa fa-anchor",
        "fa fa-leaf",
        "fa fa-bicycle",
        "fa fa-diamond",
        "fa fa-bomb",
        "fa fa-bolt",
        "fa fa-cube"
    ];

    cards = cards.concat(cards);

    //creating an array to check the opneing of cards
    let opened = [];

    let counter = 0;

    let moves = 0;

    let stars = document.getElementsByClassName("fa fa-star");
    console.log(stars);
    let rating = 3;

    let shuffledCards;

    let hasTheTimerStarted = false;
    /*
     * Display the cards on the page
     *   - shuffle the list of cards using the provided "shuffle" method below
     *   - loop through each card and create its HTML
     *   - add each card's HTML to the page
     */

    // Shuffle function from http://stackoverflow.com/a/2450976
    function shuffle(array) {
        var currentIndex = array.length,
            temporaryValue,
            randomIndex;

        while (currentIndex !== 0) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex -= 1;
            temporaryValue = array[currentIndex];
            array[currentIndex] = array[randomIndex];
            array[randomIndex] = temporaryValue;
        }

        return array;
    }

    // Creation of cards dyanamically
    function createCards() {

        //Storing the function in a var
        let shuffledCards = shuffle(cards);

        /*Accessing each card using for each loop $ item is the array element i.e its the classname*/
        shuffledCards.forEach(function(item) {

            /*Here we are creating li element and appending it to the ul and assiging the card name as a class name to the icon tag*/
            $("ul.deck").append(`<li class='card'><i class="${item}"></i></li>`);
        });
    }

    //Calling creating cards fuction will create cards dyanamically
    createCards();

    //Selecting every ele with card class nd binding a click event to each card
    $(".card").click(function() {

        //Selcting current ele being clicked
        openCards($(this));
        console.log(this);
    });

    // Creating a function to open cards
    function openCards(card) {

        /*checking if any card is opened or not if nothing is opened*/
        if (opened.length === 0) {

            //push a card into array
            opened.push(card);

            //open the card
            card.toggleClass("open show animated headShake");

            //Calling timer
            if (!hasTheTimerStarted) {
                timer();
                hasTheTimerStarted = true;
            }
        }
        //if one card has already been pushed
        else if (opened.length === 1 && opened[0][0] !== card[0]) {

            //push that card in array
            opened.push(card);

            //open that card
            card.toggleClass("open show animated headShake");





            //a card will open
            timeOut = setTimeout(checkMatch, 500);
        }
    }

    /*creating a function to check whether the cards matched or not
    when we have two opened cards in an array
    */
    function checkMatch() {
        //an array to keep the track of opened cards
        let open = opened;

        open[0].toggleClass("disable");
        moveCounter();

        /*will check the matching of cards using same class name
        open[0][0]means first opned card at index 0
        open[1][0]means second opned card at index 0 
        we are seleting classname of icon tag
        */
        if (
            open[0][0].firstChild.className === open[1][0].firstChild.className &&
            open[0][0] !== open[1][0]
        ) {
            //matching cards
            open[0].toggleClass("match tada");
            open[1].toggleClass("match tada");

            //to stop click event on the opened cards
            open[0].css("pointer-events", "none");
            open[1].css("pointer-events", "none");

            //clear the array for next two cards
            opened = [];
            timeOut2 = setTimeout(matchCounter, 1000);
        } else if (opened.length === 1 && opened[0][0] !== card[0]) {
            opened.toggleClass("disable");
        } else {
            open[0].toggleClass("notMatch");
            open[1].toggleClass("notMatch");
            opened = [];
            setTimeout(function() {
                open[0].toggleClass("open show animated notMatch headShake");
                open[1].toggleClass("open show animated notMatch headShake");
            }, 300);
        }
    }

    /*creating a counter to check all for all the opened cards
    if all the 8 pair matches then create an alert  
    */
    function matchCounter() {
        counter++;
        if (counter === 8) {
            shouldTimerTick = false;
            openWinModal();
        }
    }

    //counting the no of moves
    function moveCounter() {
        moves++;

        //accessing moves from span ele n changing the content means counting the moves
        $(".moves").html(moves);
        checkStars();
    }

    function checkStars() {
        if (moves > 10 && moves < 19) {
            stars[2].style.display = "none";
            rating = 2;
        } else if (moves >= 20) {
            stars[1].style.display = "none";
            rating = 1;
        }
    }



    function openWinModal() {
        const move = document.querySelector(".moves").innerText;


        if (move > 10 && move < 19) {
            stars[2].style.display = "none";
            rating = 2;
        } else if (moves >= 20) {
            stars[1].style.display = "none";
            rating = 1;
        }
        const times = document.querySelector("#timer").innerText;
        $(".modal-body").html(
            `You completed the game in ${times} . <br></br> You used ${move} moves. <br></br> You get ${rating} stars.`
        );

        document.querySelector(".reset").addEventListener("click", reset);
        $("#myModal").modal("show");
    }

    function reset() {
        $(".deck").html("");
        opened = [];
        counter = 0;
        moves = -1;
        rating = 3;
        moveCounter();
        shuffledCards = [];
        createCards();
        hasTheTimerStarted = false;
        shouldTimerTick = false;
        t.textContent = "00Mins:00Secs";
        seconds = 0;
        minutes = 0;
        $(".card").click(function() {
            openCards($(this));
        });
        stars[1].style.display = "block";
        stars[2].style.display = "block";
        $("#myModal").css("display", "none");
    }

    $(".restart").click(function() {
        reset();
    });

    //Timer
    let shouldTimerTick;
    let t = document.getElementById("timer"),
        seconds = 0,
        minutes = 0;

    function timer() {
        let time;
        shouldTimerTick = true;

        time = setInterval(function() {
            if (shouldTimerTick) {
                (function add() {
                    seconds++;
                    if (seconds >= 60) {
                        seconds = 0;
                        minutes++;
                    }

                    t.textContent =
                        (minutes ?
                            minutes > 9 ? minutes + "Mins" : "0" + minutes + "Mins" :
                            "00Mins") +
                        ":" +
                        (seconds > 9 ? seconds + "Secs" : "0" + seconds + "Secs");
                })();
            } else {
                clearInterval(time);
            }
        }, 1000);
    }
</script>
@endpush