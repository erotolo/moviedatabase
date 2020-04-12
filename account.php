<html>
<?php include 'includes/headandnav.php';?>
<?php
session_start(); //Start session
$curl = curl_init();
$AccId = $_SESSION["id"];
        $sessionId= $_SESSION["sessionId"]; //calls in sessionID info and renames it from 'id' to 'sesisonID' to avoid naming conflicts.
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/account?session_id=$sessionId&api_key=d12944ecb774ccf1bd9da3c023539eea",
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

if ($err) {
  echo "cURL Error #:" . $err;
} else {
$response;
  $decodedResponse = json_decode($response);
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
        <!--Below calls in the basic information that is available from the API.
         At this current time, account avatars are not available on the API -->
<p>
<b>Name:</b> <?= $decodedResponse->name;?>
</p>
<p>
<b>User name:</b> <?= $decodedResponse->username;?>
</p>
<p>
<b>User ID</b> <?= $decodedResponse->id;?>
</p>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- JQuery for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>
