<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Screenshot;
use Session;

class ScreenshotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $screenshots = Screenshot::orderBy('updated_at', 'desc')->paginate(10);
        return view('manage.screenshots.index')->with('screenshots', $screenshots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return Create Page
        return view('manage.screenshots.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'cover_image' => 'image|nullable'
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            # Get the filename with extension
            $filenameWithExt = $request->file('cover_image')->GetClientOriginalName();

            # Get FileName Only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            # Get Extension Only
            $extension = $request->file('cover_image')->GetClientOriginalExtension();

            # Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            # Upload the Image
            $path = $request->file('cover_image')->storeAs('public/images/cover_images', $fileNameToStore);

        } else {
            # Set default file
            $fileNameToStore = 'noimage.jpg';
        }

        // Create new screenshot instance
        $screenshot = new Screenshot;

        $screenshot->cover_image = $fileNameToStore;

        $str = $screenshot->cover_image;

        $sep='-';
        
        $res = strtolower($str);
        $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
        $res = preg_replace('/[[:space:]]+/', $sep, $res);
        $slug = trim($res, $sep);

        $screenshot->image_slug = $slug;

        $screenshot->save();

        Session::flash('success', 'screenshot created successfully');

        return redirect()->route('screenshots.index')->with('success', 'screenshot created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $screenshot = Screenshot::find($id);
        // Return Show Page
        return view('manage.screenshots.show')->with('screenshot', $screenshot);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    // Fetch screenshot data from DB
        $screenshot = Screenshot::find($id);
        $screenshots = Screenshot::all();
    // Check correct user authentication
    /*if (Auth::user()->id != $screenshot->user_id) {
        # Redirect user to screenshot Index route
        return redirect('/screenshots')->with('error', 'Unauthorized Access!');
    }*/

    // Return edit view with data
        return view('manage.screenshots.edit')->with('screenshot', $screenshot)->with('screenshots', $screenshots);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $this->validate($request, [
            'cover_image' => 'image|nullable'
        ]);

        // Handle file upload
        if ($request->hasFile('cover_image')) {
            # Get the filename with extension
            $filenameWithExt = $request->file('cover_image')->GetClientOriginalName();

            # Get FileName Only
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            # Get Extension Only
            $extension = $request->file('cover_image')->GetClientOriginalExtension();

            # Filename to Store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            # Upload the Image
            $path = $request->file('cover_image')->storeAs('public/images/cover_images', $fileNameToStore);

            // Find screenshot in DB by ID
            $screenshot = Screenshot::find($id);

                # Replace Feature Image
                $screenshot->cover_image = $fileNameToStore;

            $str = $screenshot->cover_image;

            $sep='-';
            
            $res = strtolower($str);
            $res = preg_replace('/[^[:alnum:]]/', ' ', $res);
            $res = preg_replace('/[[:space:]]+/', $sep, $res);
            $slug = trim($res, $sep);

            $screenshot->image_slug = $slug;

            $screenshot->save();
        }

        return redirect()->route('screenshots.index')->with('success', 'screenshot updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $screenshot = Screenshot::find($id);

        //
        $screenshot->delete();

        //
        return redirect()->route('screenshots.index');
    }
}
