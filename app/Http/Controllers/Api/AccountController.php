<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use App\Models\Card;
use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use LaravelMandrill;
// use Monolog\Handler\SwiftMailerHandler;
// require_once('../../../../vendor/swiftmailer/swiftmailer/lib/swift_required.php');

class AccountController extends Controller
{
    public function register(Request $request) {
        try {
            $data = $request->post();
            $user = Account::create([
                'email' => $data['email'],
                'remember_token' => Str::random(100)
            ]);

            var_dump(Mail::send('welcome', [], function ($message){
                $message->to('sereda.free@gmail.com')->subject('Expertphp.in - Testing mail');
            }));

            // $subject = 'Hello from Mandrill, PHP!';
            // // approved domains only!
            // $from = array('brenton@upark.co.za' =>'Your Name');
            // $to = array(
            //  'sereda.free@gmail.com'  => 'Recipient1 Name'
            // );

            // $text = "Mandrill speaks plaintext";
            // $html = "Mandrill speaks HTML";

            // $transport = \Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
            // $transport->setUsername(getenv('MAIL_USERNAME'));
            // $transport->setPassword(getenv('MAIL_PASSWORD'));
            // $swift = \Swift_Mailer::newInstance($transport);

            // $message = new \Swift_Message($subject);
            // $message->setFrom($from);
            // $message->setBody($html, 'text/html');
            // $message->setTo($to);
            // $message->addPart($text, 'text/plain');
            // if (!$swift->send($message, $failures))
            // {
            //     echo "Failures:";
            //     print_r($failures);
            // }
            return ($user);
        } catch (Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function update(Request $request) {
        try {
            $data = $request->post();
            $row = Account::find($data['account_id']);
            $row->recovery_email = $data['recovery_email'];
            $row->save();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function destroy($id) {
        try {
            Account::where('id', '=', $id)->delete();
            Card::where('account_id', '=', $id)->delete();
            Vehicle::where('account_id', '=', $id)->delete();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function info($id) {
        try {
            return Account::where('id', '=', $id)->get();
        } catch (Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }

    public function all($id) {
        try {
            $user = Account::where('id', '=', $id)->get();
            $card = Card::where('account_id', '=', $id)->get();
            $vehicle = Vehicle::where('account_id', '=', $id)->get();
            return response()->json(['user'=>$user, 'card'=>$card, 'vehicle'=>$vehicle]);
        } catch (Exception $e) {
            return response()->json(['message' => 'error']);
        }
    }
}
