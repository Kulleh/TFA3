<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Welcome extends BaseController
{
    public function index()
    {
        $taskModel = new TaskModel();

        $tasks = $taskModel
            ->where('task_date', date('Y-m-d'))
            ->findAll();

        return view('welcome/index', [
            'tasks' => $tasks
        ]);
    }
}