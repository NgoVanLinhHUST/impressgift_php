<?php

define("BASE_URL", "http://localhost/impressgift");

function getRoleName($roleId)
{
    if ($roleId == 1) {
        return "ADMIN";
    }

    if ($roleId == 2) {
        return "MANAGER";
    }

    return null;
}

function getAdminUrl($controller, $action, $params = null)
{
    if (!empty($params)) {
        return BASE_URL . "/admin?controller=$controller&action=$action&param=$params";
    }

    return BASE_URL . "/admin?controller=$controller&action=$action";
}

function getAvatar($url)
{
    return '<img src="' . $url . '" width="100">';
}

function redirectUrl($url) {
    echo '<script>window.location.href = "' . $url . '";</script>';
    exit();
}

function getUrl($action, $params = null)
{
    if (!empty($params)) {
        return BASE_URL . "?action=$action&param=$params";
    }

    return BASE_URL . "?action=$action";
}