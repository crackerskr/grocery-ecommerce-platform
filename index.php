<?php
	$conn = mysqli_connect("localhost","root","","lmeo_db");

	if($conn === false){
		die ("mysql is not connected");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage | Grocery LMEO</title>
	<link rel="stylesheet" href="style/style.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	<!-- Page Content -->
	<div class="top-container">
		<!--SlideShow-->
		<div class="mySlides slide-container">
			<img src="images/background.png" alt="Picture not exist.">
		</div>
	
		<div class="mySlides slide-container">
			<img src="images/highquality.png" alt="Picture not exist.">
		</div>

		<div class="mySlides slide-container">
			<img src="images/affordable.png" alt="Picture not exist.">
		</div>

		<div class="mySlides slide-container">
			<img src="images/delivery.png" alt="Picture not exist.">	
		</div>

		<div class="mySlides slide-container">
			<img src="images/trained.png" alt="Picture not exist.">
		</div> 
		
	</div>

	<!-- Navigation Bar -->
	<?php include('consist/navigation.php');?>
	
	<!-- Homepage --> 
	<div class="homepage-container">
		<h1>Grocery LMEO's favourites</h1>
		<?php
			$query = 'SELECT * FROM products LIMIT 8';
			$result = mysqli_query($conn, $query);
			
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_assoc($result)){
						echo "<div class='homepage-containercol'>";
							echo "<img src='images/".$row["image"]."' alt='".$row["name"]."'>";
							echo "<h2>".$row["name"]."</h2>";
							echo "<h3><span>RM</span>".$row["price"]."</h3>";
						echo "</div>";
				}
			}
			else{
				echo "No products found<br>";
			}
			mysqli_close($conn);	
		?>
	</div>

	<div class ="buttonproduct-container">
		<a href="products"><button class="content-button">See More Products</button></a>
	</div>
	
	<!-- Footer -->
	<?php include('consist/footer.php');?>

<script>
// Automatic Slideshow - change image every 4 seconds
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000);    
}

// When the user clicks anywhere outside of the modal, close it
var modal = document.getElementById('ticketModal');
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>