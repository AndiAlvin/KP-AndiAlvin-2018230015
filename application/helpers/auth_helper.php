<?php
defined('BASEPATH') or die('No direct script access allowed!');

function is_login($is_true = false)
{
    $CI = &get_instance();
    if (!@$CI->session->is_login && !$is_true) {
        redirect('login');
    } elseif ($CI->session->is_login && $is_true) {
        redirect('dashboard');
    }

    return;
}

function is_level($keterangan)
{
    $CI = &get_instance();
    if ($CI->session->keterangan == $keterangan) {
        return true;
    }

    return false;
}

function redirect_if_level_not($keterangan)
{
    $CI = &get_instance();
    $is_match = false;
    if (is_array($keterangan)) {
        if (in_array($CI->session->keterangan, $keterangan)) {
            $is_match = true;
        }
    } else {
        $is_match = is_level($keterangan);
    }

    if (!$is_match) {
        return redirect('dashboard/');
    }

    return;
}
