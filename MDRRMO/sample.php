<?php
$ch = curl_init();
$parameters = array(
    'apikey' => '77ed3208e811e69323cbbc15c9bcb84f',
    'number' => '09569435938',
    'message' => 'fyhgsfgduhasldiugasdi',
    'sendername' => 'NMDRRMO'
);
curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
curl_setopt( $ch, CURLOPT_POST, 1 );

//Send the parameters set above with the request
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

// Receive response from server
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close ($ch);

//Show the server response
echo $output;
// require_once'vendor/autoload.php';

//     use Semaphore\SemaphoreClient;
//     $client = new SemaphoreClient( '{77ed3208e811e69323cbbc15c9bcb84f}' ); //Sender Name defaults to SEMAPHORE
//     echo $client->send( '09569435938', 'Your message' );
?>