<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userProperty;

class FrontPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth()->user()->id;
        $post = userProperty::where('user_id','=',$userId)->orderBy('created_at','desc')->get();
        return view('dashboard',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload-post');
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
            'saleRent' => 'required',
            'category' => 'required',
            'address' => 'required',
            'township' => 'required',
            'price' => 'required',
            'money' => 'required',
            'description' => 'required',
            'mainImage' => 'required',
            'otherImage' => 'required',
            'term' => 'required',
        ]);

        $userId = Auth()->user()->id;

        $fileNameWithExt = $request->file('mainImage')->getClientOriginalName();

        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('mainImage')->getClientOriginalExtension();

        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;


        $otherImages = array();
        $files = $request->file('otherImage');
        foreach ($files as $file) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/adminUploads/';
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $otherImages[] = $image_url;
            $insert = implode('|', $otherImages);
        }

        $property = new userProperty;
        $property->saleRent = $request->saleRent;
        $property->category = $request->category;
        $property->address = $request->address;
        $property->township = $request->township;
        $property->price = $request->price;
        $property->money = $request->money;
        $property->mainImage = $fileNameToStore;
        $property->otherImage = $insert;
        $property->bedrooms = $request->bedroom;
        $property->bathrooms = $request->bathroom;
        $property->floor = $request->floor;
        $property->square_feet = $request->squarefeet;
        $property->approve = 0;
        $property->user_id = $userId;
        $property->description = $request->description;

        $property->save();
        $request->file('mainImage')->storeAs('public/adminUploads', $fileNameToStore);


        return response()->json(['success' => 'Data Upload Success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = userProperty::where('id',$id)->limit(1)->get();
        return view('dashboard-detail',compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = userProperty::where('id',$id)->get();
        $userId = Auth()->user()->id;
        foreach ($edit as $edits) {
            if ($edits->user_id != $userId) {
                return redirect()->route('dashboard')->with('sms','You are allowed to edit this post');
            }else{
                return view('dashboard-edit',compact('edit'));
            }
        }

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
        $request->validate([
            'saleRent' => 'required',
            'category' => 'required',
            'address' => 'required',
            'township' => 'required',
            'price' => 'required',
            'money' => 'required',
            'description' => 'required',
            'mainImage' => 'required',
            'otherImage' => 'required',
            'term' => 'required',
        ]);

        $toDelete = userProperty::where('id', $id)->get();


        foreach ($toDelete as $delImg) {

            $main = $delImg->mainImage;
            $mainImg = (public_path('storage/adminUploads/') . $main);
            @unlink($mainImg);

            $other = explode('|', $delImg->otherImage);

            foreach ($other as $others) {
                @unlink(public_path('/') . $others);
            }
        }

        $userId = Auth()->user()->id;

        $fileNameWithExt = $request->file('mainImage')->getClientOriginalName();

        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('mainImage')->getClientOriginalExtension();

        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;


        $otherImages = array();
        $files = $request->file('otherImage');
        foreach ($files as $file) {
            $image_name = md5(rand(1000, 10000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/adminUploads/';
            $image_url = $upload_path . $image_full_name;
            $file->move($upload_path, $image_full_name);
            $otherImages[] = $image_url;
            $insert = implode('|', $otherImages);
        }

        $property = userProperty::find($id);
        $property->saleRent = $request->saleRent;
        $property->category = $request->category;
        $property->address = $request->address;
        $property->township = $request->township;
        $property->price = $request->price;
        $property->money = $request->money;
        $property->mainImage = $fileNameToStore;
        $property->otherImage = $insert;
        $property->bedrooms = $request->bedroom;
        $property->bathrooms = $request->bathroom;
        $property->floor = $request->floor;
        $property->square_feet = $request->squarefeet;
        $property->approve = 0;
        $property->user_id = $userId;
        $property->description = $request->description;

        $property->save();
        $request->file('mainImage')->storeAs('public/adminUploads', $fileNameToStore);


        return response()->json(['success' => 'Data Upload Success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $edit = userProperty::where('id', $id)->get();
        $userId = Auth()->user()->id;
        foreach ($edit as $edits) {
            if ($edits->user_id != $userId) {
                return redirect()->route('dashboard')->with('sms', 'You are allowed to edit this post');
            } else {
                foreach ($edit as $delImg) {

                    $main = $delImg->mainImage;
                    $mainImg = (public_path('storage/adminUploads/') . $main);
                    @unlink($mainImg);

                    $other = explode('|', $delImg->otherImage);

                    foreach ($other as $others) {
                        @unlink(public_path('/') . $others);
                    }
                }
                userProperty::where('id',$id)->delete();
                return redirect()->route('dashboard')->with('sms','Deleted Successfully');
            }
        }
    }
}
