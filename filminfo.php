<head>
<?php include 'includes/headandnav.php';?>

    <!--GET request to call in film information -->
<?php
session_start(); //Start session

$curl = curl_init();
$id =$_GET['id'];
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id?language=en-US&api_key=d12944ecb774ccf1bd9da3c023539eea",
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




//add to favourites
    if(isset($_GET['fav'])) //if URL has 'fav' in it run the below code, if not, do nothing.
    if($_GET['fav']== 1){

$curl = curl_init();
$AccId = $_SESSION["id"];
        $sessionId= $_SESSION["sessionId"];  //calls in sessionID info and renames it from 'id' to 'sesisonID' to avoid naming conflicts.
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/account/$AccId/favorite?session_id=$sessionId&api_key=d12944ecb774ccf1bd9da3c023539eea", //calling in session and accound id into URL
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"media_type\":\"movie\",\"media_id\":$id,\"favorite\":true}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json;charset=utf-8"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

    }
//remove from favourites - the same as add but changing the url query and setting 'true' in postfields to 'false'
    if(isset($_GET['unfav']))
    if($_GET['unfav']== 1){

$curl = curl_init();
$AccId = $_SESSION["id"];
        $sessionId= $_SESSION["sessionId"];
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/account/$AccId/favorite?session_id=$sessionId&api_key=d12944ecb774ccf1bd9da3c023539eea",//calling in session and accound id into URL
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"media_type\":\"movie\",\"media_id\":$id,\"favorite\":false}", //changed to false to remove from list.
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json;charset=utf-8"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

    }
    ?>






<!-- prints out the title and background image url from the json response. Also calling in film information. -->

<div class="parallax" style="background-image:url(https://image.tmdb.org/t/p/w1280<?= $decodedResponse->backdrop_path;?>);">
  <div class="parallaxtitle">
    <h2><?= $decodedResponse->original_title;?></h2>
  </div>
 </div>

<div class="content">
<div class="container">
<div class="row">
    <div class="col-lg">
      <div class=" filmposter">
<img class="img-fluid" src= "https://image.tmdb.org/t/p/w500<?= $decodedResponse->poster_path;?>" >
</div>
</div>

  <div class="col-lg ">
<div class="filmtitle">
  <h2><?= $decodedResponse->original_title;?></h2>

</div>
<div class="filmdesc">
  <p><i> <?= $decodedResponse->tagline;?></i></p>
</div>
<div class="filmdesc">
  <p><b>Description: </b><?= $decodedResponse->overview;?></p>
</div>
<div class="filmrating">
    <table class="table">
<thead>
  <th colspan="3">
      <b>Popularity:</b> <?= $decodedResponse->popularity;?>
  </th>
  <th colspan="3">
  <i class="fas fa-star"></i> <?= $decodedResponse->vote_average;?>
  </th>
  </thead>
</table>
</div>

<table class="table2">
<thead>
<th colspan="3">
      <div id="addfave">
        <p><a href="filminfo.php?id=<?=$id;?>&fav=1"> <i class="fas fa-heart"></i></p> <!--URL adds in 'fav=1' into url to run the 'add to favourites' code.-->
         <p>Add to favourites</p></a>
       </div>
</th>
<th colspan="3">
       <div id="removefave">
     <p><a href="filminfo.php?id=<?=$id;?>&unfav=1"> <i class="fas fa-heart-broken"></i></p><!--URL adds in 'unfav=1' into url to run the 'remove from favourites' code.-->
          <p>Remove from favourites</p></a>
        </div>
      </th>
</ul>
</div>
</div>
</div>
</div>


    <!-- JQuery for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
