<?php

namespace App\Http\Controllers\API\ContactMe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class MessageController extends Controller
{
    public function getAllMessages()
    {
    	$messages = Contact::paginate(10);

    	return response()->json($messages);
    }



    public function storeMessage(Request $request)
    {
    	$message = Contact::create([
    		'name' => $request->name,
    		'email' => $request->email,
    		'subject' => $request->subject,
    		'message' => $request->message
    	]);

    	return response()->json($message);
    }



    public function deleteMessage($id)
    {
    	Contact::where('id', $id)->delete();

    	return response()->json('Message was Deleted');
    }
}
