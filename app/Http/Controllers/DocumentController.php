<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     */
    public function index(Request $request)
    {
        $query = Document::query();

        // Apply filters
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('year')) {
            $query->byYear($request->year);
        }

        // Get documents with pagination
        $documents = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get filter options
        $categories = Document::query()
            ->select('category')
            ->distinct()
            ->pluck('category')
            ->sort();

        $years = Document::query()
            ->select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('documents', compact('documents', 'categories', 'years'));
    }

    /**
     * Download a document.
     */
    public function download(Document $document)
    {
        if (!Storage::exists($document->file_path)) {
            abort(404, 'File not found');
        }

        // Increment download count
        $document->incrementDownload();

        $filePath = Storage::path($document->file_path);

        return Response::download($filePath, $document->file_name);
    }

    /**
     * Handle document search (AJAX or redirect).
     */
    public function search(Request $request)
    {
        $query = Document::query();

        if ($request->filled('q')) {
            $query->search($request->q);
        }

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        if ($request->filled('year')) {
            $query->byYear($request->year);
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('document-list', compact('documents'))->render();
        }

        return redirect()->route('documents', $request->except(['page']));
    }

    /**
     * Show form to create a new document.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly uploaded document.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');

        Document::create([
            'file_name' => $request->file_name,
            'category' => $request->category,
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
            'file_type' => strtoupper($file->getClientOriginalExtension()),
            'year' => $request->year,
        ]);

        return redirect()->route('documents')->with('success', 'Dokumen berjaya ditambah!');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(Document $document)
    {
        // Delete file from storage
        if (Storage::exists($document->file_path)) {
            Storage::delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('documents')->with('success', 'Dokumen berjaya dipadamkan!');
    }
}