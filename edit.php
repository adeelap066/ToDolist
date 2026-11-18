<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ToDo List using PHP!</title>
    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
      <h1 class="text-center my-4 py-4">Update your ToDo List App</h1>
      
      <?php
      include 'database.php';
      
      $id = $_GET['id'];
      
      $sql = "SELECT * FROM todos WHERE id = $id";
      $result = mysqli_query($conn, $sql);

      if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        
        $title = '';
        if(isset($row['task'])) {
            $title = $row['task'];
        } elseif(isset($row['title'])) {
            $title = $row['title'];
        } elseif(isset($row['Title'])) {
            $title = $row['Title'];
        }
      }
      ?>

      <div class="w-50 m-auto">
        <!-- Action ko update_process ki bajaye editaction.php kar diya hai -->
        <form action="editaction.php" method="post" autocomplete="off">
                <label for="title" class="form-label">Update Task:</label>
                
                <!-- Hidden input for passing ID -->
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                
                <!-- Value attribute to show existing task -->
                <input class="form-control mb-3" type="text" name="title" id="title" required value="<?php echo htmlspecialchars($title); ?>" placeholder="Update your Todo list">
                
                <button type="submit" name="update" class="btn btn-success">Update ToDo</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>