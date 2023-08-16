<?php
require_once '/path/to/vendor/autoload.php';

$sid = getenv("TWILIO_ACCOUNT_SID");
$token = getenv("TWILIO_AUTH_TOKEN");
$twilio = new Client(\$sid, \$token);

$message = \$twilio->messages
                  ->create("+639569435938", // to
                           ["body" => "Hi there", "from" => "+15017122661"]
                  );

print(\$message->sid);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SAMPLE</title>
</head>
<body>

</body>
</html>