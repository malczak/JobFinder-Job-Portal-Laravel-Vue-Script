<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Save Offer in favorite table
     */
    public function saveJob(Request $request,$id)
    {
    	$jobId = Offer::find($id);
    	$jobId->favorites()->attach(auth()->user()->id);
    	return redirect()->back();
    }
    /**
     * Un Save Offer in favorite table
     */
    public function unSaveJob(Request $request,$id)
    {
    	$jobId = Offer::find($id);
    	$jobId->favorites()->detach(auth()->user()->id);
    	return redirect()->back();
    }


}
