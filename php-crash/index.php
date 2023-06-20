<?php include 'inc/header.php'; ?>

<?php
// Set vars to empty values
$name = $email = $body = '';
$nameErr = $emailErr = $bodyErr = '';

// Form submit
if (isset($_POST['submit'])) {
  // Validate name
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(
      INPUT_POST,
      'name',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  // Validate body
  if (empty($_POST['review'])) {
    $bodyErr = 'review is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_input(
      INPUT_POST,
      'review',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate rating
  if (empty($_POST['rating'])) {
    $ratingErr = 'Rating is required';
  } else {
    $rating = intval($_POST['rating']); // Convert the rating to an integer value
    if ($rating < 1 || $rating > 5) {
      $ratingErr = 'Rating must be between 1 and 5';
    }
  }


  if (empty($nameErr) && empty($emailErr) && empty($reviewErr) && empty($reviewErr)) {
    // add to database
    $sql = "INSERT INTO reviews (name, email ,rating, review) VALUES ('$name','$email', '$rating', '$review')";
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location: feedback.php');
    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>

    <img src="/php-crash/feedback/img/logo.png" class="w-25 mb-3" alt="">
    <h2>Add a Review</h2>
    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !$nameErr ?:
          'is-invalid'; ?>" id="name" name="name" placeholder="Enter movie Name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          Please provide a valid name.
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo !$emailErr ?:
          'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
      </div>
      <div class="mb-3">
        <label for="review" class="form-label">Review</label>
        <textarea class="form-control <?php echo !$reviewErr ?:
          'is-invalid'; ?>" id="review" name="review" placeholder="Enter your review"><?php echo $review; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <input type="number" class="form-control <?php echo !$ratingErr ?:
         'is-invalid'; ?>" id="rating" name="rating" placeholder="Enter rating" value="<?php echo $rating; ?>">
         <div id="validationServerFeedback" class="invalid-feedback">
           Please provide a valid rating.
         </div>
          </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
<?php include 'inc/footer.php'; ?>
