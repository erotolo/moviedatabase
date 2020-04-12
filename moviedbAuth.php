<html>
<?php include 'includes/headandnav.php';?>

<?php
//start session
session_start();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/authentication/token/new?api_key=d12944ecb774ccf1bd9da3c023539eea", //creating a user autherisation token.
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
//sends error code if there is an error. if not, decodes the response in to JSON.

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $decodedResponse = json_decode($response);
  $requestToken = $decodedResponse->request_token;  //extracts the request token from the decoded response and sets it as a query.
$_SESSION["request_token"]= $requestToken; //saved the request token to the session so it can be accessed any time throughout the session.
}
?>

<div class="movieauth">

<div class="container">
<div class="row">
    <div class="col-lg-12 center-block">
<p>
  Click below to be redirected our external log in site.
</p>
</div>
</div>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-12 center-block">
<!---Link to the login page. URL contains redirect to account page -->
<a href="https://www.themoviedb.org/authenticate/<?=$requestToken;?>?redirect_to=http://localhost/other/moviedbAcc.php" ><button class="loginbutton">Log in </button></a>
</div>
</div>
</div>
</div>
</body>
</html>
