<?php
session_start();
if (empty($_SESSION['essai'])) {
    header('Location: ./index.php');
}
?>
<html>
<heead>
    <title>Maximum Attempt | Well Test Nordisk</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</heead>

<body>

<main role="main" class="container">

    <div class="alert alert-danger" role="alert">
        You exceed the maximum attempt. Please contact support
        <br>
        <a href="mailto:support@welltest.com">Contact us</a>
    </div>

</main><!-- /.container -->

</body>
</html>