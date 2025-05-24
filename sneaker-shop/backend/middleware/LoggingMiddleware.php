<?php

Flight::before('start', function(&$params, &$output){
    error_log("Request to: " . Flight::request()->url);
});