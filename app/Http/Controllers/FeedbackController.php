<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $feedback = Feedback::create($request->all());
        $feedback->user_id = auth()->user()->id;
        $feedback->save();
        return redirect()->route('home')->with('create', 'Thanks You for your Feedback');
    }

    public function index()
    {
        return view('backend.feedback.index');
    }

    public function ssd()
    {
        $feedback = Feedback::query();
        return Datatables::of($feedback)
            ->addColumn('username', function($each) {
                return $each->user->username;
            })
            ->editColumn('created_at', function($each) {
                return Carbon::parse($each->created_at)->diffForHumans();
            })
            ->make(true);
    }
}
