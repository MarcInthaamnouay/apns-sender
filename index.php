<?php 

namespace Vendor\Push;

require 'vendor/autoload.php';
include 'src/pushController.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


$config['displayErrorDetails'] = true;
$app = new \Slim\App(["settings" => $config]);

$app->post('/sendpush', function (Request $request, Response $response) {
    $push = new \Vendor\Push\Pushcontroller\Pushcontroller();
    $push->sendPush();

    return "";
});

$app->run();