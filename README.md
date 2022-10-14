You can do something like that (only to round down) :

$n1 = 1439;
$n2 = 1399;

$round1 =  $n1 -  $n1 % 50; // round1 = 1439 - 39 = 1400
$round2 =  $n2 - $n2 % 50; // round2 = 1399 - 49 = 1350

To round up, you can do this :

$n1 = 1439;
$n2 = 1399;

$round1 =  $n1 + (50 -  $n1 % 50); // round1 = 1439 + (50 - 39) = 1450
$round2 =  $n2 + (50 - $n2 % 50); // round2 = 1399 + (50 - 49) = 1400

