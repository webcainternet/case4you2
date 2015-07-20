<?php echo $header; ?>

<?php function product_template($id, $random_id, $no_image, $text_browse, $text_clear, $data = null) { ?>
    <div class="category-<?php echo $id; ?>-product category-product-wrapper">
        <br>
        <hr>
        <br>


        <a class="box-control expand" href="#">Expandir</a>


        <a href="#" class="js-remove-product">Remover produto</a>

        <div class="form-group">
            <label for="products_name[]">Nome</label>
            <input type="text" name="products_name[]" <?php if ($data) echo 'value="' . $data['name'] . '"'; ?>>
        </div>

        <div class="form-group">
            <label for="products_width[]">Largura (em px)</label>
            <input type="text" name="products_width[]" <?php if ($data) echo 'value="' . $data['width'] . '"'; ?>>
        </div>

        <div class="form-group">
            <label for="products_height[]">Altura (em px)</label>
            <input type="text" name="products_height[]" <?php if ($data) echo 'value="' . $data['height'] . '"'; ?>>
        </div>


        <div class="form-group">
            <label for="products_real_width[]">Largura Real(em px)</label>
            <input type="text" name="products_real_width[]" <?php if ($data) echo 'value="' . $data['real_width'] . '"'; ?>>
        </div>

        <div class="form-group">
            <label for="products_real_height[]">Altura Real(em px)</label>
            <input type="text" name="products_real_height[]" <?php if ($data) echo 'value="' . $data['real_height'] . '"'; ?>>
        </div>

        <div class="form-group">
            <label for="products_order[]">Order (quanto maior, mais importante)</label>
            <input type="text" name="products_order[]" <?php if ($data) echo 'value="' . $data['order'] . '"'; ?>>
        </div>

        <div class="form-group">
            <label for="custom_price[]">Preço customizado</label>
            <input type="text" name="custom_price[]" <?php if ($data) echo 'value="' . $data['custom_price'] . '"'; ?>>
        </div>

        <div class="form-group image-box-group">
            <label for="products_background[]">Background</label>
            <div class="image">
                <img src="<?php echo (!$data) ? $no_image : $data['background_preview']; ?>" alt="" id="products-thumbnail-background-<?php echo $random_id; ?>"/>
                <input type="hidden" id="products-background-<?php echo $random_id; ?>" name="products_background[]" value="<?php echo (!$data) ? $no_image : $data['background']; ?>" />
                <br />
                <a class="js-image-uploader" data-input="products-background-<?php echo $random_id; ?>" data-thumbnail="products-thumbnail-background-<?php echo $random_id; ?>"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="products-thumbnail-background-<?php echo $random_id; ?>">
                    <?php echo $text_clear; ?>
                </a>
            </div>
        </div>

        <div class="form-group image-box-group">
            <label for="products_overlay[]">Overlay</label>
            <div class="image">
                <img src="<?php echo (!$data) ? $no_image : $data['overlay_preview']; ?>" alt="" id="products-thumbnail-overlay-<?php echo $random_id; ?>"/>
                <input type="hidden" id="products-overlay-<?php echo $random_id; ?>" name="products_overlay[]" value="<?php echo (!$data) ? $no_image : $data['overlay']; ?>" />
                <br />
                <a class="js-image-uploader" data-input="products-overlay-<?php echo $random_id; ?>" data-thumbnail="products-thumbnail-overlay-<?php echo $random_id; ?>"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="products-thumbnail-overlay-<?php echo $random_id; ?>">
                    <?php echo $text_clear; ?>
                </a>
            </div>
        </div>

        <div class="form-group image-box-group">
            <label for="products_mask[]">Máscara</label>
            <div class="image">
                <img src="<?php echo (!$data) ? $no_image : $data['mask_preview']; ?>" alt="" id="products-thumbnail-mask-<?php echo $random_id; ?>"/>
                <input type="hidden" id="products-mask-<?php echo $random_id; ?>" name="products_mask[]" value="<?php echo (!$data) ? $no_image : $data['mask']; ?>" />
                <br />
                <a class="js-image-uploader" data-input="products-mask-<?php echo $random_id; ?>" data-thumbnail="products-thumbnail-mask-<?php echo $random_id; ?>"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="products-thumbnail-mask-<?php echo $random_id; ?>">
                    <?php echo $text_clear; ?>
                </a>
            </div>
        </div>
    </div>
<?php } ?>

<?php function layout_template($id, $random_id, $no_image, $text_browse, $text_clear, $proportion = null, $data = null) { ?>
    <?php
        if ($proportion) {
            $proportion = explode('x', $proportion);
            $tiles = array(
                $proportion[0] * 10 * 2,
                $proportion[1] * 10 * 2
            );
        } else {
            $tiles = array('{{width}}', '{{height}}');
        }

    ?>
    <div class="category-<?php echo $id; ?>-layout category-layout-wrapper">
        <br>
        <hr>
        <br>
        <a class="box-control expand" href="#">Expandir</a>
        <a href="#" class="js-remove-layout">Remover produto</a>

        <div class="form-group">
            <label for="layouts_name[]">Nome</label>
            <input type="text" name="layouts_name[]" <?php if ($data) echo 'value="' . $data['name'] . '"'; ?>>
        </div>

        <div class="form-group image-box-group">
            <label for="layouts_thumbnail[]">Thumbnail</label>
            <div class="image">
                <img src="<?php echo (!$data) ? $no_image : $data['thumbnail_preview']; ?>" alt="" id="layouts-thumbnail-thumbnail-<?php echo $random_id; ?>"/>
                <input type="hidden" id="layouts-thumbnail-<?php echo $random_id; ?>" name="layouts_thumbnail[]" value="<?php echo (!$data) ? $no_image : $data['thumbnail']; ?>" />
                <br />
                <a class="js-image-uploader" data-input="layouts-thumbnail-<?php echo $random_id; ?>" data-thumbnail="layouts-thumbnail-thumbnail-<?php echo $random_id; ?>"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="layouts-thumbnail-thumbnail-<?php echo $random_id; ?>">
                    <?php echo $text_clear; ?>
                </a>
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" class="layout-map-values" name="layouts_map[]" value="<?php echo (!$data) ? '[]' : $data['map']; ?>">
            <div class="layout-map" data-width="<?php echo $tiles[0]; ?>" data-height="<?php echo $tiles[1]; ?>" data-groups="0"></div>
        </div>
    </div>
<?php } ?>

<style>
    .builder4you-module-content {
        width: 70%;
        padding: 1em;
    }

    .builder4you-module .form-group {
        width: 100%;
        margin: 2em 0;
    }

    .builder4you-module label {
        font-size: 14px;
        font-weight: 700;
        display: block;
        width: 100%;
    }

    .builder4you-module input {
        width: 90%;
        padding: 0.5em;
        font-size: 16px;
    }

    .js-template {
        display: none;
    }

    .builder4you-module .image-box-group {
        display: inline-block;
        width: auto!important;
        margin-right: 1em;
    }

    .layout-map {
        overflow: hidden;
        box-sizing: border-box;
    }

    .map-tile {
        float: left;
        box-sizing: border-box;
        background: #fff;
        border: 1px solid #eee;
        cursor: pointer;
    }

    .map-tile.active {
        background: #888;
    }

    .map-tile:hover {
        background: #aaa;
    }

    .map-tile.grouped {
        background: #555;
        border: none;
    }

    .box-control {
        float: right;
    }

    .category-product-wrapper {
        height: 157px;
        overflow: hidden;
    }

    .category-layout-wrapper {
        height: 157px;
        overflow: hidden;
    }

    hr {
        border-width: 3px;
    }

</style>

<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>

    <?php if ($error_warning) { ?>
        <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>

    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
        </div>

        <div class="content builder4you-module">
            <div class="vtabs">
                <a href="#tab-module-create-category" id="module-create-category">Nova categoria</a>
                <a href="#tab-module-created-items" id="module-create-category">Items criados</a>
                <a href="#tab-module-newsletter" id="module-create-category">Emails cadastrados</a>

                <?php foreach($entries as $key => $value): ?>
                    <a href="#tab-module-category-<?php echo $key; ?>"><?php echo $value['name']; ?></a>
                <?php endforeach; ?>
            </div>

            <div class="builder4you-module-content">
                <div id="tab-module-create-category" class="vtabs-content">
                    <h2>Criar nova categoria de produto</h2>
                    <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="submit_type" value="create_category">

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name">
                        </div>

                        <div class="form-group">
                            <label for="price">Preço (não use separadores para os milhares)</label>
                            <input type="text" name="price">
                        </div>

                        <div class="form-group">
                            <label for="denomination">Denominação</label>
                            <input type="text" name="denomination">
                        </div>

                        <div class="form-group">
                            <label for="proportion">Proporção base</label>
                            <input type="text" name="proportion">
                        </div>

                        <div class="form-group">
                            <label for="icon">Ícone</label>
                            <div class="image">
                                <img src="<?php echo $no_image; ?>" alt="" id="new-category-thumbnail"/>
                                <input type="hidden" id="icon" name="icon" value="<?php echo $no_image; ?>" />
                                <br />
                                <a class="js-image-uploader" data-input="icon" data-thumbnail="new-category-thumbnail"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="new-category-thumbnail">
                                    <?php echo $text_clear; ?>
                                </a>
                            </div>
                        </div>

                        <button type="submit">Salvar</button>
                    </form>
                </div> <!-- #tab-module-create-category -->

                <div id="tab-module-created-items" class="vtabs-content">
                    <h2>Itens criados com a ferramenta</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($created_items as $item): ?>
                                <tr>
                                    <?php if ($item['payer']): ?>
                                        <td><?php echo $item['payer']['order_id'] ?></td>
                                        <td><?php echo $item['payer']['email'] ?></td>
                                        <td><?php echo $item['payer']['phone'] ?></td>
                                    <?php else: ?>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    <?php endif ?>
                                    <td><a href="<?php echo E_HTTP; ?>/index.php/?route=module/builder_4_you/download_product_pack&product_id=<?php echo $item['product_id']; ?>&token=<?php echo $item['token']; ?>" target="_blank">Link para imagens e informações de entrega</a></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div> <!-- #tab-module-created-items -->

                <div id="tab-module-newsletter" class="vtabs-content">
                    <h2>Email cadastrados para newsletter</h2>
                    <ul>
                        <?php foreach ($newsletters as $email): ?>
                            <li><?php echo $email['email']; ?></li>
                        <?php endforeach ?>
                    </ul>
                </div> <!-- #tab-module-newsletter -->

                <?php foreach($entries as $key => $value): ?>
                    <div id="tab-module-category-<?php echo $key; ?>" class="vtabs-content">
                        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="submit_type" value="update_category">
                            <input type="hidden" name="category_id" value="<?php echo $key; ?>">

                            <fieldset>
                                <legend>Informações da categoria</legend>

                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" value="<?php echo $value['name']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="proportion">Proporção base</label>
                                    <input type="text" name="proportion" value="<?php echo $value['proportion']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="price">Preço (não use separadores para os milhares)</label>
                                    <input type="text" name="price" value="<?php echo $value['price']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="denomination">Denominação</label>
                                    <input type="text" name="denomination" value="<?php echo $value['denomination']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="icon">Ícone</label>
                                    <div class="image">
                                        <img src="<?php echo $value['icon_preview']; ?>" alt="" id="category-<?php echo $key; ?>-thumbnail"/>
                                        <input type="hidden" id="category-<?php echo $key; ?>-icon" name="icon" value="<?php echo $value['icon']; ?>" />
                                        <br />
                                        <a class="js-image-uploader" data-input="category-<?php echo $key; ?>-icon" data-thumbnail="category-<?php echo $key; ?>-thumbnail"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="category-<?php echo $key; ?>-thumbnail">
                                            <?php echo $text_clear; ?>
                                        </a>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Produtos</legend>

                                <div class="form-group">
                                    <a href="#" class="js-add-product" data-category-id="<?php echo $key; ?>">Adicionar produto</a>
                                </div>

                                <div class="products-<?php echo $key; ?>">

                                    <?php foreach ($value['products'] as $product): ?>
                                        <?php
                                            $product_data = array(
                                                'name' => $product['name'],
                                                'background' => $product['background'],
                                                'background_preview' => $this->model_tool_image->resize($product['background'], 100, 100),
                                                'overlay' => $product['overlay'],
                                                'overlay_preview' => $this->model_tool_image->resize($product['overlay'], 100, 100),
                                                'mask' => $product['mask'],
                                                'mask_preview' => $this->model_tool_image->resize($product['mask'], 100, 100),
                                                'width' => $product['width'],
                                                'height' => $product['height'],
                                                'real_width' => $product['real_width'],
                                                'real_height' => $product['real_height'],
                                                'order' => $product['order'],
                                                'custom_price' => $product['custom_price']
                                            );
                                            $random_id = rand(0, 9999999);
                                        ?>

                                        <?php product_template($key, $random_id, $no_image, $text_browse, $text_clear, $product_data); ?>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Layouts</legend>

                                <div class="form-group">
                                    <a href="#" class="js-add-layout" data-category-id="<?php echo $key; ?>" data-proportion="<?php echo $value['proportion']; ?>">Adicionar layout</a>
                                </div>

                                <div class="layouts-<?php echo $key; ?>">

                                    <?php foreach ($value['layouts'] as $layout): ?>
                                        <?php
                                            $layout_data = array(
                                                'name' => $layout['name'],
                                                'thumbnail' => $layout['thumbnail'],
                                                'thumbnail_preview' => $this->model_tool_image->resize($layout['thumbnail'], 100, 100),
                                                'map' => $layout['map']
                                            );
                                            $random_id = rand(0, 9999999);
                                        ?>
                                        <?php layout_template($key, $random_id, $no_image, $text_browse, $text_clear, $value['proportion'], $layout_data); ?>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>

                            <button type="submit">Salvar</button>
                        </form>

                        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="submit_type" value="destroy_category">
                            <input type="hidden" name="category_id" value="<?php echo $key; ?>">
                            <button type="submit">Apagar categoria</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div> <!-- .builder4you-module-content -->
        </div> <!-- .content -->
    </div> <!-- .box -->
</div>

<div class="js-templates">
    <div class="js-template" id="product-template">
        <?php product_template('{{id}}', '{{random_id}}', $no_image, $text_browse, $text_clear); ?>
    </div>

    <div class="js-template" id="layout-template">
        <?php layout_template('{{id}}', '{{random_id}}', $no_image, $text_browse, $text_clear); ?>
    </div>
</div>

<script>

    function renderMap($el) {
        $el = $el.find('.layout-map');

        var width = $el.attr('data-width'),
            height = $el.attr('data-height'),
            tileSize = 10,
            widthSteps = Math.ceil(width / tileSize),
            heightSteps = Math.ceil(height / tileSize),
            i = 0,
            z = 0;

        $el.css({
            width: width,
            height: height
        });

        for (i = 0; i < heightSteps; i++) {
            for (z = 0; z < widthSteps; z++) {
                var $div = $('<div class="map-tile" data-x="' + z + '" data-y="' + i + '" data-group="no"></div>').css({
                    width: tileSize,
                    height: tileSize
                });

                $el.append($div);
            }
        }
    }

    function drawGroup($map, ix, iy, fx, fy, groupIndex) {
        var i = 0,
            z = 0,
            mapColors = ['#f0d57d', '#a54b8f', '#5fcb4d', '#5f7c2c', '#423d4f', '#1bf9f2', '#404640', '#f94a3c', '#02192d', '#e4eaa3', '#1c540c', '#616e40', '#f6bb7d', '#6562f9', '#2550b6', '#32f8ef', '#d50517', '#20b933', '#61a368', '#4384d0'];

        for (i = iy; i <= fy; i++) {
            for (z = ix; z <= fx; z++) {
                $map.find('.map-tile[data-x=' + z + '][data-y=' + i + ']').addClass('grouped').attr('data-group', groupIndex).css({
                    background: mapColors[groupIndex]
                });
            }
        }
    }

    function renderMaps() {
        $('.vtabs-content .layout-map').each(function(index, el){
            var $el = $(this).parent(),
                $this = $(this),
                map = $el.find('.layout-map-values').val();

            map = JSON.parse(map);


            renderMap($el);

            $.each(map, function(index, value){
                var init = value[0].split(';'),
                    fin = value[1].split(';'),
                    ix = init[0],
                    iy = init[1],
                    fx = fin[0],
                    fy = fin[1];

                drawGroup($el, ix, iy, fx, fy, index);

                $this.attr('data-groups', index);
            });
        });
    }

    $('body').on('click', '.js-image-eraser', function(e){
        e.preventDefault();

        var $this = $(this),
            input = $this.data('input'),
            $input = $('input[name=' + input + ']'),
            $thumb = $('#' + $this.data('thumbnail'));

        $thumb.attr('src', '<?php echo $no_image; ?>');
        $input.val('');
    });

    $('body').on('click', '.js-image-uploader', function(e){
        e.preventDefault();

        var $this = $(this),
            input = $this.data('input'),
            $input = $('#' + input),
            $thumb = $('#' + $this.data('thumbnail'));

        $('#dialog').remove();
        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(input) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

        $('#dialog').dialog({
            title: '<?php echo $text_image_manager; ?>',
            close: function (event, ui) {
                $.ajax({
                    url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($input.val()),
                    dataType: 'text',
                    success: function(data) {
                        $thumb.attr('src', data);
                    }
                });
            },
            bgiframe: false,
            width: 800,
            height: 400,
            resizable: false,
            modal: false
        });
    });

    $('body').on('click', '.js-add-product', function(e){
        e.preventDefault();

        var template = $('#product-template').html(),
            id = $(this).attr('data-category-id'),
            random = Math.floor(Math.random() * (99999 - 0 + 1)) + 0;

        template = template.replace(/\{\{id\}\}/g, id);
        template = template.replace(/\{\{random_id\}\}/g, random);

        $('.products-' + id).append($(template));
    });


    $('body').on('click', '.box-control', function(e){
        e.preventDefault();

        console.log('click');

        var $this = $(this);

        if ($this.hasClass('expand')) {
            $this
            .removeClass('expand')
            .addClass('retract')
            .html('Esconder')
            .parent()
             .css({ height: '100%' });

        } else if ($this.hasClass('retract')) {
            $this
            .html('Expandir')
            .addClass('expand')
            .removeClass('retract')
            .parent().css({ height: 153 });
        }

    });

    $('body').on('click', '.js-remove-product', function(e){
        e.preventDefault();
        $(this).parents('.category-product-wrapper').remove();
    });

    $('body').on('click', '.js-add-layout', function(e){
        e.preventDefault();

        var template = $('#layout-template').html(),
            id = $(this).attr('data-category-id'),
            proportion = $(this).attr('data-proportion'),
            random = Math.floor(Math.random() * (99999 - 0 + 1)) + 0;

        proportion = proportion.split('x');
        template = template.replace(/\{\{id\}\}/g, id);
        template = template.replace(/\{\{random_id\}\}/g, random);
        template = template.replace(/\{\{width\}\}/g, proportion[0] * 10 * 2);
        template = template.replace(/\{\{height\}\}/g, proportion[1] * 10 * 2);

        var $template = $(template);

        $template.appendTo('.layouts-' + id);
        renderMap($template);
    });

    $('body').on('click', '.map-tile', function(){
        var $this = $(this),
            $parent = $this.parent(),
            $active = $parent.find('.active'),
            $input = $parent.parent().find('input'),
            currentMap = JSON.parse($input.val()),
            group = $this.data('group'),
            x = parseInt($this.data('x'), 10),
            y = parseInt($this.data('y'), 10),
            currentGroup = parseInt($parent.attr('data-groups'), 10),
            currentX = null,
            currentY = null,
            i = 0,
            z = 0;

        if (group !== 'no') {
            alert('Para editar mapas de layout, o usuário deve apagar e criar outro.');
        } else {
            if ($active.length > 0) {
                currentY = parseInt($active.data('y'), 10);
                currentX = parseInt($active.data('x'), 10);

                var initialI = (currentY < y) ? currentY : y,
                    initialZ = (currentX < x) ? currentX : x,
                    finalI = (currentY < y) ? y : currentY,
                    finalZ = (currentX < x) ? x : currentX;

                drawGroup($parent, initialZ, initialI, finalZ, finalI, currentGroup);

                currentMap.push([initialZ + ';' + initialI, finalZ + ';' + finalI]);
                $input.val(JSON.stringify(currentMap));

                $parent.attr('data-groups', currentGroup + 1);
                $parent.find('.map-tile').removeClass('active');
            } else {
                console.log('nonactive');
                $this.addClass('active');
            }
        }
    });

    $('body').on('click', '.js-remove-product, .js-remove-layout', function(e){
        e.preventDefault();
        $(this).parent().remove();
    });

    $('.vtabs a').tabs();
    renderMaps();
</script>
<?php echo $footer; ?>
