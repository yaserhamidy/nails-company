<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Results</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <style>
        /* Add any custom styles here */
        .user-answer.correct {
            color: green;
            font-weight: bold;
        }
        .user-answer.incorrect {
            color: red;
            font-weight: bold;
        }
        .correct-answer {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1>Test Results</h1>
       
        <p>You answered <span class="text-danger fw-bold">{{ $correctAnswers }}</span> out of <span class="text-danger fw-bold">{{ $totalQuestions }}</span> questions correctly.</p>
        <p>Your percentage score is <span class="text-danger fw-bold">{{ number_format($percentage, 2) }}%</span>.</p>

        <h2 class="mt-5">جواب شما</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>جواب درست</th>
                    <th>جواب شما</th>
                    <th>سوال</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userAnswers as $questionId => $userAnswer)
                <tr>
                    <td>
                        <span class="correct-answer">{{ $questions->where('question_id', $questionId)->first()->finalanswer }} گزینه</span>
                    </td>
                    <td>
                        @if ($userAnswer === null)
                        <span class="text-muted">هیچ جواب انتخاب نشده است</span>
                        @else
                        <span class="user-answer {{ $userAnswer == $questions->where('question_id', $questionId)->first()->finalanswer ? 'correct' : 'incorrect' }}">{{ $userAnswer }} گزینه</span>
                        @endif
                    </td>
                    
                    <td>{{ $questions->where('question_id', $questionId)->first()->question }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5">سوالات و جواب ها</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>جواب ها</th>
                    <th>سوال</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>
                        <ul>
                            <li>{{ $question->answerone }}</li>
                            <li>{{ $question->answertow }}</li>
                            <li>{{ $question->answerthree }}</li>
                            <li>{{ $question->answerfour }}</li>
                        </ul>
                    </td>
                    <td>{{ $question->question }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <a href="{{ route('admin.index') }}" class="btn btn-primary">برگشت به صفحه امتحانات</a>
        </div>
    </div>

    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>