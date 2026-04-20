<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index', [
            'notes' => Note::latest()->get()
        ]);
    }

    public function dashboard()
    {
        $user = Auth::user();

        if($user->role==1){
            $notes = Note::latest()->get();
        } else {
            $notes = $user->notes;
        }

        return view('dashboard', compact('notes'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content
        ]);


        return back();
    }

    public function update(Request $request, Note $note)
    {
        $note->update($request->all());
        return back();
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return back();
    }

    public function ShowNote()
    {
        return view('notes.show');
    }


}
