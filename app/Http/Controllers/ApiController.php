<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function register (Request $request){
        $postData = $request->post();
        $data = array(
            'email' => $postData['email']
        );
        $row = DB::table('accounts')->where('email', '=', $data['email'])->first();
        $id;
        $remember_token = '';
        if (is_null($row)) {
            $id = DB::table('accounts')->insertGetId($data);
            $remember_token = hash('ripemd160', date('Y-m-d H:i:s').$id);
        }else {
            $id = $row->id;
            $remember_token = hash('ripemd160', date('Y-m-d H:i:s').$id);
        }

        $result = DB::table('accounts')->where('id', $id)->update(['remember_token' => $remember_token]);
        return json_encode(array('id'=>$id, 'token'=>$remember_token));
    }

    public function destroy(Request $request, $id) {
        try{
            DB::table('accounts')->where('id', '=', $id)->delete();
            DB::table('cards')->where('account_id', '=', $id)->delete();
            DB::table('vechicles')->where('account_id', '=', $id)->delete();
        }catch(Exception $e){
            return json_encode(array("ERROR"));
        }
        return json_encode(array("SUCCESS"));
    }

    public function card_store(Request $request) {
        $postData = $request->post();
        $data = array(
            'account_id' => $postData['account_id'],
            'name' => $postData['name'],
            'number' => $postData['number'],
            'expiry' => $postData['expiry'],
            'cvc' => $postData['cvc'],
            'type' => $postData['type']
        );
        $result = DB::table('cards')->insertGetId($data);
        // $this->account_details($postData['account_id'])
        return $result;
    }

    public function card_update(Request $request, $id){
        $data = $request->post();
        $result = DB::table('cards')
              ->where('id', $id)
              ->update($data);
        return $result;
    }

    public function card_destroy(Request $request, $id){
        $result = DB::table('cards')->where('id', '=', $id)->delete();
        return $result;
    }

    public function vechicle_store(Request $request) {
        $postData = $request->post();
        $data = array(
            'account_id' => $postData['account_id'],
            'name' => $postData['name'],
            'registration_number' => $postData['registration_number']
        );
        $result = DB::table('vechicles')->insertGetId($data);
        return $result;
    }

    public function vechicle_update(Request $request, $id){
        $data = $request->post();
        $result = DB::table('vechicles')
              ->where('id', $id)
              ->update($data);
        return $result;
    }

    public function delete_vechicle(Request $request){
        $data = $request->post();
        $result = DB::table('vechicles')->where('id', '=', $data['id'])->delete();
        return $result;
    }

    public function account_details(Request $request, $id){
        $vechicle_info = DB::table('vechicles')->where('account_id', '=', $id)->get()->toArray();
        $card_info = DB::table('cards')->where('account_id', '=', $id)->get();
        return json_encode(array("vechicle_info"=>$vechicle_info, "card_info"=>$card_info));
    }
}
