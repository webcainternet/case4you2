<?php
if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
    $base_url = $this->config->get('config_ssl');
} else {
    $base_url = $this->config->get('config_url');
}

$view_path = $base_url . 'catalog/view/';
$theme_path = $view_path . 'theme/' . $this->config->get('config_template') . '/';

?>
<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8" />

    <title>Arquivos para produção</title>

    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo $theme_path; ?>stylesheet/builder4you.css" type="text/css" />

    <style>
        body {
            width: 1000px;
            margin: 0 auto;
        }

        .container {
            overflow: hidden;
        }

        img {
            max-width: 100%;
            height: auto;
            display: inline-block;
        }

        .print-file-cont {
            width: 40%;
            display: block;
            padding: 10px;
            border: 1px solid #aaa;
            margin: 10px;
            float: left;
        }

        .print-file-cont img {
            text-align: center;
        }

        .print-file img {
            width: auto;
            max-height: 700px;
        }

        h4 {
            margin-top: 0;
            border-bottom: 1px solid #aaa;
        }

        hr {
            clear: both;
        }

        .original-images {
            overflow: hidden;
        }

        .original-images img {
            display: block;
            float: left;
            margin-right: 2%;
            width: 18%;
        }
    </style>
</head>
<body class="<?php echo empty($this->request->get['route']) ? 'common-home' : str_replace('/', '-', $this->request->get['route']); ?>">

<h3>Arquivos para produção</h3>

<div class="container">
    <p><strong>Tipo:</strong> <?php echo $map['category']; ?></p>
    <p><strong>Modelo:</strong> <?php echo $map['name']; ?></p>

    <div>
        <h4>Informações do cliente</h4>
        <?php if ($map['payer']): ?>
            <h5>Pagante</h5>
            <p><strong>Nome:</strong> <?php echo $map['payer']['payer_firstname']; ?> <?php echo $map['payer']['payer_lastname']; ?></p>
            <p><strong>Email:</strong> <?php echo $map['payer']['email']; ?></p>
            <p><strong>Telefone:</strong> <?php echo $map['payer']['phone']; ?></p>

            <h5>Envio</h5>
            <p><strong>Nome:</strong> <?php echo $map['payer']['payer_firstname']; ?> <?php echo $map['payer']['payer_lastname']; ?></p>
            <p><strong>Endereço:</strong></p>
            <p><?php echo $map['payer']['address']; ?></p>
            <p><?php echo $map['payer']['neighbordhood']; ?>, <?php echo $map['payer']['city']; ?>, <?php echo $map['payer']['state']; ?></p>
            <p><?php echo $map['payer']['zip_code']; ?></p>
            <p><strong>Método de envio:</strong> <?php echo $map['payer']['shipping_method']; ?></p>
        <?php else: ?>
            <p>O comprador ainda não foi até o final do processo de compra.</p>
        <?php endif ?>
    </div>

    <div class="print-file-cont">
        <h4>Imagem para impressão</h4>
        <div class="print-file"></div>
    </div>

    <div class="print-file-cont">
        <h4>Imagem com máscara</h4>
        <div class="rendered-file"></div>
    </div>

    <hr>

    <h4>Imagens originais</h4>
    <div class="original-images"></div>
</div>

<script>
    var baseUrl = '<?php echo $base_url; ?>';
    var map = <?php echo json_encode($map); ?>;
</script>

<script type="text/javascript" src="<?php echo $theme_path; ?>fancybox/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/camanjs/4.0.0/caman.full.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>scripts/plugins.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>scripts/compositron.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>scripts/builder4youdownloader.js"></script>

</body>
</html>