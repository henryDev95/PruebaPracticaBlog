<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Publication::with('user')->orderBy('created_at', 'desc')->get();
        $query = Publication::with(['user', 'category'])->latest();

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        return $query->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);
        $publication = Publication::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(), // Asegúrate que esté autenticado
        ]);

        return response()->json($publication, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        return Publication::with('user')->findOrFail($publication->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $publication = Publication::findOrFail($id);
    
        if ($publication->user_id !== auth()->id()) {
            return response()->json(['error' => "No autorizado" ], 403);
        }
    
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);
    
        $publication->update([
            'title' => $request->title,
            'content' => $request->content
        ]);
    
        return response()->json($publication);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        if ($publication->user_id !== auth()->id()) {
            return response()->json(['error' => 'No autorizado'], 403);
        }
    
        $publication->delete();
        return response()->json(['message' => 'Publicación eliminada']);
    }
}
