<?php

if (isset($_GET["idsession"])) {
    $idcsession = $_GET["idsession"];
    $_SESSION["userid"] = $idcsession;
}
else
{

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
}

    $idcsession = $idcsession;
    $gmodelo = $_GET["m"];
    $glayout = $_GET["l"];
    $qm = $_GET["m"];
    $ql = $_GET["l"];
?>

<?php include 'var.tamanhos.php'; ?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" />


<script>
	function selecionarfiltro(meutemplate, minhaext) {

                if (meutemplate == '0') {
                        varbg = document.getElementById("divl1").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl1").style.backgroundImage = varnbg;
                }

                if (meutemplate == '1') {
                        varbg = document.getElementById("divl2a").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl2a").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl2b").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl2b").style.backgroundImage = varnbg;
                }

                if (meutemplate == '2') {
                        varbg = document.getElementById("divl15b1").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b1").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b2").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b2").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b3").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b3").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b4").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b4").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b5").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b5").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b6").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b6").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b7").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b7").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b8").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b8").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b9").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b9").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b10").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b10").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b11").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b11").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15b12").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15b12").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15a1").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15a1").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15a2").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15a2").style.backgroundImage = varnbg;

                        varbg = document.getElementById("divl15a3").style.backgroundImage;
                        varnbg = varbg.replace("png-sp.png)","png)");
                        varnbg = varnbg.replace("png-40.png)","png)");
                        varnbg = varnbg.replace("png-pb.png)","png)");
                        varnbg = varnbg.replace("png-red.png)","png)");
                        varnbg = varnbg.replace("png-verde.png)","png)");
                        varnbg = varnbg.replace("png-azul.png)","png)");
                        varnbg = varnbg.replace("png-amarelo.png)","png)");
                        varnbg = varnbg.replace("png-roxo.png)","png)");
                        varnbg = varnbg.replace(")",minhaext+")");
                        document.getElementById("divl15a3").style.backgroundImage = varnbg;
                }


	}

    function selecionalayout(meulayout) {
      if (meulayout.value == '0') {
        document.getElementById("layoutdacapinha").value="0";
        goto3()
      }
      if (meulayout.value == '1') {
        document.getElementById("layoutdacapinha").value="1";
        goto3()
      }
      if (meulayout.value == '2') {
        document.getElementById("layoutdacapinha").value="2";
        goto3()
      }
      if (meulayout.value == '') {
        document.getElementById("layoutdacapinha").value="";
      }

      document.getElementById("imagensselecione").style.display = 'block';
      document.getElementById("p3desc").style.display = 'block';
      document.getElementById("compupload").style.display = 'none';
      document.getElementById("ishowcomp").checked = false;
      uncheckmodelo();
    }
</script>

</head>

<body style="margin: 0px; padding: 0px;font-family: Arial, Helvetica, sans-serif; color: #222222;line-height: 1.3;font-size: 12px; ">

<div id="div1" ondrop="drop(event)"
ondragover="allowDrop(event)"></div>








<div style="display: block; margin-left:13px; margin-top: 3px; float: left; width: 350px; border-left-style: solid; border-left-width: 0px; border-left-color: rgb(204, 204, 204); height: 540px; text-align: center; background-position: 15px 10px; background-repeat: no-repeat no-repeat;">

<!-- ddx.layout -->
    <?php include 'ddx.layout.php'; ?>
<!-- ddx.layout fim -->

</div>





<?php
	include '../../config.php';

	$gidcsession = $_GET["idcsession"];
	$gmodelo = $_GET["m"];
	$glayout = $_GET["l"];
	$gposicao = $_GET["posicao"];
	$gimagem = $_GET["imagem"];
	$qnheight = $_GET["nheight"];
	$qnwidth = $_GET["nwidth"];
	$qnleft = $_GET["nleft"];
	$qntop = $_GET["ntop"];

	$dblink = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
	mysql_select_db(DB_DATABASE,$dblink);

	if ($glayout == 0) {
		$sql_statement1  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 1  order by datainsert desc limit 1";
		$result1 = mysql_query($sql_statement1);
		if (!$result1) { 
			die('Invalid query: ' . mysql_error()); 
		}
		else { 
			while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) { 
				$imagemurl[1] 	= $row1["imagem"];
				$nheight[1] 	= $row1["nheight"];
				$nwidth[1] 		= $row1["nwidth"];
				$nleft[1] 		= $row1["nleft"];
				$ntop[1] 		= $row1["ntop"];
			?>
				<script>
				        document.getElementById('divl1').style.backgroundImage = "url('<?php echo $imagemurl[1]; ?>')";
				        document.getElementById('divl1').style.backgroundSize = "<?php echo $nwidth[1]; ?>px <?php echo $nheight[1]; ?>px";
				        document.getElementById('divl1').style.backgroundPosition = "<?php echo $nleft[1]; ?>px <?php echo $ntop[1]; ?>px";
				</script>
			<?php
			}
		}
	}











        if ($glayout == 1) {
                $sql_statement1  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 1  order by datainsert desc limit 1";
                $result1 = mysql_query($sql_statement1);
                if (!$result1) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) { 
                                $imagemurl[1]   = $row1["imagem"];
                                $nheight[1]     = $row1["nheight"];
                                $nwidth[1]              = $row1["nwidth"];
                                $nleft[1]               = $row1["nleft"];
                                $ntop[1]                = $row1["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl2a').style.backgroundImage = "url('<?php echo $imagemurl[1]; ?>')";
                                        document.getElementById('divl2a').style.backgroundSize = "<?php echo $nwidth[1]; ?>px <?php echo $nheight[1]; ?>px";
                                        document.getElementById('divl2a').style.backgroundPosition = "<?php echo $nleft[1]; ?>px <?php echo $ntop[1]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement2  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 2  order by datainsert desc limit 1";
                $result2 = mysql_query($sql_statement2);
                if (!$result2) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) { 
                                $imagemurl[2]   = $row2["imagem"];
                                $nheight[2]     = $row2["nheight"];
                                $nwidth[2]              = $row2["nwidth"];
                                $nleft[2]               = $row2["nleft"];
                                $ntop[2]                = $row2["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl2b').style.backgroundImage = "url('<?php echo $imagemurl[2]; ?>')";
                                        document.getElementById('divl2b').style.backgroundSize = "<?php echo $nwidth[2]; ?>px <?php echo $nheight[2]; ?>px";
                                        document.getElementById('divl2b').style.backgroundPosition = "<?php echo $nleft[2]; ?>px <?php echo $ntop[2]; ?>px";
                                </script>
                        <?php
                        }
                }
        }













        if ($glayout == 2) {
                $sql_statement1  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 1  order by datainsert desc limit 1";
                $result1 = mysql_query($sql_statement1);
                if (!$result1) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)) { 
                                $imagemurl[1]   = $row1["imagem"];
                                $nheight[1]     = $row1["nheight"];
                                $nwidth[1]              = $row1["nwidth"];
                                $nleft[1]               = $row1["nleft"];
                                $ntop[1]                = $row1["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b1').style.backgroundImage = "url('<?php echo $imagemurl[1]; ?>')";
                                        document.getElementById('divl15b1').style.backgroundSize = "<?php echo $nwidth[1]; ?>px <?php echo $nheight[1]; ?>px";
                                        document.getElementById('divl15b1').style.backgroundPosition = "<?php echo $nleft[1]; ?>px <?php echo $ntop[1]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement2  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 2  order by datainsert desc limit 1";
                $result2 = mysql_query($sql_statement2);
                if (!$result2) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)) { 
                                $imagemurl[2]   = $row2["imagem"];
                                $nheight[2]     = $row2["nheight"];
                                $nwidth[2]              = $row2["nwidth"];
                                $nleft[2]               = $row2["nleft"];
                                $ntop[2]                = $row2["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b2').style.backgroundImage = "url('<?php echo $imagemurl[2]; ?>')";
                                        document.getElementById('divl15b2').style.backgroundSize = "<?php echo $nwidth[2]; ?>px <?php echo $nheight[2]; ?>px";
                                        document.getElementById('divl15b2').style.backgroundPosition = "<?php echo $nleft[2]; ?>px <?php echo $ntop[2]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement3  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 3  order by datainsert desc limit 1";
                $result3 = mysql_query($sql_statement3);
                if (!$result3) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row3 = mysql_fetch_array($result3, MYSQL_ASSOC)) { 
                                $imagemurl[3]   = $row3["imagem"];
                                $nheight[3]     = $row3["nheight"];
                                $nwidth[3]              = $row3["nwidth"];
                                $nleft[3]               = $row3["nleft"];
                                $ntop[3]                = $row3["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b3').style.backgroundImage = "url('<?php echo $imagemurl[3]; ?>')";
                                        document.getElementById('divl15b3').style.backgroundSize = "<?php echo $nwidth[3]; ?>px <?php echo $nheight[3]; ?>px";
                                        document.getElementById('divl15b3').style.backgroundPosition = "<?php echo $nleft[3]; ?>px <?php echo $ntop[3]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement4  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 4  order by datainsert desc limit 1";
                $result4 = mysql_query($sql_statement4);
                if (!$result4) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row4 = mysql_fetch_array($result4, MYSQL_ASSOC)) { 
                                $imagemurl[4]   = $row4["imagem"];
                                $nheight[4]     = $row4["nheight"];
                                $nwidth[4]              = $row4["nwidth"];
                                $nleft[4]               = $row4["nleft"];
                                $ntop[4]                = $row4["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b4').style.backgroundImage = "url('<?php echo $imagemurl[4]; ?>')";
                                        document.getElementById('divl15b4').style.backgroundSize = "<?php echo $nwidth[4]; ?>px <?php echo $nheight[4]; ?>px";
                                        document.getElementById('divl15b4').style.backgroundPosition = "<?php echo $nleft[4]; ?>px <?php echo $ntop[4]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement5  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 5  order by datainsert desc limit 1";
                $result5 = mysql_query($sql_statement5);
                if (!$result5) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row5 = mysql_fetch_array($result5, MYSQL_ASSOC)) { 
                                $imagemurl[5]   = $row5["imagem"];
                                $nheight[5]     = $row5["nheight"];
                                $nwidth[5]              = $row5["nwidth"];
                                $nleft[5]               = $row5["nleft"];
                                $ntop[5]                = $row5["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15a1').style.backgroundImage = "url('<?php echo $imagemurl[5]; ?>')";
                                        document.getElementById('divl15a1').style.backgroundSize = "<?php echo $nwidth[5]; ?>px <?php echo $nheight[5]; ?>px";
                                        document.getElementById('divl15a1').style.backgroundPosition = "<?php echo $nleft[5]; ?>px <?php echo $ntop[5]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement6  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 6  order by datainsert desc limit 1";
                $result6 = mysql_query($sql_statement6);
                if (!$result6) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row6 = mysql_fetch_array($result6, MYSQL_ASSOC)) { 
                                $imagemurl[6]   = $row6["imagem"];
                                $nheight[6]     = $row6["nheight"];
                                $nwidth[6]              = $row6["nwidth"];
                                $nleft[6]               = $row6["nleft"];
                                $ntop[6]                = $row6["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15a2').style.backgroundImage = "url('<?php echo $imagemurl[6]; ?>')";
                                        document.getElementById('divl15a2').style.backgroundSize = "<?php echo $nwidth[6]; ?>px <?php echo $nheight[6]; ?>px";
                                        document.getElementById('divl15a2').style.backgroundPosition = "<?php echo $nleft[6]; ?>px <?php echo $ntop[6]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement7  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 7  order by datainsert desc limit 1";
                $result7 = mysql_query($sql_statement7);
                if (!$result7) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row7 = mysql_fetch_array($result7, MYSQL_ASSOC)) { 
                                $imagemurl[7]   = $row7["imagem"];
                                $nheight[7]     = $row7["nheight"];
                                $nwidth[7]              = $row7["nwidth"];
                                $nleft[7]               = $row7["nleft"];
                                $ntop[7]                = $row7["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b6').style.backgroundImage = "url('<?php echo $imagemurl[7]; ?>')";
                                        document.getElementById('divl15b6').style.backgroundSize = "<?php echo $nwidth[7]; ?>px <?php echo $nheight[7]; ?>px";
                                        document.getElementById('divl15b6').style.backgroundPosition = "<?php echo $nleft[7]; ?>px <?php echo $ntop[7]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement8  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 8  order by datainsert desc limit 1";
                $result8 = mysql_query($sql_statement8);
                if (!$result8) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row8 = mysql_fetch_array($result8, MYSQL_ASSOC)) { 
                                $imagemurl[8]   = $row8["imagem"];
                                $nheight[8]     = $row8["nheight"];
                                $nwidth[8]              = $row8["nwidth"];
                                $nleft[8]               = $row8["nleft"];
                                $ntop[8]                = $row8["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b5').style.backgroundImage = "url('<?php echo $imagemurl[8]; ?>')";
                                        document.getElementById('divl15b5').style.backgroundSize = "<?php echo $nwidth[8]; ?>px <?php echo $nheight[8]; ?>px";
                                        document.getElementById('divl15b5').style.backgroundPosition = "<?php echo $nleft[8]; ?>px <?php echo $ntop[8]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement9  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 9  order by datainsert desc limit 1";
                $result9 = mysql_query($sql_statement9);
                if (!$result9) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row9 = mysql_fetch_array($result9, MYSQL_ASSOC)) { 
                                $imagemurl[9]   = $row9["imagem"];
                                $nheight[9]     = $row9["nheight"];
                                $nwidth[9]              = $row9["nwidth"];
                                $nleft[9]               = $row9["nleft"];
                                $ntop[9]                = $row9["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b8').style.backgroundImage = "url('<?php echo $imagemurl[9]; ?>')";
                                        document.getElementById('divl15b8').style.backgroundSize = "<?php echo $nwidth[9]; ?>px <?php echo $nheight[9]; ?>px";
                                        document.getElementById('divl15b8').style.backgroundPosition = "<?php echo $nleft[9]; ?>px <?php echo $ntop[9]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement10  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 10  order by datainsert desc limit 1";
                $result10 = mysql_query($sql_statement10);
                if (!$result10) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row10 = mysql_fetch_array($result10, MYSQL_ASSOC)) { 
                                $imagemurl[10]   = $row10["imagem"];
                                $nheight[10]     = $row10["nheight"];
                                $nwidth[10]              = $row10["nwidth"];
                                $nleft[10]               = $row10["nleft"];
                                $ntop[10]                = $row10["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b7').style.backgroundImage = "url('<?php echo $imagemurl[10]; ?>')";
                                        document.getElementById('divl15b7').style.backgroundSize = "<?php echo $nwidth[10]; ?>px <?php echo $nheight[10]; ?>px";
                                        document.getElementById('divl15b7').style.backgroundPosition = "<?php echo $nleft[10]; ?>px <?php echo $ntop[10]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement11  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 11  order by datainsert desc limit 1";
                $result11 = mysql_query($sql_statement11);
                if (!$result11) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row11 = mysql_fetch_array($result11, MYSQL_ASSOC)) { 
                                $imagemurl[11]   = $row11["imagem"];
                                $nheight[11]     = $row11["nheight"];
                                $nwidth[11]              = $row11["nwidth"];
                                $nleft[11]               = $row11["nleft"];
                                $ntop[11]                = $row11["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b9').style.backgroundImage = "url('<?php echo $imagemurl[11]; ?>')";
                                        document.getElementById('divl15b9').style.backgroundSize = "<?php echo $nwidth[11]; ?>px <?php echo $nheight[11]; ?>px";
                                        document.getElementById('divl15b9').style.backgroundPosition = "<?php echo $nleft[11]; ?>px <?php echo $ntop[11]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement12  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 12  order by datainsert desc limit 1";
                $result12 = mysql_query($sql_statement12);
                if (!$result12) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row12 = mysql_fetch_array($result12, MYSQL_ASSOC)) { 
                                $imagemurl[12]   = $row12["imagem"];
                                $nheight[12]     = $row12["nheight"];
                                $nwidth[12]              = $row12["nwidth"];
                                $nleft[12]               = $row12["nleft"];
                                $ntop[12]                = $row12["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b10').style.backgroundImage = "url('<?php echo $imagemurl[12]; ?>')";
                                        document.getElementById('divl15b10').style.backgroundSize = "<?php echo $nwidth[12]; ?>px <?php echo $nheight[12]; ?>px";
                                        document.getElementById('divl15b10').style.backgroundPosition = "<?php echo $nleft[12]; ?>px <?php echo $ntop[12]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement13  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 13  order by datainsert desc limit 1";
                $result13 = mysql_query($sql_statement13);
                if (!$result13) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row13 = mysql_fetch_array($result13, MYSQL_ASSOC)) { 
                                $imagemurl[13]   = $row13["imagem"];
                                $nheight[13]     = $row13["nheight"];
                                $nwidth[13]              = $row13["nwidth"];
                                $nleft[13]               = $row13["nleft"];
                                $ntop[13]                = $row13["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b11').style.backgroundImage = "url('<?php echo $imagemurl[13]; ?>')";
                                        document.getElementById('divl15b11').style.backgroundSize = "<?php echo $nwidth[13]; ?>px <?php echo $nheight[13]; ?>px";
                                        document.getElementById('divl15b11').style.backgroundPosition = "<?php echo $nleft[13]; ?>px <?php echo $ntop[13]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement14  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 14  order by datainsert desc limit 1";
                $result14 = mysql_query($sql_statement14);
                if (!$result14) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row14 = mysql_fetch_array($result14, MYSQL_ASSOC)) { 
                                $imagemurl[14]   = $row14["imagem"];
                                $nheight[14]     = $row14["nheight"];
                                $nwidth[14]              = $row14["nwidth"];
                                $nleft[14]               = $row14["nleft"];
                                $ntop[14]                = $row14["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15b12').style.backgroundImage = "url('<?php echo $imagemurl[14]; ?>')";
                                        document.getElementById('divl15b12').style.backgroundSize = "<?php echo $nwidth[14]; ?>px <?php echo $nheight[14]; ?>px";
                                        document.getElementById('divl15b12').style.backgroundPosition = "<?php echo $nleft[14]; ?>px <?php echo $ntop[14]; ?>px";
                                </script>
                        <?php
                        }
                }

                $sql_statement15  = "SELECT * FROM c4y_capasconstrucao WHERE idcsession = $gidcsession AND modelo = $gmodelo AND layout = $glayout AND posicao = 15  order by datainsert desc limit 1";
                $result15 = mysql_query($sql_statement15);
                if (!$result15) { 
                        die('Invalid query: ' . mysql_error()); 
                }
                else { 
                        while ($row15 = mysql_fetch_array($result15, MYSQL_ASSOC)) { 
                                $imagemurl[15]   = $row15["imagem"];
                                $nheight[15]     = $row15["nheight"];
                                $nwidth[15]              = $row15["nwidth"];
                                $nleft[15]               = $row15["nleft"];
                                $ntop[15]                = $row15["ntop"];
                        ?>
                                <script>
                                        document.getElementById('divl15a3').style.backgroundImage = "url('<?php echo $imagemurl[15]; ?>')";
                                        document.getElementById('divl15a3').style.backgroundSize = "<?php echo $nwidth[15]; ?>px <?php echo $nheight[15]; ?>px";
                                        document.getElementById('divl15a3').style.backgroundPosition = "<?php echo $nleft[15]; ?>px <?php echo $ntop[15]; ?>px";
                                </script>
                        <?php
                        }
                }

        }




?>

<?php if ($_GET["m"] == "0") { ?>
<div style="position: absolute; top: 0px; left: 0px; margin-left: 10px; padding: 0px; height: 490px; width: 340px; background-size: 340px; background-image: url(https://case4you.com.br/app/img/mask-iphone4-top.png); background-repeat: no-repeat no-repeat;">&nbsp;</div>
<? } ?>

<?php if ($_GET["m"] == "1") { ?>
<div style="position: absolute; top: 0px; left: 0px; margin-left: 10px; padding: 0px; height: 538px; width: 340px; background-size: 340px; background-image: url(https://case4you.com.br/app/img/mask-iphone5-top.png); background-repeat: no-repeat no-repeat;">&nbsp;</div>
<? } ?>

<?php if ($_GET["m"] == "2") { ?>
<div style="position: absolute; top: 0px; left: 0px; margin-left: 10px; padding: 0px; height: 527px; width: 340px; background-size: 340px; background-image: url(https://case4you.com.br/app/img/mask-galaxy3-top.png); background-repeat: no-repeat no-repeat;">&nbsp;</div>
<? } ?>

<?php if ($_GET["m"] == "3") { ?>
<div style="position: absolute; top: 0px; left: 0px; margin-left: 10px; padding: 0px; height: 499px; width: 340px; background-size: 340px; background-image: url(https://case4you.com.br/app/img/mask-galaxy4-top.png); background-repeat: no-repeat no-repeat;">&nbsp;</div>
<? } ?>




<script>
<?php if ($_GET["f"] == "0") { ?>
    selecionarfiltro('<?php echo $_GET['l']; ?>', '');
<? } ?>

<?php if ($_GET["f"] == "1") { ?>
    selecionarfiltro('<?php echo $_GET['l']; ?>', '-pb.png');
<? } ?>

<?php if ($_GET["f"] == "2") { ?>
    selecionarfiltro('<?php echo $_GET['l']; ?>', '-sp.png');
<? } ?>

<?php if ($_GET["f"] == "3") { ?>
    selecionarfiltro('<?php echo $_GET['l']; ?>', '-40.png');
<? } ?>

</script>

</body>
</html>
