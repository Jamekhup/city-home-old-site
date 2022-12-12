<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adminProperty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\subscriber;
use App\Models\User;
use App\Models\userProperty;

class adminPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminPost = adminProperty::all();
        $userPost = userProperty::all();
        $users = User::all();
        $sub = subscriber::all();
        return view('admin.dashboard',compact('adminPost','userPost','users','sub'));
    }


    public function subscriber(){
        $sub = subscriber::orderBy('created_at','desc')->get();
        return view('admin.subscriber-list',compact('sub'));
    }

    public function deleteSubscriber($id){
        subscriber::where('id',$id)->delete();
        return back()->with('deleteSub','Delete Subscriber Successfully');
    }



    public function user()
    {
        $user = User::all();
        return view('admin.user-management',compact('user'));
    }

    //delete user
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back()->with('deleteUser','User Delete Success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-post');
    }

    public function adminpost(){
        $property = adminProperty::orderBy('created_at','desc')->get();
        return view('admin.admin-posts',compact('property'));
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
        ]);

        $fileNameWithExt = $request->file('mainImage')->getClientOriginalName();

        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('mainImage')->getClientOriginalExtension();

        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

        $request->file('mainImage')->move('public/adminUploads', $fileNameToStore);
        
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

        $property = new adminProperty;
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
        $property->carpark = $request->carpark;
        $property->description = $request->description;

        $property->save();
        

        //send mail to subscribers
        $saleRent = $request->saleRent;
        $category = $request->category;
        $township = $request->township;
        $bedrooms = $request->bedroom;
        $bathrooms = $request->bathroom;
        $floor = $request->floor;
        $square_feet = $request->squarefeet;
        $price = $request->price;
        $money = $request->money;
        $mail_data = [
            'subject' => 'New Updated Properties For Sale and Rent in Yangon - City Home Property Co.,ltd',
            'saleRent' => $saleRent,
            'category' => $category,
            'township' => $township,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'floor' => $floor,
            'square_feet' => $square_feet,
            'price' => $price,
            'money' => $money,
            'fileName' => $fileNameToStore,
        ];

        $job = (new \App\Jobs\SendMailToSub($mail_data))
            ->delay(now()->addSeconds(2));

        dispatch($job);

        // dd("Job dispatched.");

        return response()->json(['res' => 'Data Upload Success']);
        
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = adminProperty::where('id',$id)->get();
        return view('admin.admin-post-detail',compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = adminProperty::find($id);
        return view('admin.edit-admin-post', compact('edit'));
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
        ]);

        $toDelete = adminProperty::where('id', $id)->get();


        foreach ($toDelete as $delImg) {

            $main = $delImg->mainImage;
            $mainImg = (public_path('storage/adminUploads/') . $main);
            @unlink($mainImg);

            $other = explode('|', $delImg->otherImage);

            foreach ($other as $others) {
                @unlink(public_path('/') . $others);
            }
        }

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

        $property = adminProperty::find($id);
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
        $property->carpark = $request->carpark;
        $property->square_feet = $request->squarefeet;
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
        $toDelete = adminProperty::where('id',$id)->get();

        
        foreach ($toDelete as $delImg) {
            
            $main = $delImg->mainImage;
            $mainImg = (public_path('storage/adminUploads/') . $main);
            @unlink($mainImg);

            $other = explode('|', $delImg->otherImage);
            
            foreach ($other as $others) {
               @unlink(public_path('/').$others);
            }
            
        }
        

        adminProperty::where('id', $id)->delete();
        return back()->with('delete','Delete Success');
    }


    public function taken(Request $request, $id){
        $get = $request->taken;
        DB::table('adminposts')
        ->where('id',$id)
        ->update(['taken'=>$get]);

        return back()->with('updateTaken','Update Property Status Successfully');
    }
}
