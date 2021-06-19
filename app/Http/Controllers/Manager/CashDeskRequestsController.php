<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\CustomerHelpRequest;
use Illuminate\Http\Request;

class CashDeskRequestsController extends Controller
{
    public function confirm(Request $request){

        $assistance = CustomerHelpRequest::findOrFail($request->input('id'));
        $assistance->confirmed = true;
        $assistance->save();

        return redirect()->back();

    }
}
