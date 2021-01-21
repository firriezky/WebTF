<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Facades\FCM as FacadesFCM;
use LaravelFCM\Message\Topics;

class NotificationController extends Controller
{
    public function test(){

        $topic = "all";

        $notificationBuilder = new PayloadNotificationBuilder('Henry Ganteng');
        $notificationBuilder->setBody('Seorang hafidz selalu berinteraksi dengan al-Quran, memperbanyak shalat sunnah (terutama shalat malam) untuk mengulangi bacaan. Dengan demikian, saat ia mulai menghafal al-Quran, maka sejatinya gaya hidupnya juga telah berubah menjadi lebih Islami.')
                            ->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('all');

        $topicResponse = FacadesFCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();
    }


    public function sendFromOutside($title,$body,Request $request){

        dd($request->all());
        
        $topic = "all";

        $notificationBuilder = new PayloadNotificationBuilder("$title");
        $notificationBuilder->setBody("$body")
                            ->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('all');

        $topicResponse = FacadesFCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();

        return $topicResponse->isSuccess();
    }
}
