
<!DOCTYPE html>
<html lang="en">
  <head>

<?php
session_start();
if($_GET['id']=='logout')
{
    unset($_SESSION['userdetails']);
    session_destroy();
}

require 'instagram.class.php';
require 'instagram.config.php';

if (!empty($_SESSION['userdetails'])) 
{
    $data=$_SESSION['userdetails'];
    $instagram->setAccessToken($data);
}
else
{
    header('Location: 1/index.php');
}
?>

<?php
session_start();

if (isset($_SESSION["userid"])) {
  $idcsession = $_SESSION["userid"];
}
else {
  //Randomiza nome do arquivo
  $date1 = date_create();
  $timestamp1 = date_timestamp_get($date1);
  $ramdomico4 = rand(1000,9999);
  $idsession = $timestamp1."".$ramdomico4;
  $_SESSION["userid"] = $idsession;

  //echo "Nao logado:" . $_SESSION["userid"];
}

    $gmodelo = $_GET["m"];
    $glayout = $_GET["l"];
?>

<?php include '../../case4you/2/var.tamanhos.php'; ?>


<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />

  <link rel="stylesheet" href="../0/jquery-ui.css" />
  <script src="../0/jquery-1.9.1.js"></script>
  <script src="../0/jquery-ui.js"></script>
  <link rel="stylesheet" href="../0/style.css" />

  <?php include '../../case4you/2/ddx.jscript.php'; ?>
</head>

<body style="margin: 0px; padding: 0px;font-family: Arial, Helvetica, sans-serif; color: #222222;line-height: 1.3;font-size: 12px; ">

<div id="div1" ondrop="drop(event)"
ondragover="allowDrop(event)"></div>


<div style="height: 475px; float: left; width: 320px; overflow-x: hidden">




<?php
    $ic = 0;
    $popular = $instagram->getUserMedia($data->user->id);

    foreach ($popular->data as $data) {
	$ic++;
?>
        <div id="divdrag<?php echo $ic; ?>" style="background-color: #FFFFFF; width: 50px; float: left; overflow: hidden; height: 50px;

background: rgba(255,255,255,0.8);
position: relative;
display: inline-block;
margin: 5px;
vertical-align: top;
border: 1px solid #acacac;
padding: 6px 6px 6px 6px;
-webkit-box-shadow: 1px 1px 4px rgba(0,0,0,0.16);
box-shadow: 1px 1px 4px rgba(0,0,0,0.16);
font-size: 14px;
">

<?php  echo "<img src=\"{$data->images->thumbnail->url}\""; ?>
 id="drag<?php echo $ic; ?>" draggable="true"
  ondragstart="drag(event)" style="max-width:100%; max-height:100%;">
                </div>

<?php
}

?>
&nbsp;
</div>

<!-- ddx.layoyt -->
    <?php include '../../case4you/2/ddx.layout.php'; ?>
<!-- ddx.layout fim -->


</body>
</html>

