$(document).ready(function(){
    /*
     * jQuery facebook api setup
     */
    $.ajaxSetup({ cache: true });

    $.getScript('//connect.facebook.net/pt_BR/all.js', function(){
        FB.init({ appId: fbAppId });
        $('#loginbutton,#feedbutton').removeAttr('disabled');
    });

    var currentTooltip = '';
    var $tooltip = false;

    $('body').on('click', 'a', function(e){
        if ($tooltip) {
            $tooltip.remove();
            $tooltip = false;
        }
    });

    if ($('.builder-4-you').length > 0) {
        /*
         * State control
         */
        var proportion = null,
            step = {
                width: 0,
                height: 0
            };

        function generateTooltip(position, text, css) {
            var $mytooltip = $(document.createElement('div'));
            $mytooltip.addClass('tooltip').addClass(position);
            $mytooltip.attr('role', 'tooltip');

            var tooltip = [
                '<div class="tooltip-arrow"></div>',
                '<div class="tooltip-inner">',
                text,
                '</div>',
            ].join('');

            $mytooltip.html(tooltip);

            var opacity = 1;

            if (css) {
                if (!css.opacity) {
                    css.opacity = opacity;
                }

                $mytooltip.css(css);
            } else {
                $mytooltip.css({
                    opacity: opacity
                });
            }

            return $mytooltip;
        }

        function createDraggableImage($container, nodrag) {
            var $this = $container,
                thumbnail = $this.attr('data-thumbnail'),
                original = $this.attr('data-original'),
                $img = $(document.createElement('img')),
                $loader = $this.find('span');

            $img.attr('src', thumbnail);

            console.log($this);

            if (currentTooltip === '' && $tooltip === false) {
                var offset = $this.offset();
                $tooltip = generateTooltip('right', 'Arraste a foto para o aparelho ao lado', {
                    top: 273,
                    left: 119,
                    width: 120
                });
                $this.append($tooltip);
                currentTooltip = 'drag-picture';
            }

            if (typeof $this.attr('data-external') !== 'undefined') {
                $.ajax({
                    url: baseUrl + 'index.php?route=module/builder_4_you/grab_external_image',
                    type: 'POST',
                    data: {
                        original: original,
                        thumbnail: thumbnail
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.thumbnail) {
                            $this.attr('data-thumbnail', data.thumbnail);
                            $this.attr('data-original', data.original);

                            $img = $(document.createElement('img'));
                            $img.attr('src', data.thumbnail);

                            if ($this.find('img').length < 1) {
                                $img.hide().appendTo($this);

                                $img.load(function(){
                                    $loader.fadeOut(200, function(){
                                        $loader.remove();
                                        $img.fadeIn(200);

                                        if (nodrag !== true) {
                                            $this.draggable({ helper: 'clone'} , "revert");
                                        }
                                    });
                                });
                            }
                        } else {
                            $this.parent().remove();
                        }

                    }
                });
            } else {
                if ($this.find('img').length < 1) {
                    $img.hide().appendTo($this);

                    $img.load(function(){
                        $loader.fadeOut(200, function(){
                            $loader.remove();
                            $img.fadeIn(200);

                            if (nodrag !== true) {
                                $this.draggable({ helper: 'clone'} , "revert");
                            } else {
                                $('.filter-picture-group li:first-child a').click();
                            }
                        });
                    });
                }
            }
        }

        function selectDevice($el) {
            var $this = $el,
                background = $this.data('background'),
                mask = $this.data('mask'),
                overlay = $this.data('overlay'),
                width = $this.data('width'),
                height = $this.data('height'),
                id = $this.data('id'),
                customPrice = $this.data('customprice'),
                modelName = $this.html(),
                parentName = $('.b4y-product-types .active').data('denomination'),
                price = $('.b4y-product-types .active').data('price'),
                productCategory = $('.b4y-product-types .active span').html();

            if (customPrice !== '') {
                price = customPrice;
            }

            price = price.toFixed(2);
            price = price.replace('.', ',');


            $('.b4y-devices a').removeClass('active');
            $this.addClass('active');

            $('.b4y-device-overlay').attr('src', overlay);
            $('.b4y-device-background').attr('src', background);
            $('.canvas-bg').attr('data-mask', mask);
            currentMask = mask;

            $('.b4y-device-container, .b4y-device-composition').css({
                width: width,
                height: height
            });

            $('.canvas-bg-enforcer').css({
                width: 950,
                height: 900
            });

            step.width = Math.ceil(width * 1.0 / proportion[0]);
            step.height = Math.ceil(height * 1.0 / proportion[1]);

            $('.js-product-name').html(modelName);
            $('.js-product-price').html('R$ ' + price);
            $('input[name=desc]').val(parentName + ' ' + modelName);
            $('input[name=type]').val(productCategory);
            $('input[name=product_id]').val(id);
        }

        function selectLayout($el) {
            var $this = $el,
                map = $this.attr('data-map'),
                $map = $(document.createElement('div')),
                id = $this.attr('data-id'),
                i = 0;

            if (typeof map === 'string') {
                map = JSON.parse(map);
            }

            $map.addClass('device-grid-container');

            $('.b4y-layouts a').removeClass('active');

            $this.addClass('active');

            for (i = 0; i < map.length; i++) {
                var item = map[i],
                    $group = $(document.createElement('div')),
                    thisLeft = Math.ceil(parseInt(item[0][0], 10)),
                    thisTop = Math.ceil(parseInt(item[0][1], 10)),
                    thisWidth = 0,
                    thisHeight = 0,
                    $groupFiller = $(document.createElement('div'));

                $group.addClass('layout-map-group');
                $group.attr('data-index', i);

                thisWidth = Math.ceil(parseInt(item[1][0], 10) - thisLeft + 1);
                thisHeight = Math.ceil(parseInt(item[1][1], 10) - thisTop + 1);

                $group.css({
                    left: thisLeft * step.width,
                    top: thisTop * step.height,
                    width: thisWidth * step.width,
                    height: thisHeight * step.height
                });

                $groupFiller.css({
                    position: 'absolute',
                    top: 0,
                    left: 0,
                    width: thisWidth * step.width,
                    height: thisHeight * step.height,
                    zIndex: 10
                });

                $group.append($groupFiller);

                $map.append($group);

                $('input[name=layout_id]').val(id);
                $('.layout-map-group img').remove();
            }

            $('.b4y-device-grid').html($map.html());
            $('.invisible-grid .layout-map-group').droppable({
                drop: function(event, ui) {
                    var $item = $(ui.helper),
                        $this = $(this),
                        $img = $(document.createElement('img'));

                    $img.attr('src', $item.attr('data-original'));

                    if (currentTooltip === 'drag-picture') {
                        if ($tooltip) {
                            $tooltip.remove();
                        }

                        $tooltip = generateTooltip('left', 'Clique duas vezes no quadrado com a foto para editar posicionamento, tamanho e rotação.', {
                            top: 273,
                            left: -180,
                            width: 180
                        });
                        $this.parents('.b4y-device-container').append($tooltip);
                        currentTooltip = 'dbl-click';
                    }


                    $this.html('');
                    $img.hide().appendTo($this);
                    $img.load(function(){
                        var width = $this.outerWidth(),
                            height = $this.outerHeight(),
                            sqrProp = width / height,
                            imgWidth = $img.outerWidth(),
                            imgHeight = $img.outerHeight(),
                            imgProp = imgWidth / imgHeight,
                            newWidth = 0,
                            newHeight = 0,
                            left = 0,
                            top = 0;

                        if (sqrProp < imgProp) {
                            // Nivela altura
                            newHeight = height;
                            newWidth = newHeight * imgWidth / imgHeight;
                            left = (newWidth - width) / 2 * -1;
                        } else if (sqrProp > imgProp) {
                            // Nivela larg
                            newWidth = width;
                            newHeight = imgHeight * newWidth / imgWidth;
                            top = (newHeight - height) / 2 * -1;
                        } else {
                            newWidth = width;
                            newHeight = height;
                        }

                        var newCss = {
                            width: newWidth,
                            height: newHeight,
                            top: top,
                            left: left
                        };

                        $img
                        .attr('data-top', top)
                        .attr('data-left', left)
                        .attr('data-width', newWidth)
                        .attr('data-height', newHeight)
                        .css(newCss)
                        .show();

                        refreshCanvas();
                    });
                }
            });
        }

        function createThumbnailUnit(thumbnail, original, external) {
            external = external || false;

            var result = '<li><a href="#" class="picture-container new-picture-container" data-original="' + original + '" data-thumbnail="' + thumbnail + '"';

            if (external) {
                result += ' data-external';
            }

            result += '><span class="js-loader-spinner"></span></a></li>';

            return result;
        }

        var ModalEditor = function(options) {
            this.options = {
                $target: options.$target.find('img'),
                $source: options.$source.find('img'),
                rotateIncrement: options.rotateIncrement || 15,
                moveIncrement: options.moveIncrement || 10,
                sizeIncrement: options.sizeIncrement || 10
            };

            this.$target = this.options.$target;
            this.$source = this.options.$source;
        };

        ModalEditor.prototype.getPreviousValue = function(key) {
            var previousValue = this.$target.attr('data-' + key);

            if (previousValue === undefined) {
                previousValue = this.$source.attr('data-' + key);

                if (previousValue === undefined) {
                    previousValue = '0';
                }
            }

            return parseInt(previousValue, 10);
        };

        ModalEditor.prototype.rotate = function(orientation) {
            var previousValue = this.getPreviousValue('rotate'),
                newValue = 0,
                increment = this.options.rotateIncrement;

            orientation = orientation || 'clockwise';

            if (orientation === 'anticlockwise') {
                increment *= -1;
            }

            newValue = previousValue + increment;

            this.$target
             .attr('data-rotate', newValue)
             .rotate(newValue);

            this.$source
             .attr('data-rotate', newValue)
             .rotate(newValue);
        };

        ModalEditor.prototype.move = function(directions) {
            var cssAttr = {},
                increment = this.options.moveIncrement,
                previousTop = this.getPreviousValue('top'),
                previousLeft = this.getPreviousValue('left');

            if (directions) {
                directions = {
                    vertical: directions.vertical,
                    horizontal: directions.horizontal
                };
            } else {
                directions = {
                    vertical: 'up',
                    horizontal: 'left'
                };
            }

            cssAttr = {
                top: previousTop,
                left: previousLeft
            };

            if (directions.vertical) {
                cssAttr.top = (directions.vertical === 'down') ? previousTop + increment : previousTop - increment;
            }

            if (directions.horizontal) {
                cssAttr.left = (directions.horizontal === 'right') ? previousLeft + increment : previousLeft - increment;
            }

            this.$target.attr('data-top', cssAttr.top).attr('data-left', cssAttr.left).css(cssAttr, 1);
            this.$source.attr('data-top', cssAttr.top).attr('data-left', cssAttr.left).css(cssAttr, 1);
        };

        ModalEditor.prototype.scale = function(orientation) {
            var increment = this.options.moveIncrement,
                operation = {},
                width = this.$target.outerWidth(),
                height = this.$target.outerHeight(),
                widthIncrement = increment,
                heightIncrement = height * widthIncrement / width,
                topIncrement = Math.ceil(widthIncrement / 2),
                leftIncrement = Math.ceil(heightIncrement /2),
                previousTop = this.getPreviousValue('top'),
                previousLeft = this.getPreviousValue('left'),
                previousWidth = this.getPreviousValue('width'),
                previousHeight = this.getPreviousValue('height');

            orientation = orientation || 'outwards';

            this.$source.css({
                width: previousWidth,
                height: previousHeight
            });

            if (orientation === 'outwards') {
                operation = {
                    width: previousWidth + widthIncrement,
                    height: previousHeight + heightIncrement,
                    top: previousTop - topIncrement,
                    left: previousLeft - leftIncrement
                };
            } else {
                operation = {
                    width: previousWidth - widthIncrement,
                    height: previousHeight - heightIncrement,
                    top: previousTop + topIncrement,
                    left: previousLeft + leftIncrement
                };
            }

            this.$target
            .attr('data-top', operation.top)
            .attr('data-left', operation.left)
            .attr('data-width', operation.width)
            .attr('data-height', operation.height)
            .animate(operation, 1);

            this.$source
            .attr('data-top', operation.top)
            .attr('data-left', operation.left)
            .attr('data-width', operation.width)
            .attr('data-height', operation.height)
            .animate(operation, 1);
        };

        var imagecanvasFilter = 'img';
        var currentMask = false;

        function refreshCanvas() {
            var comp = new Compositron();
            comp.render($('.invisible-grid'), function(canvas, params){
                $('.hidden-dynamic-inputs').html(params.join(''));
                comp.mask(canvas, currentMask, function(canvas) {
                    if (currentMask === false) {
                        currentMask = $('.b4y-devices .active').data('mask');
                    }

                    $('.canvas-bg').html('<img src="' + canvas.toDataURL() + '">');
                });
            });
        }

        $('body').on('keyup', 'input[name=device-picker]', function(e){
            var value = $(this).val().toLowerCase().split(''),
                i = 0;

            if (value.length > 0) {
                $('.b4y-devices a').each(function(){
                    var $this = $(this),
                        hasLetters = false;

                    for (i = 0; i < value.length; i++) {
                        hasLetters = ($this.html().toLowerCase().indexOf(value[i]) !== -1);

                        if (hasLetters === false) {
                            break;
                        }
                    }

                    if (hasLetters === true) {
                        $this.show();
                    } else {
                        $this.hide();
                    }
                });
            } else {
                $('.b4y-devices a').show();
            }
        });


        $('.filtro-btn').click(function(e){
            e.preventDefault();

            var $gridImage = $('.b4y-device-picture'),
                $tab = $('#filter-options');

            $tab.html('<span class="js-loader-spinner"></span>');

            var img = $('.canvas-bg img').attr('src');

            $.ajax({
                url: baseUrl + 'index.php?route=module/builder_4_you/image_filter_apply',
                type: 'POST',
                data: { imgFilter: img },
                success: function(imgFiltered) {
                    var i = 0,
                        ul = '<ul class="filter-picture-group picture-organizer group">';

                    for(i = 0; i < imgFiltered.length; i++) {
                        var imgf = imgFiltered[i];

                        ul += createThumbnailUnit(imgf.thumbnail, imgf.original);
                    }

                    ul += '</ul>';

                    $tab.fadeOut(200, function(){
                        $tab.html(ul).fadeIn(200, function(){
                            $('.filter-picture-group .picture-container').each(function(){
                                var $this = $(this);

                                createDraggableImage($this, true);
                            });
                        });
                    });
                }
            });
        });

        $('body').on('click', '.filter-picture-group a', function(e){
            e.preventDefault();
            var image = $(this).attr('data-original');

            $('.canvas-bg img').attr('src', image);
            $('input[name=image]').val(image);
        });

        /*
         * Social integration functions
         */
        function facebookAuth() {
            if (FB) {
                FB.login(function(response) {
                    if (response.authResponse) {
                        getFacebookPictures();
                    } else {
                        alert('É preciso que você autorize o aplicativo para usar suas fotos.');
                    }
                }, {
                    scope: 'email,user_photos'
                });
            }
        }

        function facebookShare() {
            var item = $('.b4yslider .active span').html();

            if (confirm('Gostaria de postar a imagem em sua timeline?')) {
                var postObject = {
                    "url": $('input[name=image]').val(),
                    "message": $('input[name=desc]').val() + " criada na case4you!",
                    "privacy": {
                        "value": "SELF"
                    }
                };

                if (FB) {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            postObject.access_token = response.authResponse.accessToken;
                            FB.api(
                                '/me/photos',
                                'POST',
                                postObject,
                                function(response) {
                                }
                            );
                        } else {
                            alert('É preciso que você autorize o aplicativo para compartilhar seu resultado.');
                        }
                    }, {
                        scope: 'publish_actions'
                    });
                }
            }
        }

        $('body').on('click', '.js-share-button', function(e){
            e.preventDefault();
            facebookShare();
        });

        function getFacebookPictures() {
            if (FB) {
                FB.api('/me/albums', function(response) {
                    var albums = response.data,
                        html = '<div class="header_container"><h3>Escolha o álbum</h3></div>',
                        i = 0;

                    for (i = 0; i < albums.length; i++) {
                        var album = albums[i];

                        var localHtml = [
                            '<div class="b4y-gallery-item">',
                                '<a href="#" class="b4y-gallery-item-wrapper js-facebook-open-album" data-id="' + album.id + '">',
                                    '<div class="b4y-fbcover-loading"><span class="js-loader-spinner"></span></div>',
                                    '<div class="b4y-gallery-title"><span>' + album.name + '</span></div>',
                                    '<span href="#" class="b4y-gallery-btn"></span>',
                                '</a>',
                            '</div>'
                        ].join('');

                        html += localHtml;
                    }

                    var $this = $('.js-facebook-auth');

                    if ($this.length < 1) {
                        $this = $('.js-facebook-back-to-albums');
                    }

                    $this.parents('.b4y-picture-box').fadeOut(200, function(){
                        $(this).html(html).fadeIn(200, function(){
                            $('.js-facebook-open-album').each(function(){
                                var $this = $(this),
                                    $loader = $this.find('.js-loader-spinner');

                                FB.api('/' + $this.data('id') + '/picture?type=album', function(response) {
                                    var $img = $(document.createElement('img'));
                                    $img.attr('src', response.data.url);
                                    $img.addClass('b4y-gallery-thumb');
                                    $img.attr('width', 90);

                                    $img.hide().appendTo($this.find('.b4y-fbcover-loading'));

                                    $img.load(function(){
                                        $loader.fadeOut(200, function(){
                                            $loader.remove();
                                            $img.fadeIn(200);
                                        });
                                    });
                                });
                            });
                        });
                    });
                });

            }
        }

        window.instagramCallback = function(token) {
            $.ajax({
                url: baseUrl + 'index.php?route=module/builder_4_you/get_instagram_photos',
                type: 'POST',
                data: {
                    token: token,
                },
                success: function(data) {
                    var $this = $('.js-instagram-auth'),
                        $pictures = $this.parents('.b4y-picture-box'),
                        i = 0,
                        ul = '<ul class="instagram-picture-group picture-organizer group">';

                    for (i = 0; i < data.entries.length; i++) {
                        var entry = data.entries[i];
                        entry = entry.images;
                        ul += createThumbnailUnit(entry.thumbnail.url, entry.standard_resolution.url, true);
                    }

                    ul += '</ul>';

                    $pictures.fadeOut(200, function(){
                        $pictures.html(ul).fadeIn(200, function(){
                            $('.instagram-picture-group .new-picture-container').each(function(){
                                var $this = $(this);
                                $this.removeClass('new-picture-container');

                                createDraggableImage($this);
                            });

                            if (data.raw.pagination && data.raw.pagination.next_max_id.length > 10) {
                                var $loadMoreBtn = $(document.createElement('a'));
                                $loadMoreBtn
                                .attr('href', '#')
                                .attr('class', 'auth-button auth-instagram js-instagram-more')
                                .attr('data-pagination', data.raw.pagination.next_url);

                                $loadMoreBtn.html('<span class="icon icon-instagram"></span><span class="auth-title">Carregar mais</span>');
                                $loadMoreBtn.appendTo('.b4y-insta-upload-box');
                            }
                        });
                    });
                }
            });
        }

        $('body').on('click', '.js-instagram-more', function(e){
            e.preventDefault();

            var $this = $(this),
                $pictures = $this.parents('.b4y-picture-box'),
                pagination = $this.attr('data-pagination');

            $this.remove();

            $.ajax({
                url: baseUrl + 'index.php?route=module/builder_4_you/get_instagram_photos',
                type: 'POST',
                data: {
                    pagination: pagination
                },
                success: function(data) {
                    var $this = $('.js-instagram-auth'),
                        $pictures = $this.parents('.b4y-picture-box'),
                        i = 0,
                        ul = '';

                    for (i = 0; i < data.entries.length; i++) {
                        var entry = data.entries[i];
                        entry = entry.images;
                        ul += createThumbnailUnit(entry.thumbnail.url, entry.standard_resolution.url, true);
                    }

                    $('.instagram-picture-group').append(ul);
                    $('.instagram-picture-group .new-picture-container').each(function(){
                        var $this = $(this);
                        $this.removeClass('new-picture-container');
                        createDraggableImage($this);
                    });

                    if (data.raw.pagination && data.raw.pagination.next_max_id.length > 10) {
                        var $loadMoreBtn = $(document.createElement('a'));
                        $loadMoreBtn
                        .attr('href', '#')
                        .attr('class', 'auth-button auth-instagram js-instagram-more')
                        .attr('data-pagination', data.raw.pagination.next_url);

                        $loadMoreBtn.html('<span class="icon icon-instagram"></span><span class="auth-title">Carregar mais</span>');
                        $loadMoreBtn.insertAfter('.instagram-picture-group');
                    }
                }
            });
        });

        function getGalleryPictures() {
            FB.api('/me/albums', function(response) {
                var albums = response.data,
                    html = '<ul class="facebook-picture-group picture-organizer group">',
                    i = 0;

                for (i = 0; i < albums.length; i++) {
                    var album = albums[i];

                    html += '<li><a href="#" class="js-facebook-open-album picture-container" data-id="' + album.id + '"><span class="js-loader-spinner"></span></a></li>';
                }

                html += '</ul>';

                var $this = $('.js-facebook-auth');

                if ($this.length < 1) {
                    $this = $('.js-facebook-back-to-albums');
                }

                $this.parents('.b4y-picture-box').fadeOut(200, function(){
                    $(this).html(html).fadeIn(200, function(){
                        $('.js-facebook-open-album').each(function(){
                            var $this = $(this),
                                $loader = $this.find('span');

                            FB.api('/' + $this.data('id') + '/picture?type=album', function(response) {
                                var $img = $(document.createElement('<img>'));
                                $img.attr('src', response.data.url);
				console.log(response);

                                $img.hide().appendTo($this);

                                $img.load(function(){
                                    $loader.fadeOut(200, function(){
                                        $loader.remove();
                                        $img.fadeIn(200);
                                    });
                                });
                            });
                        });
                    });
                });
            });
        }

        /*
         * Utility functions
         */
        function parseLayouts(layouts) {
            var newLayouts = [],
                i = 0,
                z = 0;

            for (i = 0; i < layouts.length; i++) {
                var layout = layouts[i],
                    newMap = [];

                if (typeof layout.map === 'string') {
                    layout.map = JSON.parse(layout.map.replace(/\\"/g, "\""));

                    for (z = 0; z < layout.map.length; z++) {
                        var mp = layout.map[z];

                        newMap.push([mp[0].split(';'), mp[1].split(';')]);
                    }

                    layout.map = newMap;
                }

                newLayouts.push(layout);
            }

            return newLayouts;
        }

        function renderToolOptions() {
            var $active = $('.b4yslider .active'),
                products = $active.data('products'),
                layouts = parseLayouts($active.data('layouts'));

            var productsHTML = '';
            for (var key in products) {
                var product = products[key];
                productsHTML += '<li><a href="#" data-id="' + product.id + '" data-background="' + product.background + '" data-overlay="' + product.overlay + '" data-mask="' + product.mask + '" data-width="' + product.width + '" data-height="' + product.height + '" data-customprice="' + product.custom_price + '">' + product.name + '</a></li>';
            }
            $('.b4y-devices').html(productsHTML);

            var layoutsHTML = '';
            for (var key in layouts) {
                var layout = layouts[key];
                layoutsHTML += "<li><a href=\"#\" data-id='" + layout.id + "' data-map='" + JSON.stringify(layout.map) + "'><img src=\"" + layout.thumbnail + "\" width=\"90\"></a></li>";
            }
            $('.b4y-layouts').html(layoutsHTML);

            proportion = $active.data('proportion').split('x');
            proportion[0] = parseInt(proportion[0], 10) * 2;
            proportion[1] = parseInt(proportion[1], 10) * 2;

            selectDevice($('.b4y-devices li:first-child a'));
            selectLayout($('.b4y-layouts li:first-child a'));
            refreshCanvas();
        }

        /*
         * Category carousel
         */
        $('.b4yslider').flexslider({
            animation: "slide",
            animationLoop: false,
            slideshow: false,
            itemWidth: 111,
            itemMargin: 5,
            minItems: 2,
            maxItems: 4,
            controlNav: false,
            prevText: '',
            nextText: ''
        });

        $('.b4yslider .slides a').click(function(e){
            e.preventDefault();
            $('.b4yslider a').removeClass('active');
            $(this).addClass('active');
            $('.b4y-device-container').fadeOut(200, function(){
                renderToolOptions();
                setTimeout(function(){
                    $('.b4y-device-container .canvas-bg').hide();
                    $('.b4y-device-container').fadeIn(200, function(){
                        refreshCanvas();
                        $('a[href=#product-options]').click();
                        $('a[href=#model-options]').click();
                        setTimeout(function(){
                            $('.b4y-device-container .canvas-bg').fadeIn(200);
                        }, 200);
                    });
                }, 100);
            });

        });

        /*
         * Rules in charge of "page changing"
         * Example: Produtos > Fotos; Modelo > Layout
         */
        $('a[data-stepper]').click(function(e){
            e.preventDefault();

            if (this.href.indexOf('filter-options') !== -1) {
                if ($('.layout-map-group img').length < 1) {
                    e.stopPropagation();
                    alert('É preciso usar pelo menos uma imagem para escolher um filtro.');
                    return false;
                }
            }

            var $this = $(this),
                target = $this.data('stepper'),
                $target = $('.' + target),
                offset = parseInt($(this).data('offset'), 10);

            $this.parents('ul').find('a').removeClass('active');

            $target.stop().animate({
                marginLeft: offset * -1
            }, 100, function(){
                $this.addClass('active');
            });
        });

        /*
         * Change device on thumbnail click
         */
        $('body').on('click', '.b4y-devices a', function(e){
            e.preventDefault();
            selectDevice($(this));
            selectLayout($('.b4y-layouts li:first-child a'));
            $('a[href=#layout-options]').click();
            refreshCanvas();
        });

        /*
         * Change product drag&drop layout
         */
        $('body').on('click', '.b4y-layouts a', function(e){
            e.preventDefault();
            selectLayout($(this));
            $('a[href=#picture-options]').click();
            refreshCanvas();
        });

        /*
         * Get pictures buttons
         */
        $('.js-instagram-auth').click(function(e){
            e.preventDefault();

            // $(this).find('.icon').removeClass('icon-instagram').addClass('icon-loader');

            var instagramURL = 'https://instagram.com/oauth/authorize/?client_id=' + instagramAppId + '&redirect_uri=' + baseUrl + 'index.php?route=module/builder_4_you/instagram_auth&response_type=token';

            var win = window.open(instagramURL, 'Puxe sua fotos do Instagram', "resizable=yes,width=645,height=530,menubar=false,toolbar=false");
        });

        $('body').on('click', '.js-facebook-auth', function(e){
            e.preventDefault();
            facebookAuth();
        });

        function renderFacebookImages(albumId, after) {
            $('.facebook-picture-group .new-picture-container').each(function(){
                var $this = $(this);
                $this.removeClass('new-picture-container');
                createDraggableImage($this);
            });

            if (after !== false) {
                var $loadMoreBtn = $(document.createElement('a'));
                $loadMoreBtn
                .attr('href', '#')
                .attr('class', 'auth-button auth-facebook js-facebook-more')
                .attr('data-album', albumId)
                .attr('data-after', after);

                $loadMoreBtn.html('<span class="icon icon-facebook"></span><span class="auth-title">Carregar mais</span>');
                $loadMoreBtn.insertAfter('.facebook-picture-group');
            }

        }

        function getFacebookAPIEntries($pictures, albumId, after, append) {
            var params = {
                limit: 21
            };

            if (after) {
                params.after = after;
            }

            FB.api('/' + albumId + '/photos', 'GET', params, function(response) {
                var photos = response.data,
                    i = 0;

                var ul = '';

                if (!append) {
                    ul = '<a href="#" class="js-facebook-back-to-albums b4y-back-button"><< Voltar</a>';
                    ul += '<ul class="facebook-picture-group picture-organizer group">';
                }


                for (i = 0; i < photos.length; i++) {
                    var photo = photos[i];
                    console.log(photo);
                    ul += createThumbnailUnit(photo.images[photo.images.length - 1].source, photo.source, true);
                }

                if (!append) {
                    ul += '</ul>';
                }

                var pagingAfter = false;
                if (response.paging && response.paging.next) {
                    pagingAfter = response.paging.cursors.after
                }


                if (!append) {
                    $pictures.fadeOut(200, function(){
                        $pictures.html(ul).fadeIn(200, function(){
                            renderFacebookImages(albumId, pagingAfter);
                        });
                    });
                } else {
                    $('.facebook-picture-group').append(ul);
                    setTimeout(function(){
                        renderFacebookImages(albumId, pagingAfter);
                    }, 1000);

                }
            });
        }

        $('body').on('click', '.js-facebook-more', function(e){
            e.preventDefault();

            var $this = $(this),
                $pictures = $this.parents('.b4y-picture-box'),
                albumId = $this.attr('data-album'),
                after = $this.attr('data-after');

            getFacebookAPIEntries($pictures, albumId, after, true);
            $this.remove();
        });

        $('body').on('click', '.js-facebook-open-album', function(e){
            e.preventDefault();

            var $this = $(this),
                $pictures = $this.parents('.b4y-picture-box'),
                albumId = $this.data('id');

            getFacebookAPIEntries($pictures, albumId);
        });

        var $galleryClone = $('.gallery-picture-box').clone();
        $('body').on('click', '.js-load-gallery', function(e){
            e.preventDefault();

            var $this = $(this),
                $pictures = $this.parents('.b4y-picture-box'),
                photos = $this.attr('data-pictures'),
                i = 0,
                ul = '<a href="#" class="js-gallery-back-to-albums b4y-back-button"><< Voltar</a>';
                ul += '<ul class="gallery-picture-group picture-organizer group">';

            if (typeof photos === 'string') {
                photos = JSON.parse(photos);
            };

            for (i = 0; i < photos.length; i++) {
                var photo = photos[i];
                ul += createThumbnailUnit(photo.thumbnail, photo.original);
            }

            ul += '</ul>';

            $pictures.fadeOut(200, function(){
                $pictures.html(ul).fadeIn(200, function(){
                    $('.gallery-picture-group .picture-container').each(function(){
                        var $this = $(this);
                        createDraggableImage($this);
                    });
                });
            });
        });

        $('body').on('click', '.js-gallery-back-to-albums', function(e){
            e.preventDefault();
            $('.gallery-picture-box').fadeOut(200, function(){
                $('.gallery-picture-container').html('');
                $galleryClone.hide().appendTo('.gallery-picture-container').fadeIn(200, function(){
                    $galleryClone = $('.gallery-picture-box').clone();
                });
            });
        });

        $('body').on('click', '.js-facebook-back-to-albums', function(e){
            e.preventDefault();
            getFacebookPictures();
        });

        $('body').on('click', '.picture-container', function(e){
            e.preventDefault();
        });

        var uploadedHtml = '';
        var firstUpload = true;
        var uploadTimeout = null;

        var uploadObj = {
            url: baseUrl + 'index.php/?route=module/builder_4_you/upload',
            dataType: 'json',
            done: function (e, data) {
                var pictures = data.result.files;
                for (var key in pictures) {
                    var pic = pictures[key];

                    uploadedHtml += createThumbnailUnit(pic.thumbnail_url, pic.url);
                }

                if (uploadTimeout !== null) {
                    clearTimeout(uploadTimeout);
                    uploadTimeout = null;
                }

                uploadTimeout = setTimeout(function(){
                    var $thisp = $('.js-upload-pictures'),
                        $container = $thisp.parents('.b4y-option-content').find('.b4y-picture-box');

                    if (firstUpload === true) {
                        uploadedHtml = '<ul class="picture-organizer">' + uploadedHtml + '</ul>';
                        $thisp.parents('.b4y-social-cta').slideUp(100, function(){
                            var $btn = $('.upload-btn-container').clone().addClass('pinned');
                            //O auth-button tem que pegar a classe pinned
                            $('.auth-uploader').addClass('pinned');
                            $container.parent().append($btn);
                            $('.js-upload-pictures').fileupload(uploadObj);
                            $(this).remove();
                        });
                    } else {
                        $container = $container.find('ul');
                    }

                    var $html = $(uploadedHtml);
                    var $span = $html.find('span');

                    $html.hide().appendTo($container).fadeIn(200, function(){
                        $span.each(function(){
                            createDraggableImage($(this).parent());
                        });
                    });

                    clearTimeout(uploadTimeout);
                    uploadTimeout = null;
                    firstUpload = false;
                    uploadedHtml = '';
                }, 200);
            },
            progressall: function (e, data) {},
            add: function (e, data) {
                var goUpload = true;
                var uploadFile = data.files[0];
                if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(uploadFile.name)) {
                    alert('Selecionar apenas imagens!');
                    goUpload = false;
                }
                if (uploadFile.size > 5000000) { // Set the file maximum size - 5mb
                    alert('Escolha imagens menores, o tamanho máximo é 5 MB!');
                    goUpload = false;
                }
                if (goUpload === true) {
                    data.submit();
                }
            }
        };

        $('.js-upload-pictures').fileupload(uploadObj);

        var shouldHideDeleteBtn = true;
        var hideDeleteBtnTimeout = null;

        $('body').on('mouseenter', '.visible-grid .layout-map-group div', function(){
            var $visible = $(this).parent(),
                index = $visible.attr('data-index'),
                $invisible = $('.invisible-grid .layout-map-group[data-index=' + index + ']'),
                $img = $invisible.find('img'),
                $deleteBtn = $(document.createElement('a'));

            $deleteBtn.attr('src', '#');
            $deleteBtn.addClass('js-b4y-pic-eliminator');
            $deleteBtn.attr('data-index', index);
            $deleteBtn.css({zIndex: 40});

            shouldHideDeleteBtn = false;

            if ($img.length > 0 && $visible.find('a').length < 1) {
                $visible.prepend($deleteBtn);
            }
        });

        $('body').on('mouseleave', '.visible-grid .layout-map-group', function(){
            var $visible = $(this),
                index = $visible.attr('data-index'),
                $invisible = $('.invisible-grid .layout-map-group[data-index=' + index + ']'),
                $img = $invisible.find('img');

            if ($visible.find('a').length > 0) {
                $visible.find('a').remove();
            }
        });

        $('body').on('click', '.js-b4y-pic-eliminator', function(e){
            e.preventDefault();
            e.stopPropagation();

            var $this = $(this),
                index = $this.attr('data-index'),
                $visible = $('.visible-grid .layout-map-group[data-index=' + index + ']'),
                $invisible = $('.invisible-grid .layout-map-group[data-index=' + index + ']');

            $invisible.html('');
            $this.remove();
            setTimeout(refreshCanvas, 150);
        });

        $('body').on('dblclick', '.visible-grid .layout-map-group', function(e){
            if (currentTooltip !== '' && $tooltip !== false) {
                $tooltip.remove();
                $tooltip = false;
                currentTooltip = 'done';
            }

            var $this = $(this);
            var index = $this.data('index');
            var $source = $('.invisible-grid .layout-map-group[data-index=' + index + ']');
            var $target = $source.clone();

            var modal = [
                    '<a href="#" class="close-edit" data-index="' + index + '"></a>',
                    '<div style="position: absolute; bottom:100px;width: 100%; text-align:center; font-size: 14px; font-weight: 700;">Por favor, certifique-se de que todo o quadrado de edição está preenchido após o ajuste da imagem</div>',
                    '<div class="b4y-device-container b4y-modal-device-container"></div>',
                    '<div class="edit-tools">',
                        '<div class="edit-tools-wrapper">',
                            '<div class="edit-toolbox">',
                                '<span class="toolbox-title">Mover</span>',
                                '<a href="#" class="toolbox-tool move-tool up-edit" data-vertical="up"></a>',
                                '<a href="#" class="toolbox-tool move-tool down-edit" data-vertical="down"></a>',
                                '<a href="#" class="toolbox-tool move-tool left-edit" data-horizontal="left"></a>',
                                '<a href="#" class="toolbox-tool move-tool right-edit" data-horizontal="right"></a>',
                            '</div>',
                            '<div class="edit-toolbox">',
                                '<span class="toolbox-title">Girar</span>',
                                '<a href="#" class="toolbox-tool rotate-tool rotateright-edit" data-orientation="clockwise"></a>',
                                '<a href="#" class="toolbox-tool rotate-tool rotateleft-edit" data-orientation="anticlockwise"></a>',
                            '</div>',
                            '<div class="edit-toolbox">',
                                '<span class="toolbox-title">Redimensionar</span>',
                                '<a href="#" class="toolbox-tool scale-tool plus-edit" data-orientation="outwards"></a>',
                                '<a href="#" class="toolbox-tool scale-tool minun-edit" data-orientation="inwards"></a>',
                            '</div>',
                            '<div class="edit-toolbox">',
                                '<span class="toolbox-title"></span>',
                                '<a href="#" class="toolbox-tool save-tool" data-index="' + index  + '"></a>',
                            '</div>',
                        '</div>',
                    '</div>'
                ].join('');

            var $modal = $(document.createElement('div'));

            $modal.addClass('b4y-edit-modal').html(modal);
            var $deviceContainer = $modal.find('.b4y-device-container');

            var dHeight = $('.b4y-column .b4y-device-container').outerHeight();
            var dWidth = $('.b4y-column .b4y-device-container').outerWidth();
            var bHeight = $('body').outerHeight() - 100;
            var bWidth = $('body').outerWidth();
            var toolbarHeight = 80;
            var dMargin = bHeight - dHeight - 80 - 100;
            var dContTop = (dMargin < 0) ? 0 : 100;

            if (dContTop < 10) {
                dContTop = 10;
            }

            $deviceContainer.css({
                width: dWidth,
                height: dHeight,
                marginTop: dContTop
            });

            var $appendDiv = $(document.createElement('div'));
            $appendDiv.addClass('b4y-modal-delimiter');

            $target
             .append($appendDiv)
             .appendTo($deviceContainer);

            var $deviceElementSingle = $deviceContainer.find('.layout-map-group');
            var dHeightElement = $('.invisible-grid .layout-map-group[data-index=' + index + ']').outerHeight();
            var dWidthElement = $('.invisible-grid .layout-map-group[data-index=' + index + ']').outerWidth();

            console.log(dWidthElement);

            $deviceElementSingle.css({
                width: dWidthElement,
                height: dHeightElement,
                marginLeft: dWidthElement / 2 * -1,
                marginTop: dHeightElement / 2 * -1
            });

            var editor = new ModalEditor({
                $target: $target,
                $source: $source
            });

            $modal.find('.rotate-tool').click(function(e){
                e.preventDefault();

                var $this = $(this),
                    orientation = $this.attr('data-orientation');

                editor.rotate(orientation);
            });

            $modal.find('.move-tool').click(function(e){
                e.preventDefault();

                var $this = $(this),
                    directions = {
                        vertical: $this.attr('data-vertical'),
                        horizontal: $this.attr('data-horizontal')
                    };

                editor.move(directions);
            });

            $modal.find('.scale-tool').click(function(e){
                e.preventDefault();

                var $this = $(this),
                    orientation = $this.attr('data-orientation');

                editor.scale(orientation);
            });

            $modal.hide().appendTo('body').fadeIn(200, function(){
                $source.hide();
                $('body').addClass('no-overflow');
                refreshCanvas();
            });
        });

        $('body').on('click', '.b4y-edit-modal .close-edit, .save-tool', function(e){
            e.preventDefault();

            var $this = $(this),
                index = $this.attr('data-index'),
                $source = $('.invisible-grid .layout-map-group[data-index=' + index + ']');

            $source.show();
            refreshCanvas();

            $('.b4y-edit-modal').fadeOut(200, function(){
                $(this).remove();
                $('body').removeClass('no-overflow');
            });
        });

        $('body').on('click', '.js-clear-pics', function(e){
            e.preventDefault();

            $('.layout-map-group img').remove();
            $('a[href=#picture-options]').click();

            setTimeout(refreshCanvas, 150);
        });


        $('.builder-4-you form').submit(function(e){
            if ($('.layout-map-group img').length !== $('.invisible-grid .layout-map-group').length) {
                e.preventDefault();
                e.stopPropagation();
                alert('É preciso que sejam preenchidos todos os espaços antes de comprar');
                return false;
            }

            if ($("input[name=image]").val() === '') {
                e.preventDefault();
                e.stopPropagation();
                $('a[href=#filter-options]').click();
                alert('Por favor, antes de comprar, verifique nossos filtros na barra esquerda. Caso não queira usar filtros, basta clicar de novo em "comprar".');
                return false;
            }
        });

        /*
         * Draw tool
         */
        renderToolOptions();

        if (window.location.hash && window.location.hash !== '') {
            var hashString = window.location.hash;
            hashString = hashString.replace('#', '');
            var $hash = $('img[alt=' + hashString + ']').parent();
            if ($hash.length > 0) {
                $hash.click();
            }
        }

    }
});
