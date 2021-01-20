<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function test(){

        $topic = "all";
        $recipients = [
            'clKMv.......',
            'GxQQW.......',
        ];
        
        $send = fcm()
            ->toTopic($topic) // $topic must an string (topic name)
            ->priority('high')
            ->timeToLive(0)
            ->data([
                'title' => 'Test Data FCM',
                'body' => 'This is a Data of FCM',
            ])
            ->notification([
                'title' => 'Test Notif FCM',
                'body' => 'This is a Notification test of FCM',
            ])
            ->send();

            dd($send);
            
    }
}
