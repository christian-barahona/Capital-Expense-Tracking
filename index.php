<?php
include 'mysql_connection.php';
$page_content = "landing.php";

if(isset($_GET['p'])) {
    $page_content = str_replace('.', '', $_GET['p']);
    $page_content .= '.php';
    if (!is_file($page_content)) {
        $page_content = '404.php';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no"/>
    <title>Capex Tracking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/jquery.autocomplete.min.js"></script>
    <script src="js/modernizr-custom.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded" id="main-nav">
        <button class="navbar-toggler navbar-toggler-right hidden-print" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="?">
            <img src="assets/ucb_logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Capex Tracking
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="?p=view_all">View All</a>
                <a class="nav-item nav-link" href="?p=new_entry">New Entry</a>
            </div>
        </div>
    </nav>
<?php include $page_content; ?>
</body>
</html>