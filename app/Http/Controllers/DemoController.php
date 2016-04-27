<?php
/**
 * Created by PhpStorm.
 * User: yantingting
 * Date: 15/9/9
 * Time: 下午3:52
 */
namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
   public function getPage(){
       $page = Input::get('url');
       $page = $page ? $page : 'app.exchange.medical';
       return view($page);
   }

    public function getMail () {

//        Mail::send($view, $data, function($message) use($email, $subject, $cc)
//        {
//            $message->to($email)
//                ->cc($cc)
//                ->subject($subject);
//        });

        $user = User::find(57);
        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->username)->subject('Your Reminder!');
        });
    }

}