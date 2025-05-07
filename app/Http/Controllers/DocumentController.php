<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{



    // Share a document
    public function shareDocument(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "name" => "required|string|max:255",
            'receiver_email' => 'required|exists:users,email',
            'files' => 'required|array',
            'files.*' => 'required|file|max:10240', // 10MB
            'description' => 'nullable|string'
        ]);
        $storedFiles = $this->storeFiles($request->file('files'));
        // get user id by email
        $receiverId = User::where('email', $request->receiver_email)->value('id');
        $document = Document::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'description' => $request->description,
            'name' => $request->name,
            'is_saved' => false,
            'is_vued' => false,

        ]);
        // Attach document files

        foreach ($storedFiles as $file) {
            $document->files()->create([
                'file_name' => $file["file_name"],
                'file_path' => $file["file_path"],
            ]);
        }


        return redirect()->route('documents.index')->with('success', 'Document shared successfully');
    }

    // List received documents
    public function documentsBySender($senderId)
    {
        //  dd( $senderId,auth()->id());
        $documents = Document::where('sender_id', $senderId)
            // ->where('receiver_id', auth()->id())
            ->with(['sender:id,name,email,created_at', 'receiver:id,name,email', "files"])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('documents.chat', compact('documents'));
    }

    // Save document to patient's account
    public function saveDocument($id)
    {
        $document = Document::where('id', $id)->where('receiver_id', auth()->id())->orWhere("sender_id", auth()->id())->first();
        if (!$document) {
            return redirect()->route('documents.index')->with('error', 'Document not found');
        }
        $document->update(['is_saved' => true]);

        return redirect()->route('documents.index')->with('success', 'Document saved successfully');
    }



    public function index()
    {
        //  $userId = auth()->id();
        $userId = 1;
        $documents = Document::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender:id,name,email', 'receiver:id,name,email', 'files'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view("documents.index", compact("documents"));
    }

    public function saved()
    {
        //  $userId = auth()->id();
        $userId = 1;
        $documents = Document::where("is_saved", 1)
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender:id,name,email', 'receiver:id,name,email', 'files'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view("documents.index", compact("documents"));
    }
    public function sent()
    {
         $userId = auth()->id();
        $documents = Document::where('sender_id', $userId)
            ->with(['sender:id,name,email', 'receiver:id,name,email', 'files'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view("documents.index", compact("documents"));
    }

    public function recived()
    {
         $userId = auth()->id();
        $documents = Document::where('receiver_id', $userId)
            ->where("is_saved", true)
            ->with(['sender:id,name,email', 'receiver:id,name,email', 'files'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view("documents.index", compact("documents"));
    }

    // edit the function so it return the path and file name of each file


    // private function storeFiles($files)
    // {
    //     $paths = [];
    //     foreach ($files as $file) {
    //         $path = $file->store('documents', 'public');
    //         $paths[] = $path;
    //     }
    //     return $paths;
    // }
    // create function that accepts files store them and return array of arrays each array have stored path file and file name
    private function storeFiles($files)
    {
        $paths = [];
        foreach ($files as $file) {
            $path = $file->store('documents', 'public');
            $paths[] = [
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName()
            ];
        }
        return $paths;
    }
}
