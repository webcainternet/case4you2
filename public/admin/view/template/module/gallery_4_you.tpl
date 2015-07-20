<?php echo $header; ?>

<?php function item_template($id, $random_id, $no_image, $text_browse, $text_clear, $data = null) { ?>
    <div class="gallery-<?php echo $id; ?>-product gallery-product-wrapper">
        <br>
        <hr>
        <br>
        <a href="#" class="js-remove-item">Remover Imagem</a>

        <div class="form-group image-box-group">
            <label for="items_picture[]">Imagem</label>
            <div class="image">
                <img src="<?php echo (!$data) ? $no_image : $data['picture_preview']; ?>" alt="" id="items-thumbnail-picture-<?php echo $random_id; ?>"/>
                <input type="hidden" id="items-picture-<?php echo $random_id; ?>" name="items_picture[]" value="<?php echo (!$data) ? $no_image : $data['picture']; ?>" />
                <br />
                <a class="js-image-uploader" data-input="items-picture-<?php echo $random_id; ?>" data-thumbnail="items-thumbnail-picture-<?php echo $random_id; ?>"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="items-thumbnail-picture-<?php echo $random_id; ?>">
                    <?php echo $text_clear; ?>
                </a>
            </div>
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
        width: 100%;
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
                <a href="#tab-module-create-category" id="module-create-category">Nova galeria</a>

                <?php foreach($entries as $key => $value): ?>
                    <a href="#tab-module-category-<?php echo $key; ?>"><?php echo $value['name']; ?></a>
                <?php endforeach; ?>
            </div>

            <div class="builder4you-module-content">
                <div id="tab-module-create-category" class="vtabs-content">
                    <h2>Criar nova galeria</h2>
                    <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="submit_type" value="create_gallery">

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name">
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

                <?php foreach($entries as $key => $value): ?>
                    <div id="tab-module-category-<?php echo $key; ?>" class="vtabs-content">
                        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="submit_type" value="update_gallery">
                            <input type="hidden" name="gallery_id" value="<?php echo $key; ?>">

                            <fieldset>
                                <legend>Informações da galeria</legend>

                                <div class="form-group">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" value="<?php echo $value['name']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="icon">Ícone</label>
                                    <div class="image">
                                        <img src="<?php echo $value['icon_preview']; ?>" alt="" id="gallery-<?php echo $key; ?>-thumbnail"/>
                                        <input type="hidden" id="gallery-<?php echo $key; ?>-icon" name="icon" value="<?php echo $value['icon']; ?>" />
                                        <br />
                                        <a class="js-image-uploader" data-input="gallery-<?php echo $key; ?>-icon" data-thumbnail="gallery-<?php echo $key; ?>-thumbnail"><?php echo $text_browse; ?></a>  |  <a class="js-image-eraser" data-thumbnail="gallery-<?php echo $key; ?>-thumbnail">
                                            <?php echo $text_clear; ?>
                                        </a>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Imagens</legend>

                                <div class="form-group">
                                    <a href="#" class="js-add-item" data-gallery-id="<?php echo $key; ?>">Adicionar imagem</a>
                                </div>

                                <div class="items-<?php echo $key; ?>">
                                    <?php foreach ($value['items'] as $item): ?>
                                        <?php
                                            $item_data = array(
                                                'picture' => $item['picture'],
                                                'picture_preview' => $item['picture_preview']
                                            );
                                            $random_id = rand(0, 9999999);
                                        ?>

                                        <?php item_template($key, $random_id, $no_image, $text_browse, $text_clear, $item_data); ?>
                                    <?php endforeach; ?>
                                </div>
                            </fieldset>

                            <button type="submit">Salvar</button>
                        </form>

                        <form action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="submit_type" value="destroy_gallery">
                            <input type="hidden" name="gallery_id" value="<?php echo $key; ?>">
                            <button type="submit">Apagar galeria</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div> <!-- .builder4you-module-content -->
        </div> <!-- .content -->
    </div> <!-- .box -->
</div>

<div class="js-templates">
    <div class="js-template" id="item-template">
        <?php item_template('{{id}}', '{{random_id}}', $no_image, $text_browse, $text_clear); ?>
    </div>
</div>

<script>
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

    $('body').on('click', '.js-add-item', function(e){
        e.preventDefault();

        var template = $('#item-template').html(),
            id = $(this).attr('data-gallery-id'),
            random = Math.floor(Math.random() * (99999 - 0 + 1)) + 0;

        template = template.replace(/\{\{id\}\}/g, id);
        template = template.replace(/\{\{random_id\}\}/g, random);

        $('.items-' + id).append($(template));
    });

    $('body').on('click', '.js-remove-item', function(e){
        e.preventDefault();
        $(this).parent().remove();
    });

    $('.vtabs a').tabs();
</script>
<?php echo $footer; ?>
