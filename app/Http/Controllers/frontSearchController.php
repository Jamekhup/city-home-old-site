<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use App\Models\adminProperty;

class frontSearchController extends Controller
{
    public function homeSearch(Request $request){
        $get = $_GET['search'];
        if($get ==''){
            return back();
        }else{
            $property = adminProperty::where('township', 'LIKE', '%' . $get . '%')->orderBy('created_at', 'desc')->get();

            return view('home-search', compact('property'));
        }
    }

    public function homeSearchDetail($id){
        $property = adminProperty::where('saleRent', 'for-rent')
        ->orderBy('created_at', 'desc')->get();

        $detail = adminProperty::where('id', $id)->get();

        return view('home-search-detail', compact('property', 'detail'));
    }


    // property search
    public function propertySearch(){
        $one = $_GET['township'];
        $two = $_GET['saleRent'];
        $three = $_GET['category'];

        if($one ==''){
            return back();
        }else{
            $property = adminProperty::where('township', '=', $one)
            ->orWhere('saleRent', '=', $two)
            ->orWhere('category', '=', $three)->orderBy('created_at', 'desc')->get();

            return view('property-search', compact('property'));
        }
    }

    public function propertySearchDetail($id){
        $property = adminProperty::where('saleRent', 'for-rent')
        ->orderBy('created_at', 'desc')->get();

        $detail = adminProperty::where('id', $id)->get();

        return view('property-search-detail', compact('property', 'detail'));
    }

}
