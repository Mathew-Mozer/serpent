<?php

/**
 * Created by PhpStorm.
 * User: Mathew
 * Date: 11/23/2016
 * Time: 10:39 PM
 */
class SlackTool
{
    public static function slack($message, $channel,$username)
    {
        $ch = curl_init("https://slack.com/api/chat.postMessage");
        $data = http_build_query([
            "token" => "xoxp-24708883863-24708447296-108728953892-0c6c234f8c52c9a2e6a4d1976f2f4e92",
            "channel" => $channel, //"#mychannel",
            "text" => $message, //"Hello, Foo-Bar channel message.",
            "username" => $username,
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}