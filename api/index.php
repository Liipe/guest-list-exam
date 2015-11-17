<?php
require 'vendor/autoload.php';
require 'database/ConectionFactory.php';
require 'guests/GuestService.php';


$app = new \Slim\Slim();


$app->post('/api/guests/', function() use ( $app ) {
    $guestJson = $app->request()->getBody();
    $newGuest = json_decode($guestJson, true);
    if($newGuest) {
        $guest = GuestService::add($newGuest);
        echo "Guest {$guest['name']} added";
    }
});


$app->get('/api/guests/', function() use ( $app ) {
    $guests = GuestService::listGuests();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($guests);
});

$app->delete('/api/guests/:id', function($id) use ( $app ) {
    if(GuestService::delete($id)) {
      echo "Guest deleted";
    }
    else {
      $app->response->setStatus('404');
      echo "Guest with id = $id does not exist";
    }
});

$app->run();
?>