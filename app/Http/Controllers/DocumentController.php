<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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
public function download($path)
{
    $disk = Storage::disk('public');

    if (!$disk->exists($path)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    return $disk->download($path);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
