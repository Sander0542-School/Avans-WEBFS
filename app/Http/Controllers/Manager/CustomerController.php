<?php

namespace App\Http\Controllers\Manager;

use App\Events\CustomerRequestCreated;
use App\Http\Controllers\Controller;
use App\Models\CustomerHelp;
use App\Models\CustomerHelpRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('request.create');
    }

    public function storeRequest(Request $request)
    {
        $customerRequest = new CustomerHelpRequest();
        $customerRequest->table_number = $request->table_number;
        $customerRequest->save();

         broadcast(new CustomerRequestCreated($customerRequest));
         event(new CustomerRequestCreated($customerRequest));

        return response()->json([
            'message' => 'New request created'
        ]);
    }
}
