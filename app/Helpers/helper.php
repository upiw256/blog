<?php

function generateToken()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $token = '';
    for ($i = 0; $i < 6; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $token;
}