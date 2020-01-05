<?php
/**
 * Enable debugging in development
 * Do not forget to remove it or comment in production
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On active les sessions :
session_start();

/**
 * Check if the user is already logged in
 * if logged redirect to home page
 */
if (isset($_SESSION['identifier']) && ! empty($_SESSION['identifier'])) {
    header('Location: ./accueil.php');
}

// On inclus les données de connexion :
/**
 * Please make sure that  the included file doesn't out put space or empty line.
 * Because header() must be called before any output is made ie html tags, blank lines, etc
 */
include('./inc/donnees.php');

$con = connect();
?>

<?php
/*echo "1 ";*/
?>

<?php
// On créait la session `essai` si elle n'existe pas :
if (!isset($_SESSION['essai'])) $_SESSION['essai'] = 0;
?>

<?php
/*echo "2 ";*/
?>

<?php
// On teste si le formulaire a été soumis :
if ((isset($_POST['identifier'])) && (isset($_POST['password']))) {
    $membre_existe = false;
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    // Requete visant à vérifier l'existance de l'identifier :
    $requete = "SELECT `password` FROM `espace_membre` WHERE identifier = '" . mysqli_real_escape_string($con, $identifier) . "'";

    // On cherche si l'identifier existe et on récupère son mot de passe :
    /**
     * Need to use different variable other than $password to hold password fetch from espace_membre table.
     * Because it overwrites the posted password from the form
     */
    /*    if (list($password) = mysqli_fetch_array(mysqli_query($requete)))*/

    /**
     * Use different variable in the list to hold password
     * @param $actualPassword
     */

    list($actualPassword) = mysqli_fetch_array(mysqli_query($con, $requete));

    if (!is_null($actualPassword)) {
        // On teste le mot de passe en fonction de l'identifier :
        /*if (md5($password) == $password) {*/
        /**
         * Comparing password stored in database with md5 user posted password through form
         */
        if (md5($password) == $actualPassword) {
            $membre_existe = true;

            /*Reset the login counter to 0*/
            $_SESSION['essai'] = 0;

            // On créait les sessions `identification` et `password` :
            $_SESSION['identifier'] = $identifier;

            /**
             * Its bad practice to store user's password in session
             * Though encrypted
             */
            /*$_SESSION['password'] = md5($password);*/

            // Puis on redirige le visiteur vers la page d'accueil :

            /*echo "avant acceuil ";*/

            header('Location: ./accueil.php');
            /**
             * After header() new location will be loaded ie [your_domain]/accueil.php
             * so no need to out put message or exit()
             */
            /*echo "apres acceuil ";
            exit();*/
        }
    }
    if (!$membre_existe) {
        // Si celles-ci ne sont pas identiques, on incrémente le nombre d'essai :
        $_SESSION['essai']++;

        // Puis on redirige le visiteur vers la page d'authentification :

        header('Location: ./index.php');
        exit();

        //!\ Cette redirection est nécessaire /!\
    }
}

/*echo "Process terminated true, referer ici pe à un site calc dans members ";*/
// Fin de la connexion SQL :
/**
 * Not required
 * php clean up if we no longer use it
 */
/*mysql_close();*/
/**
 * Close the database connection
 * Make the function call from ./inc/donnees.php
 */
close($con);
?>


<?php
/*echo "3 ";*/
?>

<?php
// On vérifie que le nombre d'essai n'a pas été dépassé :
/**
 * The parameter is undefined
 * @param $Essai
 */
$essai = 3;

if ($_SESSION['essai'] >= $essai) {
    // Si c'est le cas, on affiche un message de garde :

    header('Location: ./max-attempt.php');

    exit();
}
/**
 * No need for else block
 * Because after all we are going to display the login form which is down the page
 */
/*else {
    // Sinon on affiche le formulaire :


    // Le formulaire est plus bas sur cette page ;)


}*/
?>

<!--html code for login form-->

<html>
<heead>
    <title>Login | Well Test Nordisk</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet"
          id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</heead>

<body>

<div class="container">
    <?php if ($_SESSION['essai'] > 0) { ?>
        <div class="alert alert-warning" role="alert">
            Attempt remain <?php echo $essai - $_SESSION['essai']; ?>
        </div>
    <?php } ?>
    <div class="row">
        <div class="span12">
            <form class="form-horizontal" method="POST">
                <fieldset>
                    <div id="legend">
                        <legend class="">Login</legend>
                    </div>
                    <div class="control-group">
                        <!-- Identifier -->
                        <label class="control-label" for="username">Identifier</label>
                        <div class="controls">
                            <input type="text" id="identifier" name="identifier" placeholder="" class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Password-->
                        <label class="control-label" for="password">Password</label>
                        <div class="controls">
                            <input type="password" id="password" name="password" placeholder="Password"
                                   class="input-xlarge">
                        </div>
                    </div>
                    <div class="control-group">
                        <!-- Button -->
                        <div class="controls">
                            <button class="btn btn-success">Login</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>

</body>
</html>