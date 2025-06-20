<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    //return documents index view
    public function index()
    {
        return view('documents.index'); // your Blade view
    }

    //call this method to get documents
    public function getDocuments(Request $request)
    {
        // create a query builder instance for the Document model
        $query = Document::query();

        //if the parameter exists, the query will be added to the query builder
        //example: if the request has a parameter 'types', it will be select request->input('types') from documents
        if ($request->has('types')) {
            $types = (array) $request->input('types');
            $query->whereIn('file_type', $types);
        }

        if ($request->has('categories')) {
            $categories = (array) $request->input('categories');
            $query->whereIn('category', $categories);
        }

        if ($request->has('dateFrom')) {
            $query->whereDate('created_at', '>=', $request->input('dateFrom'));
        }

        if ($request->has('dateTo')) {
            $query->whereDate('created_at', '<=', $request->input('dateTo'));
        }

        if ($request->has('search')) {
            $query->where('file_name', 'like', '%' . $request->input('search') . '%');
        }

        //example filename and file_type exists
        //"select * from `documents` where `file_type` in (?) and `file_name` like ?" // app\Http\Controllers\DocumentController.php:46

        $documents = $query->get()->map(function ($doc) {
            return [
                'file_name' => $doc->file_name,
                'file_download_url' => url('/documents/download/' . $doc->file_path),
                'file_type' => $doc->type,
                'category' => $doc->category,
                'date' => $doc->created_at->toDateString(),
                'file_size' => $doc->size,
            ];
        });

        return response()->json(['documents' => $documents]);
    }

    //function to download a document
    // public function download($path)
    // {
    //     $disk = Storage::disk('public');

    //     if (!$disk->exists($path)) {
    //         return response()->json(['error' => 'File not found'], 404);
    //     }

    //     return $disk->download($path);
    // }

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
