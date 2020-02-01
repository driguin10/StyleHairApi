<?php

class enviaNotification
{

    public function EnviarNotificacao($title, $body, $salao, $data, $to)
    {
        define('API_ACCESS_KEY', 'AAAAnzTOKs8:APA91bFZ1fSBTifV40epf-sRpLrH8woY-ZgVWCHFcvHnokfbP3HSt8lUj2AXc0KkHEn3jfV1_SlhCzjTurAp6wbsDJhOjnsMNAFg5UrRuel0nJuJEPdgcaxgo20OPxMdWgKqcq3O0s5t');

        $msg = array(
            'body' => $body,
            'title' => $title,
        );

        $atrib = array(
            'salao' => $salao,
            'data' => $data,
        );

        $fields = array(
            'to' => '/topics/' . $to,
            'notification' => $msg,
            'data' => $atrib,
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        echo $result;
        curl_close($ch);
    }
}
