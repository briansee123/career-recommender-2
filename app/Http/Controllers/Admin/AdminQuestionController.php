<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{
    public function index()
    {
        $questions = Question::where('is_active', 1)->orderBy('order')->get();
        return view('admin.questions', compact('questions'));
    }

    public function update(Request $request)
    {
        try {
            $questions = $request->input('questions');
            foreach ($questions as $questionData) {
                $question = Question::find($questionData['id']);
                if ($question) {
                    $question->update([
                        'question' => $questionData['question'],
                        'options' => $questionData['options']
                    ]);
                }
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        Question::create([
            'question' => $request->question,
            'options' => ['E' => $request->option_E, 'I' => $request->option_I],
            'order' => $request->order ?? 1,
            'is_active' => true
        ]);
        return redirect()->route('admin.questions')->with('success', 'Question added!');
    }

    public function destroy($id)
    {
        Question::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}