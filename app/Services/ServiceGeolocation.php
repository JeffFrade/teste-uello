<?php

namespace App\Services;


class ServiceGeolocation
{
    public function getCoordinates(string $address)
    {
        $ch = curl_init();

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&key=".env('GOOGLE_API_KEY', ' ');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $post = array(
            "file" => "@" .realpath("test.json")
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_POST, 1);

        $json = '{}';
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $headers = array();
        $headers[] = "Content-Type: application/json";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close ($ch);

        return $result;
    }
}