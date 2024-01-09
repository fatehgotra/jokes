@extends('layouts.app')
@section('title', 'Game Area')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="page-content">


                <div class="row">
                    <div class="col-lg-12">

                        <div class="heading-section text-center">
                            <h4> {{ ' Guess The Voice '}} </h4>
                        </div>


                        <!-- start Quiz button -->
                        <div class="start_btn text-center"><button>Start Game</button></div>

                        <!--Leader board start---->

                        @if( count($leaders) > 0)
                        <div class="gaming-library">
                            <div class="col-lg-12">
                                <div class="heading-section text-center">
                                    <h4><em>Top</em> Leaders</h4>
                                </div>

                                @foreach( $leaders as $l)
                                <div class="item">
                                    <ul>
                                        <li><img src="{{ !is_null($l->user->avatar) ? asset('storage/uploads/user/'.$l->user->avatar) :  asset('assets/images/leader_placeholder.jpg') }}" alt="" class="templatemo-item"></li>
                                        <li>
                                            <span>{{ $l->user->name }}</span>
                                        </li>
                                        <li>
                                            <h4>Date</h4><span>{{ \Carbon\Carbon::parse($l->created_at)->format('d,m,Y') }}</span>
                                        </li>
                                        <li>
                                            <h4>Score</h4><span>{{ $l->score }}</span>
                                        </li>
                                     
                                      
                                    </ul>
                                </div>
                                @endforeach

                            </div>
                         
                        </div>
                        @endif

                        <!---Leader Board end---->

                        <!-- Info Box -->
                        <div class="info_box">
                            <div class="info-title"><span>Some Rules of this game</span></div>
                            <div class="info-list">
                                <div class="info"> {!! $localtrivia->rules !!}</div>
                                <!-- <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
                                <div class="info">2. Once you select your answer, it can't be undone.</div>
                                <div class="info">3. You can't select any option once time goes off.</div>
                                <div class="info">4. You can't exit from the game while you're playing.</div>
                                <div class="info">5. You'll get points on the basis of your correct answers.</div> -->
                            </div>
                            <div class="buttons">
                                <button class="quit">Exit Game</button>
                                <button class="restart">Continue</button>
                            </div>
                        </div>

                        <!-- Quiz Box -->
                        <div class="quiz_box">
                            <header>
                                @if( $localtrivia->lifeline != 0 )
                                <div class="title">
                                    <button class="btn btn-info btn50"> </button>
                                </div>
                                @endif
                                <div class="timer">
                                    <div class="time_left_txt">Time Left</div>
                                    <div class="timer_sec"> {{ $localtrivia->ques_time_limit }}</div>
                                </div>
                                <div class="time_line"></div>
                            </header>
                            <section>

                                <div class="que_text">

                                </div>
                                <div class="ques_img">

                                </div>
                                <div class="option_list">

                                </div>

                                <div class="total_que">

                                </div>
                            </section>


                            <footer class="text-center">

                                <button class="next_btn">Next Que</button>
                            </footer>
                        </div>

                        <!-- Result Box -->
                        <div class="result_box">
                            <div class="icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="complete_text">You've finished the game!</div>
                            <div class="score_text">

                            </div>
                            <div class="buttons">
                                <button class="restart">Replay Game</button>
                                <button class="quit">Quit Game</button>
                            </div>
                            <button  class="submitleader p-2 btn btn-success" onclick="event.preventDefault(); document.getElementById('enlead').submit();" >Submit score for leader board</button>
                            <form id="enlead" action="{{ route('enable-leader') }}" method="POST">
                                @csrf
                                <input type="hidden" name="game" value="local-trivia">
                                <input type="hidden" name="score" id="iscore" value="">
                            </form>
                        </div>


                    </div>


                </div>




            </div>

        </div>
    </div>
</div>
</div>


<style>
    /* importing google fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    ::selection {
        color: #fff;
        background: #007bff;
    }


    .start_btn1,
    .info_box,
    .quiz_box,
    .result_box {
        position: absolute;
        top: 56%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
            0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .info p {
        color: black;
    }

    .total_que p,
    .score_text p {
        color: black;
    }

    .info_box.activeInfo,
    .quiz_box.activeQuiz,
    .result_box.activeResult {
        opacity: 1;
        z-index: 5;
        pointer-events: auto;
        /* transform: translate(-50%, -50%) scale(1.1); */
    }

    .info_box.activeInfo {
        transform: translate(-50%, -50%) scale(1.2);
    }

    .start_btn button {
        font-size: 25px;
        font-weight: 500;
        color: #007bff;
        padding: 15px 30px;
        outline: none;
        border: none;
        border-radius: 5px;
        background: #fff;
        cursor: pointer;
    }

    .info_box {
        width: 540px;
        background: #fff;
        border-radius: 5px;
        transform: translate(-50%, -50%) scale(0.9);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .info_box .info-title {
        height: 60px;
        width: 100%;
        border-bottom: 1px solid lightgrey;
        display: flex;
        align-items: center;
        padding: 0 30px;
        border-radius: 5px 5px 0 0;
        font-size: 20px;
        font-weight: 600;
    }

    .info_box .info-list {
        padding: 15px 30px;
    }

    .info_box .info-list .info {
        margin: 5px 0;
        font-size: 17px;
    }

    .info_box .info-list .info span {
        font-weight: 600;
        color: #007bff;
    }

    .info_box .buttons {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 30px;
        border-top: 1px solid lightgrey;
    }

    .info_box .buttons button {
        margin: 0 5px;
        height: 40px;
        width: 100px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        outline: none;
        border-radius: 5px;
        border: 1px solid #007bff;
        transition: all 0.3s ease;
    }

    .quiz_box {
        width: 550px;
        background: #fff;
        border-radius: 5px;
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .quiz_box header {
        position: relative;
        z-index: 2;
        height: 70px;
        padding: 0 30px;
        background: #fff;
        border-radius: 5px 5px 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0px 3px 5px 1px rgba(0, 0, 0, 0.1);
    }

    .quiz_box header .title {
        font-size: 20px;
        font-weight: 600;
    }

    .quiz_box header .timer {
        color: #004085;
        background: #cce5ff;
        border: 1px solid #b8daff;
        height: 45px;
        padding: 0 8px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 145px;
    }

    .quiz_box header .timer .time_left_txt {
        font-weight: 400;
        font-size: 17px;
        user-select: none;
    }

    .quiz_box header .timer .timer_sec {
        font-size: 18px;
        font-weight: 500;
        height: 30px;
        width: 45px;
        color: #fff;
        border-radius: 5px;
        line-height: 30px;
        text-align: center;
        background: #343a40;
        border: 1px solid #343a40;
        user-select: none;
    }

    .quiz_box header .time_line {
        position: absolute;
        bottom: 0px;
        left: 0px;
        height: 3px;
        background: #007bff;
    }

    section {
        padding: 25px 30px 20px 30px;
        background: #fff;
    }

    section .que_text {
        font-size: 25px;
        font-weight: 600;
    }

    section .option_list {
        padding: 20px 0px;
        display: block;
    }

    section .option_list .option {
        background: aliceblue;
        border: 1px solid #84c5fe;
        border-radius: 5px;
        padding: 8px 15px;
        font-size: 17px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    section .option_list .option:last-child {
        margin-bottom: 0px;
    }

    section .option_list .option:hover {
        color: #004085;
        background: #cce5ff;
        border: 1px solid #b8daff;
    }

    section .option_list .option.correct {
        color: #155724;
        background: #d4edda;
        border: 1px solid #c3e6cb;
    }

    section .option_list .option.incorrect {
        color: #721c24;
        background: #f8d7da;
        border: 1px solid #f5c6cb;
    }

    section .option_list .option.disabled {
        pointer-events: none;
    }

    section .option_list .option .icon {
        height: 26px;
        width: 26px;
        border: 2px solid transparent;
        border-radius: 50%;
        text-align: center;
        font-size: 13px;
        pointer-events: none;
        transition: all 0.3s ease;
        line-height: 24px;
    }

    .option_list .option .icon.tick {
        color: #23903c;
        border-color: #23903c;
        background: #d4edda;
    }

    .option_list .option .icon.cross {
        color: #a42834;
        background: #f8d7da;
        border-color: #a42834;
    }

    footer {
        height: 60px;
        padding: 0 30px;
        /* display: flex; */
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid lightgrey;
    }

    .total_que span {
        display: flex;
        user-select: none;
    }

    .total_que span p {
        font-weight: 500;
        padding: 0 5px;
    }

    .total_que span p:first-child {
        padding-left: 0px;
    }

    footer button {
        height: 40px;
        padding: 0 13px;
        font-size: 18px;
        font-weight: 400;
        cursor: pointer;
        margin: 2%;
        border: none;
        outline: none;
        color: #fff;
        border-radius: 5px;
        background: #007bff;
        border: 1px solid #007bff;
        line-height: 10px;
        opacity: 0;
        pointer-events: none;
        transform: scale(0.95);
        transition: all 0.3s ease;
    }

    footer button:hover {
        background: #0263ca;
    }

    footer button.show {
        opacity: 1;
        pointer-events: auto;
        transform: scale(1);
    }

    .result_box {
        background: #fff;
        border-radius: 5px;
        display: flex;
        padding: 25px 30px;
        width: 450px;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        transform: translate(-50%, -50%) scale(0.9);
        opacity: 0;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .result_box .icon {
        font-size: 100px;
        color: #007bff;
        margin-bottom: 10px;
    }

    .result_box .complete_text {
        font-size: 20px;
        font-weight: 500;
    }

    .result_box .score_text span {
        display: flex;
        margin: 10px 0;
        font-size: 18px;
        font-weight: 500;
    }

    .result_box .score_text span p {
        padding: 0 4px;
        font-weight: 600;
    }

    .result_box .buttons {
        display: flex;
        margin: 20px 0;
    }

    .result_box .buttons button {
        margin: 0 10px;
        height: 45px;
        padding: 0 20px;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        outline: none;
        border-radius: 5px;
        border: 1px solid #007bff;
        transition: all 0.3s ease;
    }

    .buttons button.restart {
        color: #fff;
        background: #007bff;
    }

    .buttons button.restart:hover {
        background: #0263ca;
    }

    .buttons button.quit {
        color: #007bff;
        background: #fff;
    }

    .buttons button.quit:hover {
        color: #fff;
        background: #007bff;
    }

    .quiz_box section {
        margin-top: 0;
    }

    .gaming-library {
        background-color: #ffffff2b;
    }



    @media (max-width: 600px) {

        .activeQuiz button {
            font-size: 10px !important;
            margin: 1%;
        }

        .quiz_box,
        .info_box {
            width: 80%;
        }

        .start_btn1,
        .info_box,
        .quiz_box,
        .result_box {
            top: 60% !important;
        }

        .info_box.activeInfo,
        .quiz_box.activeQuiz,
        .result_box.activeResult {

            transform: translate(-50%, -50%) scale(1.2);
        }
    }
</style>


@endsection

@push('scripts')
<script>
    let questions = @json($questions);

    //selecting all required elements
    const start_btn = document.querySelector(".start_btn button");
    const info_box = document.querySelector(".info_box");
    const exit_btn = info_box.querySelector(".buttons .quit");
    const continue_btn = info_box.querySelector(".buttons .restart");
    const quiz_box = document.querySelector(".quiz_box");
    const result_box = document.querySelector(".result_box");
    const option_list = document.querySelector(".option_list");
    const time_line = document.querySelector("header .time_line");
    const timeText = document.querySelector(".timer .time_left_txt");
    const timeCount = document.querySelector(".timer .timer_sec");
    const btn50 = document.querySelector('.btn50');
    // if startQuiz button clicked
    start_btn.onclick = () => {
        info_box.classList.add("activeInfo"); //show info box
    }

    // if exitQuiz button clicked
    exit_btn.onclick = () => {
        info_box.classList.remove("activeInfo"); //hide info box
    }



    let timeValue = '{{ $localtrivia->ques_time_limit }}';
    let lifelineNo = '{{ $localtrivia->lifeline }}';
    let que_count = 0;
    let que_numb = 1;
    let userScore = 0;
    let counter;
    let counterLine;
    let widthValue = 0;

    // if continueQuiz button clicked
    continue_btn.onclick = () => {
        info_box.classList.remove("activeInfo"); //hide info box
        quiz_box.classList.add("activeQuiz"); //show quiz box
        showQuetions(0); //calling showQestions function
        queCounter(1); //passing 1 parameter to queCounter
        startTimer(timeValue); //calling startTimer function
        startTimerLine(0); //calling startTimerLine function
    }

    const restart_quiz = result_box.querySelector(".buttons .restart");
    const quit_quiz = result_box.querySelector(".buttons .quit");

    // if restartQuiz button clicked
    restart_quiz.onclick = () => {
        quiz_box.classList.add("activeQuiz"); //show quiz box
        result_box.classList.remove("activeResult"); //hide result box
        timeValue = '{{ $localtrivia->ques_time_limit }}';
        que_count = 0;
        que_numb = 1;
        userScore = 0;
        widthValue = 0;
        showQuetions(que_count); //calling showQestions function
        queCounter(que_numb); //passing que_numb value to queCounter
        clearInterval(counter); //clear counter
        clearInterval(counterLine); //clear counterLine
        startTimer(timeValue); //calling startTimer function
        startTimerLine(widthValue); //calling startTimerLine function
        timeText.textContent = "Time Left"; //change the text of timeText to Time Left
        next_btn.classList.remove("show"); //hide the next button
    }

    // if quitQuiz button clicked
    quit_quiz.onclick = () => {
        window.location.reload(); //reload the current window
    }

    const next_btn = document.querySelector("footer .next_btn");
    const bottom_ques_counter = document.querySelector(".total_que");

    // if Next Que button clicked
    next_btn.onclick = () => {
        if (que_count < questions.length - 1) { //if question count is less than total question length
            que_count++; //increment the que_count value
            que_numb++; //increment the que_numb value
            showQuetions(que_count); //calling showQestions function
            queCounter(que_numb); //passing que_numb value to queCounter
            clearInterval(counter); //clear counter
            clearInterval(counterLine); //clear counterLine
            startTimer(timeValue); //calling startTimer function
            startTimerLine(widthValue); //calling startTimerLine function
            timeText.textContent = "Time Left"; //change the timeText to Time Left
            next_btn.classList.remove("show"); //hide the next button
            if( lifelineNo != 0)
            btn50.removeAttribute('disabled');
        } else {
            clearInterval(counter); //clear counter
            clearInterval(counterLine); //clear counterLine
            showResult(); //calling showResult function
            if( lifelineNo != 0)
            btn50.disabled = false;
        }
    }

    const shuffle = (array) => {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    };

    function lifeline(array, sel) {

        let value = array[Math.floor((Math.random() * array.length))];

        if (value == sel || value == undefined) {
            return lifeline(array, sel);
        }

        return shuffle([value, sel]);
    }

    // getting questions and options from array
    function showQuetions(index) {
        const que_text = document.querySelector(".que_text");
        const ques_img = document.querySelector(".ques_img");

        //creating a new span and div tag for question and option and passing the value using array index
        let que_tag = '<span>' + questions[index].numb + ". " + questions[index].text + '</span>';
        let option_tag = '<div class="option"><span>' + questions[index].options[0] + '</span></div>' +
            '<div class="option"><span>' + questions[index].options[1] + '</span></div>' +
            '<div class="option"><span>' + questions[index].options[2] + '</span></div>' +
            '<div class="option"><span>' + questions[index].options[3] + '</span></div>';
        let img = questions[index].file != '' ? '<div class="text-white"> <audio style="width:334px" controls><source src="../audios/'+questions[index].file+'" type="audio/mp3">Your browser does not support the audio tag.</audio></div>' : '';
        ques_img.innerHTML = img;
        que_text.innerHTML = que_tag; //adding new span tag inside que_tag
        option_list.innerHTML = option_tag; //adding new div tag inside option_tag
        if( lifelineNo != 0){
        btn50.innerHTML = "Take lifeline (" + lifelineNo + " chance left)";

        btn50.onclick = () => {
            lifelineNo -= 1;
            btn50.innerHTML = "Take lifeline (" + lifelineNo + " chance left)";
            if (lifelineNo == 0) {
                btn50.style.display = "none";
            }
            if (lifelineNo >= 0) {
                let op = lifeline(questions[index].options, questions[index].options[questions[index].answer - 1]);

                option_list.innerHTML =
                    '<div class="option" onclick="optionSelected(this)"><span>' + op[0] + '</span></div>' +
                    '<div class="option" onclick="optionSelected(this)"><span>' + op[1] + '</span></div>';
                btn50.disabled = true;
            }
        }
    }

        const option = option_list.querySelectorAll(".option");

        // set onclick attribute to all available options
        for (i = 0; i < option.length; i++) {
            option[i].setAttribute("onclick", "optionSelected(this)");
        }
    }
    // creating the new div tags which for icons
    let tickIconTag = '<div class="icon tick"><i class="fas fa-check"></i></div>';
    let crossIconTag = '<div class="icon cross"><i class="fas fa-times"></i></div>';

    //if user clicked on option
    function optionSelected(answer) {
        clearInterval(counter); //clear counter
        clearInterval(counterLine); //clear counterLine
        let userAns = answer.textContent; //getting user selected option
        let correcAnsRaw = questions[que_count].answer; //getting correct answer from array
        let correcAns = questions[que_count].options[correcAnsRaw - 1];

        const allOptions = option_list.children.length; //getting all option items

        if (userAns == correcAns) { //if user selected option is equal to array's correct answer
            userScore += 1; //upgrading score value with 1
            answer.classList.add("correct"); //adding green color to correct selected option
            answer.insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to correct selected option
            console.log("Correct Answer");
            console.log("Your correct answers = " + userScore);
        } else {
            answer.classList.add("incorrect"); //adding red color to correct selected option
            answer.insertAdjacentHTML("beforeend", crossIconTag); //adding cross icon to correct selected option
            console.log("Wrong Answer");

            for (i = 0; i < allOptions; i++) {
                if (option_list.children[i].textContent == correcAns) { //if there is an option which is matched to an array answer 
                    option_list.children[i].setAttribute("class", "option correct"); //adding green color to matched option
                    option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to matched option
                    console.log("Auto selected correct answer.");
                }
            }
        }
        for (i = 0; i < allOptions; i++) {
            option_list.children[i].classList.add("disabled");
            if( lifelineNo != 0)
            btn50.disabled = true;
            //once user select an option then disabled all options
        }
        next_btn.classList.add("show"); //show the next button if user selected any option
    }

    function showResult() {
        info_box.classList.remove("activeInfo"); //hide info box
        quiz_box.classList.remove("activeQuiz"); //hide quiz box
        result_box.classList.add("activeResult"); //show result box
        const scoreText = result_box.querySelector(".score_text");
        if (userScore > 3) { // if user scored more than 3
            //creating a new span tag and passing the user score number and total question number
            let scoreTag = '<span>and congrats! 🎉, You got <p>' + userScore + '</p> out of <p>' + questions.length + '</p></span>';
            scoreText.innerHTML = scoreTag; //adding new span tag inside score_Text
        } else if (userScore > 1) { // if user scored more than 1
            let scoreTag = '<span>and nice 😎, You got <p>' + userScore + '</p> out of <p>' + questions.length + '</p></span>';
            scoreText.innerHTML = scoreTag;
        } else { // if user scored less than 1
            let scoreTag = '<span>and sorry 😐, You got only <p>' + userScore + '</p> out of <p>' + questions.length + '</p></span>';
            scoreText.innerHTML = scoreTag;
        }

        document.querySelector('#iscore').value = userScore;

        var data = new FormData();

        data.append('game', 'guess-the-voice');
        data.append('score', userScore);
        data.append('_token', '{{ csrf_token() }}');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route("save-leader") }}', true);
        xhr.onload = function() {
            // do something to response
            console.log(this.responseText);
        };
        xhr.send(data);
    }

    function startTimer(time) {
        counter = setInterval(timer, 1000);

        function timer() {
            timeCount.textContent = time; //changing the value of timeCount with time value
            time--; //decrement the time value
            if (time < 9) { //if timer is less than 9
                let addZero = timeCount.textContent;
                timeCount.textContent = "0" + addZero; //add a 0 before time value
            }
            if (time < 0) { //if timer is less than 0
                clearInterval(counter); //clear counter
                timeText.textContent = "Time Off"; //change the time text to time off
                const allOptions = option_list.children.length; //getting all option items
                let correcAns = questions[que_count].answer; //getting correct answer from array
                for (i = 0; i < allOptions; i++) {
                    if (option_list.children[i].textContent == correcAns) { //if there is an option which is matched to an array answer
                        option_list.children[i].setAttribute("class", "option correct"); //adding green color to matched option
                        option_list.children[i].insertAdjacentHTML("beforeend", tickIconTag); //adding tick icon to matched option
                        console.log("Time Off: Auto selected correct answer.");
                    }
                }
                for (i = 0; i < allOptions; i++) {
                    option_list.children[i].classList.add("disabled"); //once user select an option then disabled all options
                }
                next_btn.classList.add("show"); //show the next button if user selected any option
            }
        }
    }


    function startTimerLine(time) {
        counterLine = setInterval(0, 20);

        function timer() {
            time += 1; //upgrading time value with 1
            time_line.style.width = time + "px"; //increasing width of time_line with px by time value
            if (time > 549) { //if time value is greater than 549
                clearInterval(counterLine); //clear counterLine
            }
        }
    }

    function queCounter(index) {

        let totalQueCounTag = '<span><p>' + index + '</p> of <p>' + questions.length + '</p> Questions</span>';
        bottom_ques_counter.innerHTML = totalQueCounTag;
    }
</script>
@endpush