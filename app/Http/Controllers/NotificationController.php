<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function refresh(){
        //kirim notifikasi buat event besok
        $currentTime = \Carbon\Carbon::now();
        $besok = $currentTime->addDays(1);

        $event = Event::whereDate('date',$besok)->get();
        $user = User::where('is_admin', 0)->get();
        foreach ($event as $key => $value) {
            foreach ($user as $k => $v) {
                $token   = $v->fcm_token;
                $message = $value->name . " tempatnya di  " . $value->tempat;
                $title   = "Ingat besok ada event ";
        
                $res = array();
                $res['body']  = $message;
                $res['title'] = $title;
        
                $fields = array(
                    'to' => $token,
                    'notification' => $res,
                );
        
                $url = 'https://fcm.googleapis.com/fcm/send';
                $server_key = "AAAAyIARueE:APA91bESHJEzzhUNcnUc2SNTeBim6L9HJDi6Ts4cflvuAcuY5PTlSJZtgmxmM56YUJpS_lyy3QRx6D0CPP5fJ4miMLz5W8-jacz_16EAojkVufqNtGbKov6rQfeyrLi9kQDxloVYEQtB";
        
                $headers = array(
                    'Authorization: key=' . $server_key,
                    'Content-Type: application/json'
                );
                // Open connection
                $ch = curl_init();
        
                // Set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
        
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
                // Execute post
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    echo 'Curl failed: ' . curl_error($ch);
                }
        
                // Close connection
                curl_close($ch);
            }
        }


        //kirim notifikasi buat event sekarang
        $currentTime = \Carbon\Carbon::now();

        $event2 = Event::whereDate('date',$currentTime)->get();
 
        $user = User::where('is_admin', 0)->get();
        foreach ($event2 as $key => $value) {
            foreach ($user as $k => $v) {
                $token   = $v->fcm_token;
                $message = $value->name . " tempatnya di " . $value->tempat;
                $title   = "Hai.. Ada event hari ini ";
        
                $res = array();
                $res['body']  = $message;
                $res['title'] = $title;
        
                $fields = array(
                    'to' => $token,
                    'notification' => $res,
                );
        
                $url = 'https://fcm.googleapis.com/fcm/send';
                $server_key = "AAAAyIARueE:APA91bESHJEzzhUNcnUc2SNTeBim6L9HJDi6Ts4cflvuAcuY5PTlSJZtgmxmM56YUJpS_lyy3QRx6D0CPP5fJ4miMLz5W8-jacz_16EAojkVufqNtGbKov6rQfeyrLi9kQDxloVYEQtB";
        
                $headers = array(
                    'Authorization: key=' . $server_key,
                    'Content-Type: application/json'
                );
                // Open connection
                $ch = curl_init();
        
                // Set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
        
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                // Disabling SSL Certificate support temporarly
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        
                // Execute post
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    echo 'Curl failed: ' . curl_error($ch);
                }
        
                // Close connection
                curl_close($ch);
            }
        }


    }

    
}
