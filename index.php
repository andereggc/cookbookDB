<?php 

    include('dbConnect.php');

    // write query for all meals
    $sql = 'SELECT title, ingredients, id FROM meals ORDER BY createdAt';

    // make query and get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // free result from memory and close connection
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php')?>

    <h4 class="center black-text"> <strong> Delicious Meals!</strong></h4>
 
    <div class="container gold z-depth-4 border">
        <div class="row">
      
        <?php foreach($meals as $meal): ?>
            <!--creates info about meal which is displayed on home page
            
            htmlspecialchars prevents XSS attacks
            --> 
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center z-depth-2 border">
                        <h6><strong><?php echo htmlspecialchars($meal['title']); ?></strong></h6>
                        <ul>
                            <?php foreach(explode(',', $meal['ingredients']) as $ing): ?>
                                <li><?php echo htmlspecialchars($ing) ?> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action center-align lighten-4 teal z-depth-2 border">
                        <a class="btn" href="details.php?id=<?php echo $meal['id']?>">more info</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        </div>
    
    </div>
    
    <?php include('templates/footer.php')?> 


</html>