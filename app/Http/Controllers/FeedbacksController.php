<?php

namespace App\Http\Controllers;

use App\Models\Feedback;

class FeedbacksController extends Controller
{
    public function index(Feedback $feedback)
    {
        $feedbacks = $feedback->latest()->get();
        return view('feedbacks', compact('feedbacks'));
    }

    public function create()
    {
        return view('contacts');
    }

    public function store()
    {
        Feedback::create($this->validate(request(), [
            'email' => 'required',
            'message' => 'required',
        ]));

        return redirect('/contacts')->with('success', 'Отзыв успешно отправлен!');
    }
}
