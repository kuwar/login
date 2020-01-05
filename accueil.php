<?php
session_start();
if (empty($_SESSION['identifier'])) {
    header('Location: ./index.php');
}
?>
<html>
<heead>
    <title>Home | Well Test Nordisk</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</heead>

<body>

<main role="main" class="container">

    <div class="starter-template">
        <h1>Welcome <?php echo $_SESSION['identifier'] ?>,</h1>
        <p class="lead">You have successfully logged in to <strong>Well Test Nordisk</strong></p>
        <a href="./logout.php" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span> Logout
        </a>
    </div>

</main><!-- /.container -->

</body>
</html>