<!doctype html>
<html>
<head>
<title>Seu pedido foi registrado com sucesso</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body bgcolor="#b5ea77" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="background:#b5ea77;padding: 20px 0;">
<!-- Save for Web Slices (Email_automatico_Case4You.png) -->
<table width="603" height="720" border="0" cellpadding="0" cellspacing="0" style="background-color: #fff; border: none;" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="16">
            <img src="<?php echo $base_url; ?>image/email/Email_automatico_Case4You_01.png" width="602" height="168" alt=""></td>
        <td>
            <img src="<?php echo $base_url; ?>image/email/spacer.gif" width="1" height="168" alt=""></td>
    </tr>
    <tr>
        <td colspan="16" style="font-family: Arial; font-size: 14px; color: #58595b; line-height: 1.777; padding: 0px 45px">
            <p><b>Seu pedido foi registrado com sucesso</b></p>

            <p><b>Olá <?php echo $firstname; ?>,</b></p>

            <p>Que bom que você escolheu a Case4you. Seu pedido foi registrado com sucesso e será enviado para a produção assim que recebermos a confirmação do pagamento através do PagSeguro.</p>

            <p>E caso ainda não tenha finalizado o pagamento basta acessar este link.</p>

            <p><a href="http://case4you.com.br/index.php?route=checkout/cartcustom" style="color: orange;">Finalizar minha compra!</a></p>

            <p style="margin: 0;"><b>Os dados da sua compra são:</b></p>

            <?php foreach ($products as $product): ?>
                <p style="margin: 0;"><b><?php echo $product['quantity']; ?> - <?php echo $product['name']; ?></b></p>
                <p style="margin: 0;"><b>Valor: <?php echo $product['price']; ?></b></p>
                <p style="margin: 0;"><b>Total: <?php echo $product['total']; ?></b></p>
            <?php endforeach; ?>

            <hr>

            <p style="margin: 0;"><strong>Informações de entrega:</strong></p>
            <p style="margin: 0;"><b>Método:</b> <?php echo $shipping_method; ?></p>
            <p style="margin: 0;"><b>Valor do frete:</b> R$ <?php echo $shipping_cost; ?></p>

            <p><b>Total com frete:</b> R$ <?php echo $total; ?></p>

            <p>Caso ainda tenha alguma dúvida, por favor, entre em contato conosco.</p>

            <p>Um grande abraço<br>
            <b>Equipe Case4you</b></p>
        <td>
            <img src="<?php echo $base_url; ?>image/email/spacer.gif" width="1" height="370" alt=""></td>
    </tr>
    <tr>
        <td colspan="16">
            <img id="Image-Maps-Com-image-maps-2014-07-04-122230" src="http://case4you.com.br/image/email/email_case4you.jpg" border="0" width="600" height="154" orgWidth="600" orgHeight="154" usemap="#image-maps-2014-07-04-122230" alt="" />
            <map name="image-maps-2014-07-04-122230" id="ImageMapsCom-image-maps-2014-07-04-122230">
            <area  alt="" title="" href="https://www.facebook.com/case4youoficial" target="_blank" shape="rect" coords="423,40,467,82" style="outline:none;" target="_self"     />
            <area  alt="" title="" href="https://twitter.com/case4youoficial" target="_blank" shape="rect" coords="475,41,518,81" style="outline:none;" target="_self"     />
            <area  alt="" title="" href="http://instagram.com/case4youoficial" target="_blank" shape="rect" coords="533,42,576,82" style="outline:none;" target="_self"     />
            <area  alt="" title="" href="mailto:contato@case4you.com.br" target="_blank" shape="rect" coords="23,114,95,141" style="outline:none;" target="_self"     />
            <area  alt="" title="" href="http://case4you.com.br/privacidade" target="_blank" shape="rect" coords="193,116,313,139" style="outline:none;" target="_self"     />
            <area  alt="" title="" href="http://case4you.com.br/termos" target="_blank" shape="rect" coords="310,116,398,137" style="outline:none;" target="_self"     />
            </map>
        <td>
    </tr>
</table>
<!-- End Save for Web Slices -->
</body>
</html>
