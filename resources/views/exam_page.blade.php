<!DOCTYPE html>
<html>
<head>
    <title>Four-Question Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 5px;
        }

        p {
            margin-top: 0;
        }

        input[type="radio"] {
            margin-bottom: 5px;
        }

        button[type="submit"] {
            display: block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        button[type="submit"]:focus {
            outline: none;
        }

        .timer {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Four-Question Test</h1>
    <div class="timer">
        <span id="minutes">{{ $timer }}</span>:<span id="seconds">00</span>
    </div>

    <form method="post" action="{{ route('submit-test') }}">
        @csrf
        <input type="hidden" name="exam_id" value="{{ $subClass->sub_classesses_id }}">
        <?php
        $counter = 0;
        ?>
        @foreach ($questions as $question)
        <h2>Question {{ ++$counter }}:</h2>
        <input type="hidden" name="question_id[]" value="{{ $question->question_id }}">
        <p>{{ $question->question }}</p>
        <input type="radio" name="answer_{{ $question->question_id }}" value="1">{{ $question->answerone }}<br>
        <input type="radio" name="answer_{{ $question->question_id }}" value="2">{{ $question->answertow }}<br>
        <input type="radio" name="answer_{{ $question->question_id }}" value="3">{{ $question->answerthree }}<br>
        <input type="radio" name="answer_{{ $question->question_id }}" value="4">{{ $question->answerfour }}<br>
        @endforeach
        <button type="submit">Submit</button>
    </form>

    <script>
        let interval;
        let minutes = {{ $timer }};
        let seconds = 0;

        function startTimer() {
            interval = setInterval(function() {
                if (seconds === 0) {
                    minutes--;
                    seconds = 59;
                } else {
                    seconds--;
                }

                document.getElementById("minutes").textContent = padZero(minutes);
                document.getElementById("seconds").textContent = padZero(seconds);

                if (minutes === 0 && seconds === 0) {
                    stopTimer();
                    alert("Time's up!");
                    document.querySelector('form').submit();
                }
            }, 1000);
        }

        function stopTimer() {
            clearInterval(interval);
        }

        function padZero(value) {
            return value.toString().padStart(2, '0');
        }

        startTimer();
    </script>
</body>
</html>