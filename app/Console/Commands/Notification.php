<?php
 
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use App\Event;
use App\User;
 
class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notification:check';
 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cronjob untun mengirim pengingat event kepada user';
 
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
          //kirim notifikasi buat event besok
        $currentTime = \Carbon\Carbon::now();
        $besok = $currentTime->addDays(1);

        $events = Event::whereDate('date',$besok)->get();
        $user = User::where('is_admin', 0)->get();
        foreach ($events as $key => $value) {
            // foreach ($user as $k => $v) {
                $token   = '/topics/events';
                $message = $value->name . " Lokasi " . $value->tempat;
                $title   = "Event besok";
        
                $res = array();
                $res['body']  = $message;
                $res['title'] = $title;
        
                $resdata = array();
                $resdata['body']  = $message;
                $resdata['title'] = $title;
                $resdata['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
        
                $fields = array(
                    'to' => $token,
                    'notification' => $res,
                    'data' => $resdata,
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
            // }
        }


        //kirim notifikasi buat event sekarang
        $currentTime = \Carbon\Carbon::now();

        $event = Event::whereDate('date',$currentTime)->get();
        $user = User::where('is_admin', 0)->get();
        foreach ($event as $key => $value) {
            //  foreach ($user as $k => $v) {
                $token   = '/topics/events';
                $message = $value->name . " Lokasi " . $value->tempat;
                $title   = "Event Hari Ini";
        
                $res = array();
                $res['body']  = $message;
                $res['title'] = $title;
                
                $resdata = array();
                $resdata['body']  = $message;
                $resdata['title'] = $title;
                $resdata['click_action'] = 'FLUTTER_NOTIFICATION_CLICK';
        
                $fields = array(
                    'to' => $token,
                    'notification' => $res,
                    'data' => $resdata,
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
            // }
        }
    }
}