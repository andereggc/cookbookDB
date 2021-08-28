<?php 

	include('dbConnect.php');

	if(isset($_POST['delete'])){
		//mysqli_real_escape_string prevents SQL injection
		$idToDelete = mysqli_real_escape_string($conn, $_POST['idToDelete']);

		$sql = "DELETE FROM meals WHERE id = $idToDelete";

		if(mysqli_query($conn, $sql)){
            // success
			header('Location: index.php');
		} else {
            // failure
			echo 'query error: ' . mysqli_error($conn);
		}

	}

	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM meals WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$meal = mysqli_fetch_assoc($result);
		// free result from memory and close connection
		mysqli_free_result($result);
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>
	<form class="white formDetails lightBlue" method="POST">
	<div class="container center">
		<!--details of the individual meal
		
		htmlspecialchars prevents XSS attacks
		-->
		<?php if($meal): ?> 
			<h4><?php echo htmlspecialchars($meal['title']); ?></h4>
			<p>Created by: <?php echo htmlspecialchars($meal['email']); ?></p>
			<p><?php echo date($meal['createdAt']); ?></p>
			<h5>Ingredients:</h5>
			<p><?php echo htmlspecialchars($meal['ingredients']); ?></p>

            <!-- DELETE FORM -->
            <form action="details.php" method="POST">
				<input type="hidden" name="idToDelete" value="<?php echo $meal['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No such meal exists.</h5>
		<?php endif ?>
	</div>
	</form>

	<?php include('templates/footer.php'); ?>

</html>