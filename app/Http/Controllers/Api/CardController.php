<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request) {
        try {
            $data = $request->post();
            $row = Card::create([
                'account_id' => $data['account_id'] ,
                'name' => $data['name'] ,
                'number' => $data['number'] ,
                'expiry' => $data['expiry'] ,
                'cvc' => $data['cvc'] ,
                'type' => $data['type']
            ]);
            return $row;
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->post();
            $row = Card::updateOrCreate(['id' => $id], $data);
            return $row;
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function destroy($id) {
        try {
            $row = Card::find($id);
            $row->delete();
            return response()->json(['message' => 'success']);
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function info($id) {
        try {
            return Card::where('account_id', '=', $id)->get();
        } catch(Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }
}
