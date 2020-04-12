<html>
<?php include 'includes/headandnav.php';?>

    <!-- SEARCH BAR -->
<div class="searchbar">
<div class="container">
    <div class="row">
        <div class="col-lg-12 center-block">

<form action="" method="post">
     <input type="text" name="keyword"/>
   <input type="submit" value="search"/>
</form>
</div>
</div>
</div>
</div>

<?php
    session_start(); //Start session
// using curl to make the Rest request
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
// $query holds the parameters

$keyword="";
if(isset($_POST['keyword']))
{
    $keyword= $_POST['keyword'];


$query = array(
  "api_key" => "d12944ecb774ccf1bd9da3c023539eea",
  "query" => $keyword
);


// Make the REST request
curl_setopt($curl, CURLOPT_URL,
 "http://api.themoviedb.org/3/search/movie" . "?" . http_build_query($query)
);
$result = json_decode(curl_exec($curl));

$url = "http://api.themoviedb.org/3/search/movie" . "?" . http_build_query($query);

?>


<div class="searchresults">


  <?php
  foreach ($result->results as $film) {
  ?>
<!--Film results and link to film information pages. -->
    <tr><td> <a href="filminfo.php?id=<?= $film->id;?>"> <img class="img-fluid" src= "https://image.tmdb.org/t/p/w500<?= $film->poster_path;?>" > </a> </td></tr>

  <?php
  }
  ?>


</div>

<?php
}
    ?>

    <!-- JQuery for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
