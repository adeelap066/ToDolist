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
    
      <h1 class="text-center my-4 py-4">Welcome to ToDo List App</h1>
      <div class="w-50 m-auto">
        <form action="data.php" method="post" autocomplete="off">
                <label for="title">Task:</label>
                <input class="form-control" type="text" name="title" id="title" required placeholder="Enter task to add in todo"> <br>
                <button class="btn btn-success">Add to ToDo</button>
        </form>
      </div> <br>
      <hr class="bg-dark w-50 m-auto">
      
      <div class="w-50 m-auto">
        <h2 class="mb-3">Your Lists</h2>
        
        <div class="table-responsive">
          <table class="table table-dark table-bordered table-hover align-middle">
            <thead>
              <tr>
                <th scope="col" style="width: 10%;">S.no</th>
                <th scope="col" style="width: 60%;">Task</th>
                <th scope="col" style="width: 30%;" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include 'database.php';
              $sql = "SELECT * FROM todos";
              $result = mysqli_query($conn, $sql);
              
              if($result && mysqli_num_rows($result) > 0){
                $serial = 1; // S.no ke liye proper numbering
                while($row = mysqli_fetch_assoc($result)){
                  $id = $row['id'];
                  
                  // Database column ka naam chahe 'task', 'title' ya 'Title' ho, yeh khud detect kar lega
                  $title = '';
                  if(isset($row['task'])) {
                      $title = $row['task'];
                  } elseif(isset($row['title'])) {
                      $title = $row['title'];
                  } elseif(isset($row['Title'])) {
                      $title = $row['Title'];
                  }
              ?>
                <tr>
                  <td><?php echo $serial++; ?></td>
                  <td><?php echo htmlspecialchars($title); ?></td>
                  <td class="text-center">
                    <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-success btn-sm me-1">Edit</a>
                    <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
              <?php
                }
              } else {
                echo '<tr><td colspan="3" class="text-center">No tasks found!</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>