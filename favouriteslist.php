<html>
<head>
<?php include 'includes/headandnav.php';?>

    <?php
session_start(); //Start session

$curl = curl_init();
$AccId = $_SESSION["id"];
        $sessionId= $_SESSION["sessionId"]; //calls in sessionID info and renames it from 'id' to 'sesisonID' to avoid naming conflicts.
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/account/$AccId/favorite/movies?page=1&sort_by=created_at.asc&language=en-US&session_id=$sessionId&api_key=d12944ecb774ccf1bd9da3c023539eea",
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
}

?>

  <div class="favouritestitle">
      <h2>My Favourites</h2>
    </div>


<div class="searchresults">

  <?php
  foreach ($decodedResponse->results as $decodedResponse) {
  ?>

<!--Film results and link to film information pages. -->
    <tr><td> <a href="filminfo.php?id=<?= $decodedResponse->id;?>"> <img class="img-fluid" src= "https://image.tmdb.org/t/p/w500<?= $decodedResponse->poster_path;?>" > </a> </td></tr>


  <?php
  }
  ?>

</div>



    <!-- JQuery for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
