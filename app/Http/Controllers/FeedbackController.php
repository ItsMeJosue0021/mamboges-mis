<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Feedback;
use App\Mail\FeedbackReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    //show all feedback
    public function index() {
        return view('feedback.index', [
            'feedbacks' => Feedback::latest()->filter(Request(['search']))->get()
        ]);
    }

    //show single feedback
    public function show(Feedback $feedback) {
        return view('feedback.show', [
            'feedback' => $feedback
        ]);
    }

    //store feedback
    public function store(Request $request) {

        $feedbackAarray = array (
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        );
    
        $feedback = Feedback::create($feedbackAarray);
    
        if (!is_null($feedback)) {
            return response()->json(['success' => true, 'message' => 'Thank you for you feedback!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Sending unsuccessful!']);
        }   
    }

    public function read($id) {
        $feedback = Feedback::findOrFail($id);
        $feedback->isRead = true;
        $feedback->save();
    }

    public function reply(Request $request, $feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $feedbackEmail = $feedback->email;

        $replyMessage = $request->input('message');

        $subject = $request->input('subject');

        $this->validate($request, [
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $data = [
            'subject' => $subject,
            'feedback' => $feedback,
            'replyMessage' => $replyMessage
        ];

        try {
            Mail::send('emails.feedback.reply-temp', $data, function($message) use ($feedbackEmail, $subject) {
                $message->to($feedbackEmail)->subject($subject);
            });
            return redirect()->back()->with('success', 'Email sent successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error sending email: ' . $e->getMessage());
        }
    }  

}
