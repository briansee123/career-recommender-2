<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $questions = Question::active()->ordered()->get();
        return view('user.test', compact('questions'));
    }
}