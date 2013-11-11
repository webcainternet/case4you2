<?
if(!isset($_POST['TransacaoID'])){
 header("Location: index.php?route=checkout/success");
		  }
		  
	function tep_not_null($value) {
	if (is_array($value)) {
	if (sizeof($value) > 0) {
	return true;
	} else {
	return false;
}

} else {

	if (($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
	return true;

} else {

	return false;

}}}

require_once("config.php");
$db = mysql_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD);
mysql_select_db(DB_DATABASE, $db);

	 $SQL = "SELECT `value` FROM `setting` WHERE `group` ='pagseguro' AND `key`='pagseguro_encryption'";
	 $Executa = mysql_query($SQL) or print(mysql_error());
	 $totalresultado = mysql_num_rows($Executa);
	 if($totalresultado!=0){
	 $resultaado = mysql_fetch_object($Executa);
	 $kkey = $resultaado->value;
 }
 else {
	$kkey="0000"; 
 }
$PagSeguro = 'Comando=validar';
$PagSeguro .= '&Token='.$kkey;
$Cabecalho = "";

foreach ($_POST as $key => $value)
{
 $value = urlencode(stripslashes($value));
 $PagSeguro .= "&$key=$value";
}

if (function_exists('curl_exec'))
{
 $curl = true;
}
elseif ( (PHP_VERSION >= 4.3) && ($fp = @fsockopen ('ssl://pagseguro.uol.com.br', 443, $errno, $errstr, 30)) )
{
 $fsocket = true;
}
elseif ($fp = @fsockopen('pagseguro.uol.com.br', 80, $errno, $errstr, 30))
{
 $fsocket = true;
}

if ($curl == true)
{
 $ch = curl_init();

 curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml');
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HEADER, false);
 curl_setopt($ch, CURLOPT_TIMEOUT, 60);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

 $resp = curl_exec($ch);
 if (!tep_not_null($resp))
 {
    curl_setopt($ch, CURLOPT_URL, 'https://pagseguro.uol.com.br/pagseguro-ws/checkout/NPI.jhtml');
    $resp = curl_exec($ch);
 }

 curl_close($ch);
 $confirma = (strcmp ($resp, "VERIFICADO") == 0);
}
elseif ($fsocket == true)
{
 $Cabecalho  = "POST /pagseguro-ws/checkout/NPI.jhtml HTTP/1.0\r\n";
 $Cabecalho .= "Content-Type: application/x-www-form-urlencoded\r\n";
 $Cabecalho .= "Content-Length: " . strlen($PagSeguro) . "\r\n\r\n";

 if ($fp || $errno>0)
 {
    fputs ($fp, $Cabecalho . $PagSeguro);
    $confirma = false;
    $resp = '';
    while (!feof($fp))
    {
       $res = @fgets ($fp, 1024);
       $resp .= $res;
       if (strcmp ($res, "VERIFICADO") == 0)
       {
          $confirma=true;
          break;
       }
    }
    fclose ($fp);
 }
 else
 {
    echo "$errstr ($errno)<br />\n";
 }
}


if ($confirma)
{
	$TransacaoID = $_POST['TransacaoID'];
	$VendedorEmail = $_POST['VendedorEmail'];
	$Referencia = $_POST['Referencia'];
	$ValorFrete = $_POST['ValorFrete'];
	$Anotacao = $_POST['Anotacao'];
	$TipoPagamento = $_POST['TipoPagamento'];
	$StatusTransacao = $_POST['StatusTransacao'];
	$CliNome = $_POST['CliNome'];
	$CliEmail = $_POST['CliEmail'];
	$CliEndereco = $_POST['CliEndereco'];
	$CliBairro = $_POST['CliBairro'];
	$CliCidade = $_POST['CliCidade'];
	$CliEstado = $_POST['CliEstado'];
	$CliCEP = $_POST['CliCEP'];
	$CliTelefone = $_POST['CliTelefone'];
	$NumItens = $_POST['NumItens'];
 
 $SQL = "SELECT TransacaoID FROM PagSeguroTransacoes WHERE TransacaoID ='$TransacaoID'";
 $Executa = mysql_query($SQL) or print(mysql_error());
 $totalresultado = mysql_num_rows($Executa);
 if($totalresultado!=0){
				
		$SQL = "UPDATE PagSeguroTransacoes SET  StatusTransacao='".$StatusTransacao."' WHERE TransacaoID='".$TransacaoID."'";	
		$Executa = mysql_query($SQL) or print(mysql_error());		
				
				}else {
$SQL = "INSERT INTO PagSeguroTransacoes (" .
		"TransacaoID, " .
		"VendedorEmail, ".	
		"Referencia, " .
		"ValorFrete, ".
		"Anotacao, ".
		"TipoPagamento, ".
        "StatusTransacao, " .
        "CliNome, " .
		"CliEmail, " .
		"CliEndereco, " .
		"CliBairro, " .
		"CliCidade, " .
		"CliEstado, " .
		"CliCEP, " .
		"CliTelefone, " .
        "NumItens" .
        ") VALUES (" .
        "" .
		"'" . $TransacaoID . "', " .
		"'" . $VendedorEmail . "', " .
		"'" . $Referencia . "', " .
		"'" . $ValorFrete . "', " .
        "'" . $Anotacao . "', " .
		"'" . $TipoPagamento . "', " . 
        "'" . $StatusTransacao . "', " .
        "'" . $CliNome . "', " .
		"'" . $CliEmail . "', " .
		"'" . $CliEndereco . "', " .
		"'" . $CliBairro . "', " .
		"'" . $CliCidade . "', " .
		"'" . $CliEstado . "', " .
		"'" . $CliCEP . "', " .
		"'" . $CliTelefone . "', " .
        "'" . $NumItens . "'" .
        ")";
 $Executa = mysql_query($SQL) or print(mysql_error());
				}
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, HTTP_SERVER.'index.php?route=payment/pagseguro/callback');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $PagSeguro);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($ch);
    curl_close($ch);
 
}
else
{
 if (strcmp ($res, "FALSO") == 0)
 {

 }
}

mysql_close($db);

?>