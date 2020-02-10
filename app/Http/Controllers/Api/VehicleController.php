<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function store(Request $request) {
        try {
            $data = $request->post();
            $row = Vehicle::create([
                'account_id' => $data['account_id'] ,
                'name' => $data['name'] ,
                'number' => $data['number']
            ]);
            return $row;
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->post();
            $row = Vehicle::updateOrCreate(['id' => $id], $data);
            return $row;
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function info($id) {
        try {
            return Vehicle::where('account_id', '=', $id)->get();
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }
}
