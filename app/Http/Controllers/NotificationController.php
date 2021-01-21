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

    public function broadcast(){
        return view('admin.notification.broadcast');
    }

    public function sendBroadcast(Request $request){

        $title = $request->title ;
        $content = $request->content;
        $topic = $request->topic;
        
        $notificationBuilder = new PayloadNotificationBuilder("$title");
        $notificationBuilder->setBody("$content")
                            ->setSound('default');

        $notification = $notificationBuilder->build();

        $topic = new Topics();

        //Dont change this switch case into usual string literall
        // like $topic->topic($request->topic) it will trigger an error
        // i was minding about that too -NRY

        switch ($topic) {
            case 'student':
                $topic->topic("student");
                break;
            case 'teacher':
                $topic->topic("teacher");
                break;
            default:
                $topic->topic("all");
                break;
        }

        $topicResponse = FacadesFCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();

        if ($topicResponse->isSuccess()==1) {
            return redirect('admin/notification/broadcast')->with(['success' => "Berhasil Mengirim Push Notification"]);
        }else{
            return redirect('admin/notification/broadcast')->with(['error' => "Gagal Mengirim Push Notification"]);

        }
    }

    public function test(){

        $topic = "all";

        $notificationBuilder = new PayloadNotificationBuilder('Henry Ganteng');
        $notificationBuilder->setBody('Test')
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
