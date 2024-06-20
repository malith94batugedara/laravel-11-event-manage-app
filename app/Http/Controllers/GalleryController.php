<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $galleries = Gallery::all();
        return view('galleries.index',compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGalleryRequest $request)
    { 
        if ($request->hasFile('image')) {
            $data = $request->validated();

                $data['caption'] = $request->input('caption');
                $data['image'] = Storage::putFile('galleries',$request->file('image'));
                $data['user_id'] = auth()->id();
            
            Gallery::create($data);

            return to_route('galleries.index')->with('message','Gallery Added Successfully!');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
