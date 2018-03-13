<?php
/**
 * Created by PhpStorm.
 * User: Kevin Flynn
 * Date: 3/12/2018
 * Time: 7:06 AM
 */
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff Homepage</title>
    <link rel="stylesheet" href="../css/spmfu.css">
</head>
<body>
    <header id="header">
    </header>
    <div id="container" >

        <div> Welcome back, <?php
            if(!isset($_SESSION['username'])) echo '<script type="text/javascript">
                                                        window.location = "../index.php";
                                                  </script>';
            echo $username = $_SESSION['username'];
            ?> </div>
        <menu id="sidebar">
            <table cellspacing="0" border="1" id="Box">
                <tr><th id="box_header">Main menu</th></tr>
                <tr><th id="menu"><ul>
                            <li><a href="#">Home page</a></li>
                            <li><a href="../approve_pending_acc.php">Approve account</a></li>
                            <li><a href="#">Manage account</a></li>
                            <li><a href="#">Manage request</a></li>
                            <li><a href="#">Manage team</a></li>
                            <li><a href="../controller/logout.php">Logout</a></li>
                     </ul></th></tr>
            </table>
        </menu>
        <section>
            <?php

            ?>
        </section>

    </div>
    <footer>
        <div id="container-fluid">
            <div id="copyright">Copyright SPMFU</div>
        </div>
    </footer>
</body>
</html>