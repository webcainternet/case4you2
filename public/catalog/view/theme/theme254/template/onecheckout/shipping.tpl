<?php
if ($error_warning) {
    ?>
    <div class="warning">
        <?php //echo $error_warning; ?>
    </div>
    <?php
}
?>
<?php if ($shipping_methods) { ?>
    <p><?php echo $text_shipping_method; ?></p>
    <table class="form">
    <?php foreach ($shipping_methods as $shipping_method) {
        //foreach($shipping_method['teste1']['cart'] AS $key=>$valor){
            //$quant = $valor;
        //}
        //if($quant===1){
            //if(substr($shipping_method['title'],0,5)==="Frete") {
                //continue;
            //}
        //}
        ?>
        <tr>
            <td colspan="3">
                <b><?php echo $shipping_method['title']; ?></b>
            </td>
        </tr>
        <?php if (!$shipping_method['error']) { ?>
            <?php foreach ($shipping_method['quote'] as $quote) {
                //if($quant>1){
                    //if(substr($quote['title'],0,3)==="PAC") {
                        //continue;
                    //}
                //}
                ?>
                <tr>
                <td style="width: 1px;">
                    <?php if ($quote['code'] == $code || !$code) { ?>
                        <?php $code = $quote['code']; ?>
                        <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
                    <?php } else { ?>
                        <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" />
                    <?php } ?>
                </td>
                <td>
                    <label for="<?php echo $quote['code']; ?>">
                        <?php
                        //if($quant>1){
                            //if(substr($quote['title'],0,6)==="Nenhum") {
                                //echo "PAC. Entrega em 3 dias &uacute;teis";
                            //}else{
                                //echo $quote['title'];
                            //}
                        //}else{
                            echo $quote['title'];
                        //}
                        ?>
                    </label>
                </td>
                <td style="text-align: right;"><label for="<?php echo $quote['code']; ?>">
                <?php echo  $quote['text']; ?>
            </label></td>
            </tr>
            <?php } ?>
        <?php } else { ?>
        <tr>
            <?php
            if (strpos($shipping_method['error'], 'CEP de destino invalido') > 0) { ?>
                    <td colspan="3">
                    <div style="display: none; color: #8e8e8e"><span style="color: #ff7409; font-weight: bold;">*</span> Preencha o CEP para calculo do frete.</div>
                    <td>
            <?php } else { ?>
                {*<td style="width: 1px;">
                  <input type="radio" name="shipping_method" value="correios.41106" id="correios.41106" checked="checked" />
                <td><label for="<?php echo $quote['code']; ?>">PAC. Entrega em 3 dias &Uacute;teis</label></td>
                <td style="text-align: right;">
                <label for="correios.41106">
                R$ 20,00
                </label>
                </td>*}
            <?php } ?>
            </tr>
        <?php } ?>
    <?php } ?>
    </table>
<?php } ?>
<small style="color:#F00">Considerar de 1 até 3 dias úteis a mais para o prazo de produção do seu pedido</small>
