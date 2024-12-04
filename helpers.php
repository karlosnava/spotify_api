<?php
error_reporting(0);
ini_set('session.cookie_lifetime', 3500);
ini_set('session.gc_maxlifetime', 3500);
session_start();

function checkToken()
{
    if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
        return true;
    }
    return false;
}

function getToken()
{
    $client_id = "3edc28c4a8d94e1e97005146e478aac3";
    $client_secret = "769b8cc1f37543dfbcb68d58369fb5d1";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('grant_type' => 'client_credentials')));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . base64_encode($client_id . ":" . $client_secret)));

    $response = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    if (isset($response['access_token'])) {
        $_SESSION['token'] = $response['access_token'];
    }

    header("Location ./");
}

if (!checkToken()) {
    return getToken();
}

// ---------

function search($type, $q)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?type={$type}&q={$q}&limit=10");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer {$_SESSION['token']}"));

    $response = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    if (isset($response['error']['status']) && $response['error']['status'] === 401) {
        return getToken();
    }

    return $response;
}

function getAlbum($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/{$id}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer {$_SESSION['token']}"));

    $response = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    if (isset($response['error']['status']) && $response['error']['status'] === 401) {
        return getToken();
    }

    return $response;
}

function getArtist($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/{$id}");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer {$_SESSION['token']}"));

    $response = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    if (isset($response['error']['status']) && $response['error']['status'] === 401) {
        return getToken();
    }

    return $response;
}

function getArtistAlbums($id)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/{$id}/albums");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer {$_SESSION['token']}"));

    $response = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    
    if (isset($response['error']['status']) && $response['error']['status'] === 401) {
        return getToken();
    }

    return $response;
}

function getNewReleases()
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/browse/new-releases?limit=10');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer {$_SESSION['token']}"));

    $response = json_decode(curl_exec($ch), true);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    if (isset($response['error']['status']) && $response['error']['status'] === 401) {
        return getToken();
    }
    
    return $response;
}
