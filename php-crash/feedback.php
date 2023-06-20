
<?php include 'inc/header.php'; ?>


<?php
$sql = 'SELECT * FROM reviews';
$result = mysqli_query($conn, $sql);
$feedback = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<head>
  <style>
    .card {
      display: flex;
      justify-content: space-between;
    }
    .colored-div {
      background-color: #ff0000;
      color: #ffffff;
      padding: 10px;
    }
    .h2-container {
      display: flex;
      flex-direction: row;
      margin-right: 10px;
      justify-content: space-between;
      font-size: 20pt;
    }
  
  </style>
</head>


   
  <h1>Movies</h1>

  <?php if (empty($feedback)): ?>
    <p class="lead mt-3">There is no feedback</p>
  <?php endif; ?>

  <?php foreach ($feedback as $item): ?>
    <div class="card my-3 w-75">
     <div class="card-body text-center">
       <?php echo $item['body']; ?>
      
       <div class="text-secondary mt-2"> 
      
        <div class="h2-container"> 
          <div> <?php echo $item['name']; ?> </div>
         <div class = "colored-div">  <?php echo $item['rating']; ?> </div>
  </div>
      </div>
     </div>
   </div>
  <?php endforeach; ?>
<?php include 'inc/footer.php'; ?>
