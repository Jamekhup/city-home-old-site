<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userProperty;
use Illuminate\Support\Facades\DB;

class adminUserPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userPost = userProperty::orderBy('created_at','desc')->get();
        return view('admin.user-posts',compact('userPost'));
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
    public function store(Request $request, $id)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = userProperty::where('id',$id)->get();
        return view('admin.user-posts-detail',compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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


        userProperty::where('id', $id)->delete();
        return back()->with('delete', 'Delete Success');
    }



    //approve user pose
    public function approveuserpost(Request $request, $id){
        $getValue = $request->taken;
        DB::table('userposts')
        ->where('id', $id)
        ->update(['approve' => $getValue]);

        return back()->with('approved', 'Post Approved Successfully');

    }
}
