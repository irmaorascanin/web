<?php

Flight::map('error', function(Exception $ex){
    Flight::json(["error" => $ex->getMessage()], $ex->getCode() ?: 500);
});