<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

                    $file=$request->file('image');
                    $filename=time().'.'.$file->getClientOriginalExtension();
                    $file->move('uploads/galleries/',$filename);
                    $data['image']=$filename;
               
                // $data['image'] = Storage::putFile('galleries',$request->file('image'));
                $data['user_id'] = auth()->id();
            
            Gallery::create($data);

            return to_route('galleries.index')->with('message','Gallery Added Successfully!');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('galleries.edit',compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request,Gallery $gallery)
    {
        $data = $request->validated();

        if($request->hasFile('image')){

                $destination ='uploads/galleries/'.$gallery->image;
                if(File::exists($destination)){
                     File::delete($destination);
                }
    
                 $file=$request->file('image');
                 $filename=time().'.'.$file->getClientOriginalExtension();
                 $file->move('uploads/galleries/',$filename);
                 $data['image']=$filename;
            
        }
            $data['caption'] = $request->input('caption');

            $gallery->update($data);
            return redirect(route('galleries.index'))->with('message','Gallery Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $destination ='uploads/galleries/'.$gallery->image;
            if(File::exists($destination)){
                 File::delete($destination);
            }
        $gallery->delete();
        return redirect(route('galleries.index'))->with('message','Gallery Deleted Successfully!');
    }
}
