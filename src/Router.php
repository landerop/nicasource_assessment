<?php
/**
 * Created by Luis Landero.
 */

class Router
{
    /**
     * It processes the request, given a valid url
     * @return array
     */
    protected function getRequest()
    {
        $serverRequest = explode("/", $_SERVER['REQUEST_URI']);
        if($_SERVER['REQUEST_URI'] == '/' || ($serverRequest[1] == 'comic' && is_numeric($serverRequest[2]))) {
            return $serverRequest;
        } else {
            header('Location: /src/templates/404.html');
            exit;
        }
    }
}