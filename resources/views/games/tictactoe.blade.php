@extends('layouts.app')
@section('title', 'TicTacToe')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/tictac.css')}}">
<div class="score">
    Team X --- <span id="playerXScore">0</span> Team O ---
    <span id="playerOScore">0</span>
</div>
<div class="board">
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
    <div class="cell"></div>
</div>

<div class="button">
    <button class="reset-button">Reset</button>
    <button class="continue-button">Continue</button>
    <button class="back-button" onclick="{window.location.href='{{ url('games') }}'}">Back</button>
</div>

<style>
    body {
        background: url('../public/assets/bg.jpg');
        height: 100vh;
    }
</style>

@endsection

@push('scripts')
<script>
    const cells = Array.from(document.querySelectorAll(".cell"));
    const resetButton = document.querySelector(".reset-button");
    const continueButton = document.querySelector(".continue-button");
    const playerXScore = document.querySelector("#playerXScore");
    const playerOScore = document.querySelector("#playerOScore");

    let currentPlayer = "X";
    let gameActive = true;
    let gameBoard = Array(9).fill("");

    const winningCombinations = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6]
    ];

    const handleCellClick = (e) => {
        const {
            target: cell
        } = e;
        const index = cells.indexOf(cell);

        if (gameBoard[index] !== "" || !gameActive) {
            return;
        }

        gameBoard[index] = currentPlayer;
        cell.textContent = currentPlayer;
        cell.classList.add(currentPlayer);

        if (checkWin()) {
            endGame(false);
            return;
        }

        if (checkDraw()) {
            endGame(true);
            return;
        }

        currentPlayer = currentPlayer === "X" ? "O" : "X";
        if (currentPlayer === "O") {
            setTimeout(computerMove, 700);
        }
    };

    const computerMove = () => {
        const availableMoves = gameBoard
            .map((cell, index) => (cell === "" ? index : null))
            .filter((cell) => cell !== null);

        const randomIndex = Math.floor(Math.random() * availableMoves.length);
        const index = availableMoves[randomIndex];

        gameBoard[index] = currentPlayer;
        cells[index].textContent = currentPlayer;
        cells[index].classList.add(currentPlayer);

        if (checkWin()) {
            endGame(false);
            return;
        }

        if (checkDraw()) {
            endGame(true);
            return;
        }

        currentPlayer = "X";
    };

    const checkWin = () => {
        return winningCombinations.some(
            ([a, b, c]) =>
            gameBoard[a] !== "" &&
            gameBoard[a] === gameBoard[b] &&
            gameBoard[a] === gameBoard[c]
        );
    };

    const checkDraw = () => {
        return gameBoard.every((cell) => cell !== "");
    };

    const endGame = (isDraw) => {
        gameActive = false;
        if (isDraw) {
            alert("It's a draw!");
        } else {
            alert(`Player ${currentPlayer} wins!`);
            currentPlayer === "X" ?
                (playerXScore.textContent = parseInt(playerXScore.textContent) + 1) :
                (playerOScore.textContent = parseInt(playerOScore.textContent) + 1);
        }
    };

    const resetGame = () => {
        gameActive = true;
        currentPlayer = "X";
        gameBoard = Array(9).fill("");
        cells.forEach((cell) => {
            cell.textContent = "";
            cell.classList.remove("X", "O");
        });
        playerXScore = 0;
        playerOScore = 0;
        playerXScore.textContent = "0";
        playerOScore.textContent = "0";
    };

    cells.forEach((cell) => cell.addEventListener("click", handleCellClick));
    resetButton.addEventListener("click", resetGame);
    continueButton.addEventListener("click", () => {
        if (!gameActive) {
            resetGame();
        }
    });
</script>
@endpush