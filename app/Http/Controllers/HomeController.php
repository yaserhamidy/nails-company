<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subject;
use App\Models\question;
use App\Models\awnser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function firstPage()
    {
        // Add your logic here to handle the first page request
        return view('first_page');
    }

    public function showExamPage()
    {
        // Add your logic here to handle the exam page request
        return view('auth.Login');
    }


    // 

    
    public function showExamPages(){
        $subjects = subject::where('status', 'active')->paginate(4);
       
        return view('dashboards.users.index', compact('subjects'));
    }
    public function exam_page($sub_classesses_id)
    {
        $subClass = subject::findOrFail($sub_classesses_id);
        $questions = question::where('sub_classesses_id', $sub_classesses_id)->get();
        $timer = $subClass->timer;
    
        return view('exam_page', compact('questions', 'timer', 'subClass'));
    }
    
    
 



        public function submitTest(Request $request)
        {
            
            $questionIds = $request->input('question_id');
            $answers = $request->except(['_token', 'question_id']);
            $userId = auth()->id(); // Get the authenticated user's ID
        
            $correctAnswers = 0;
            $totalQuestions = count($questionIds);
            $userAnswers = [];
            $correctAnswersArray = [];
        
            foreach ($questionIds as $id) {
                $question = question::find($id);
                $userAnswer = $answers['answer_' . $id] ?? null; // Get user answer or null if not set
        
                // Insert the user's answer into the 'answers' table
                $answer = new \App\Models\awnser();
                $answer->question_id = $id;
                $answer->choiceanswer = $userAnswer;
                $answer->correctanswer = $question->finalanswer;
                $answer->statusanswer = ($userAnswer == $question->finalanswer) ? 'Correct' : 'Incorrect';
                $answer->save();
        
                $userAnswers[$id] = $userAnswer;
                $correctAnswersArray[$id] = $question->finalanswer;
        
                if ($userAnswer == $question->finalanswer) {
                    $correctAnswers++;
                }
            }
        
            $percentage = ($correctAnswers / $totalQuestions) * 100;
        
            // Save the result to the results table
            $result = new \App\Models\result();
            
            $result->user_id = $userId; // User ID
            $result->exam_id = $request->input('exam_id');  // Assume you pass exam ID from the form
            $result->correctanswer = $correctAnswers;
            $result->incorrectanswer = $totalQuestions - $correctAnswers;
            $result->points = $percentage; // Optional, if you want to save percentage
            $result->save();
        
            // Pass the results to the view
            $questions = question::whereIn('question_id', $questionIds)->get(); // Use 'id' instead of 'question_id'
        
            return view('result', compact('correctAnswers', 'totalQuestions', 'percentage', 'userAnswers', 'correctAnswersArray', 'questions'));
        }

        public function profile()
{
    $userId = auth()->id(); // Get the authenticated user's ID
    $results = \App\Models\result::where('user_id', $userId)->with('exam')->paginate(10); // Fetch results for the user

    return view('dashboards.users.profile', compact('results')); // Use the correct path
}


}
