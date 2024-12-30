<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\sale;
use App\Models\row_material;
use App\Models\dailyTask;
use Illuminate\Http\Request;

class DailyTaskController extends Controller
{
     // Show all daily tasks
     public function show(Request $request)
     {
         // Retrieve all daily tasks with their related models
         $tasks = dailyTask::with(['Product', 'row_material', 'sale'])
                           ->where('task_date', now()->toDateString())
                           ->get();
 
         // Return the view with the tasks
         return view('dashboards.admins.dailytask.dailyTask-show', compact('tasks'));
     }
}
