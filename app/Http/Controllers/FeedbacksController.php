<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    public function index(Feedback $feedback)
    {
        $adminBlogs = $feedback->latest()->get();
        return view('admin.feedbacks', compact('adminBlogs'));
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

        return redirect('/contacts');
    }
}
