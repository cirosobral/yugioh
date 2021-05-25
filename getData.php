<?php

$api_url = 'https://db.ygoprodeck.com/api/v7/cardinfo.php';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data->data;

?>
<pre>
<?php var_dump($user_data) ?>
</pre>
<?php

// // Cut long data into small & select only first 10 records
// $user_data = array_slice($user_data, 0, 9);

// // Print data if need to debug
// //print_r($user_data);

// // Traverse array and display user data
// foreach ($user_data as $user) {
// 	echo "name: ".$user->employee_name;
// 	echo "<br />";
// 	echo "name: ".$user->employee_age;
// 	echo "<br /> <br />";
// }