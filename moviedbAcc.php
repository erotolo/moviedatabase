<html>
<?php include 'includes/headandnav.php';?>
<?php
session_start(); //Start session
$requestToken= $_SESSION["request_token"] ; //calls in the request token from the session - allows new session to start.

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/authentication/session/new?api_key=d12944ecb774ccf1bd9da3c023539eea",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST", //post request instead of GET.
  CURLOPT_POSTFIELDS => "request_token=" . $requestToken, //postfields takes out the request token from the authentication call in moviedbAuth.php.
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 $response;
  $decodedResponse = json_decode($response);
  $sessionId = $decodedResponse->session_id;  //decoded JSON response extracting the session ID.
   $sessionId;
     $_SESSION["sessionId"]= $sessionId; //session ID saved to session

}



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/account?session_id=1&api_key=d12944ecb774ccf1bd9da3c023539eea&session_id=$sessionId", //session ID added to url
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

//echo JSON decoded response
if ($err) {
  echo "cURL Error #:" . $err;
} else {
$response;
$decodedResponse = json_decode($response);
    $_SESSION["id"]= $decodedResponse->id; //saves user "id" to the session.
}
?>
<div class="favouritestitle">
    <h2>My Account</h2>
  </div>
<div class="content">
<div class="container">
<div class="row">
    <div class="col-lg">
      <div class="Account Details">
<p>
<b>Name:</b> <?= $decodedResponse->name;?>
</p>
<p>
<b>User name:</b> <?= $decodedResponse->username;?>
</p>
<p>
<b>User ID:</b> <?= $decodedResponse->id;?>
</p>
</div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>
