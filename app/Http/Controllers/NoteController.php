<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoteController extends Controller
{
    // Get all notes with pagination
    public function index()
    {
        $notes = Note::latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $notes
        ]);
    }

    // Create note
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note = Note::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Note created successfully',
            'data' => $note
        ], 201);
    }

    // Get single note
    public function show(Note $note)
    {
        return response()->json([
            'success' => true,
            'data' => $note
        ]);
    }

    // Update note
    public function update(Request $request, Note $note)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Note updated successfully',
            'data' => $note
        ]);
    }

    // Delete note
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json([
            'success' => true,
            'message' => 'Note deleted successfully'
        ]);
    }
    public function generateSummary(Note $note)
    {
        $summary = collect(explode('.', $note->content))
            ->take(2)
            ->implode('.');

        $note->update([
            'summary' => $summary
        ]);

        return response()->json([
            'success' => true,
            'summary' => $summary
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->query('q');

        $notes = Note::where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $notes
        ]);
    }
    // =====================
    // WEB METHODS
    // =====================

    public function home(Request $request)
    {
        $search = $request->search;

        $notes = Note::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(10);

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function storeWeb(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Note::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/');
    }

    public function summaryWeb(Note $note)
    {
        $summary = str($note->content)
            ->limit(100)
            ->toString();

        $note->update([
            'summary' => $summary
        ]);

        return redirect('/');
    }
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function updateWeb(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/');
    }

    public function deleteWeb(Note $note)
    {
        $note->delete();

        return redirect('/');
    }

}