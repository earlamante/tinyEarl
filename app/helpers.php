<?php
function generate_salt()
{
    $path = base_path('.env');
    $key = config('app.base');
    while (strlen($key) > 32) {
        $key = str_split($key);
        unset($key[rand(0, count($key) - 1)]);
        $key = implode('', $key);
    }
    $key = str_shuffle($key);
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            'APP_SALT=', 'APP_SALT=' . $key, file_get_contents($path)
        ));
    }
}

function get_salt()
{
    return config('app.salt');
}

function get_filler()
{
    $base = config('app.base');
    $salt = str_split(get_salt());
    foreach($salt as $l) {
        $base = str_replace($l, '', $base);
    }
    return '-' . $base;
}

function idToString($id)
{
    $t = 0;
    $string = '';
    $id = str_split($id);
    $salt = str_split(get_salt());
    $filler = str_split(get_filler());
    foreach($id as $i) {
        $t += $i;
        $string .= $salt[$t % count($salt)];
    }
    while(strlen($string) < 8) {
        $i = rand(0,strlen($string));
        $string = substr($string, 0, $i) . $filler[rand(0,count($filler)-1)] . substr($string, $i);
    }
    return $string;
}

function stringToId($str)
{
    $i = $p = 0;
    $id = '';
    $str = preg_replace('#['.get_filler().']#', '', $str);
    $str = str_split($str);
    $salt = str_split(get_salt());
    $salt = array_flip($salt);
    foreach($str as $k) {
        if($i > $salt[$k]) {
            $i = (count($salt) - $p) + $salt[$k];
        } else {
            $i = $salt[$k] - $p;
        }
        $p = $salt[$k];
        $id .= $i;
    }
    return $id;
}
