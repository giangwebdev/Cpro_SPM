<?php
/**
 * Created by PhpStorm.
 * User: Kevin Flynn
 * Date: 3/13/2018
 * Time: 1:08 PM
 */

include_once ('../model/database_query.php');
include_once ('../model/query_for_supervisor.php');
session_start();
if(!isset($_SESSION['acc_id']) || $_SESSION['role_id'] != "2" ){
    echo '<script type="text/javascript">
           window.location = "../index.php";
          </script>';

}
    $acc_id = $_SESSION['acc_id'];
    if(is_supervisor_leader_by_acc_id($acc_id) == false){
        echo '<script type="text/javascript">
           alert("You have no permission to access this function.");
           window.location = "../view/home_supervisor.php";
          </script>';
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Document</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/one-page-wonder.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="home_supervisor.php"><img src="../image/Logo-FU-01.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../view/approve_pending_acc.php">Manage account request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Create account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Edit account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Manage team</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controller/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <?php
        $pending_acc_list = get_pending_acc();
        $team_id=null;
        $total_team_member =0;
         $supervisor_name[] = array();
        foreach ($pending_acc_list as $pending_acc){
            $total_team_member =0;

            if($team_id != $pending_acc['team_pending_id']){
            ?>
    <div> Team : <?php echo $pending_acc['projectname_en'];
                $count_team_member= 1
                ;}?>
        <div>
            <ul>
                <li>Name:<?php echo $pending_acc['full_name'];
                if($pending_acc['isteamleader']=='1') echo "(Team leader)"; ?></li>
                <li>Student ID:<?php echo $pending_acc['student_id'];   ?></li>
                <li>Phone number:<?php echo $pending_acc['phone'];    ?></li>
                <li>Email:<?php echo $pending_acc['email'];    ?></li>
            </ul>
        </div>

    </div>
            <form action="../controller/approve_pending_acc.php" method="post">
    <?php
            $total_team_member = count_pending_team_member($pending_acc['team_pending_id']);
            if($count_team_member == $total_team_member ){
                $print_supervisor= "Supervisor: <select id='supervisor' name='supervisor'>";
                $supervisor_name = get_supervisor();
                $print_supervisor .= "<option value='null'";
                if(!isset($pending_acc['supervisor']) || $pending_acc['supervisor_id']==null){
                    $print_supervisor .= "selected >No selection</option>";
                }else{
                    $print_supervisor .= ">No selection</option>";
                }
                foreach ($supervisor_name as $name){
                    $print_supervisor .= "<option value='".$name['supervisor_id']."'";
                    if($name['supervisor_id'] == $pending_acc['supervisor_id']){
                        $print_supervisor .= "selected >".$name['full_name']."</option>";
                    }else{
                        $print_supervisor .= ">".$name['full_name']."</option>";
                    }
                }
                $print_supervisor .= "</select>";
                $print_supervisor .= "<br>Note: ".$pending_acc['note']."<br><br>";
                echo $print_supervisor;
                   ?>

                    <input type="hidden" name="student_id" value="<?php echo $pending_acc['student_id'];?>">
                    <input type="hidden" name="student_name" value="<?php echo $pending_acc['full_name'];?>">
                    <input type="hidden" name="student_team_pending_id" value="<?php echo $pending_acc['team_pending_id'];?>">
                    <input type="hidden" name="student_phone" value="<?php echo $pending_acc['phone'];?>">
                    <input type="hidden" name="student_mail" value="<?php echo $pending_acc['email'];?>">
                    <input type="hidden" name="student_isteamleader" value="<?php echo $pending_acc['isteamleader'];?>">
                    <input type="hidden" name="student_project_en" value="<?php echo $pending_acc['projectname_en'];?>">
                    <input type="hidden" name="student_project_vi" value="<?php echo $pending_acc['projectname_vi'];?>">
                    <input type="submit" name="submit" value="Approve" />
                </form>
                <?php

            }
            $count_team_member++;
            $team_id = $pending_acc['team_pending_id'];
        }
    ?>
</body>
</html>