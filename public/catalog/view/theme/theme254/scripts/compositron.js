;(function(jQuery, window){
    var Compositron = function(){};

    Compositron.prototype.render = function($element, callback) {
        var $containers = $element.find('.layout-map-group'),
            gCanvas = document.createElement('canvas'),
            gHeight = parseInt($element.outerHeight(), 10),
            gWidth = parseInt($element.outerWidth(), 10),
            controlIndex = 0,
            controlMax = $containers.length;

        var gCtx = gCanvas.getContext('2d');

        gCanvas.width = gWidth;
        gCanvas.height = gHeight;

        var paramsHtml = [
            '<input type="hidden" name="c_width" value="' + gWidth + '">',
            '<input type="hidden" name="c_height" value="' + gHeight + '">'
        ];

        $containers.each(function(){
            var $container = $(this),
                bounds = {
                    width: $container.outerWidth(),
                    height: $container.outerHeight()
                },
                $img = $container.find('img'),
                top = parseInt($container.css('top').replace('px', ''), 10),
                left = parseInt($container.css('left').replace('px', ''), 10);

            var imgHtml = [
                '<input type="hidden" name="cm_top[]" value="' + top + '">',
                '<input type="hidden" name="cm_left[]" value="' + left + '">',
                '<input type="hidden" name="cm_width[]" value="' + bounds.width + '">',
                '<input type="hidden" name="cm_height[]" value="' + bounds.height + '">',
            ];

            if ($img.length > 0) {
                var imgProps = {
                        top: Math.ceil(parseInt($img.attr('data-top'), 10)),
                        left: Math.ceil(parseInt($img.attr('data-left'), 10)),
                        width: Math.ceil(parseInt($img.attr('data-width'), 10)),
                        height: Math.ceil(parseInt($img.attr('data-height'), 10)),
                        rotate: ($img.attr('data-rotate')) ? Math.PI * parseFloat($img.attr('data-rotate')) / 180 : 0,
                        src: $img.attr('src')
                    };

                imgProps.center = {x: Math.ceil(imgProps.width / 2), y: Math.ceil(imgProps.height / 2)};
                bounds.center = {x: Math.ceil(bounds.width / 2), y: Math.ceil(bounds.height / 2)};

                var posCanvas = document.createElement('canvas');
                var posCtx = posCanvas.getContext('2d');
                posCanvas.width = bounds.width;
                posCanvas.height = bounds.height;

                var img = document.createElement('img');
                img.src = imgProps.src;
                img.onload = function(){
                    var c,s;

                    c = Math.cos(imgProps.rotate);
                    s = Math.sin(imgProps.rotate);
                    if (s < 0) {
                        s = -s;
                    }
                    if (c < 0) {
                        c = -c;
                    }
                    var rotatedWidth = Math.floor(img.height * s + img.width * c);
                    var rotatedHeight = Math.floor(img.height * c + img.width * s);
                    var propRotatedWidth = Math.floor(imgProps.height * s + imgProps.width * c);
                    var propRotatedHeight = Math.floor(imgProps.height * c + imgProps.width * s);


                    var imgCanvas = document.createElement('canvas');
                    var imgCtx = imgCanvas.getContext('2d');
                    imgCanvas.width = rotatedWidth;
                    imgCanvas.height = rotatedHeight;

                    imgCtx.save();
                    imgCtx.translate(rotatedWidth/2, rotatedHeight/2);
                    imgCtx.rotate(imgProps.rotate);
                    imgCtx.drawImage(img, -img.width/2, -img.height/2);

                    imgCtx.restore();

                    var originalLeft = rotatedWidth * imgProps.left / propRotatedWidth;
                    var originalTop = rotatedHeight * imgProps.top / propRotatedHeight;

                    var conversionX = Math.floor((propRotatedWidth - imgProps.width) / 2);
                    var conversionY = Math.floor((propRotatedHeight - imgProps.height) / 2);

                    imgProps.left = imgProps.left - conversionX;
                    imgProps.top = imgProps.top - conversionY;

                    console.log('Rotate Width'+rotatedWidth);
                    console.log('Rotate Height'+rotatedHeight);
                    console.log('Img Left'+imgProps.left);
                    console.log('Img Top'+imgProps.top);
                    console.log('Prop Rotate Width'+propRotatedWidth);
                    console.log('Prop Rotate Height'+propRotatedHeight);
                    console.log('WidthImage'+img.width);
                    console.log('ImageHeight'+img.height);

                    posCtx.drawImage(
                        imgCanvas,
                        0,
                        0,
                        rotatedWidth,
                        rotatedHeight,
                        imgProps.left,
                        imgProps.top,
                        propRotatedWidth,
                        propRotatedHeight
                    );
                    gCtx.drawImage(posCanvas, left, top);

                    imgHtml.push('<input type="hidden" name="cmi_top[]" value="' + imgProps.top + '">');
                    imgHtml.push('<input type="hidden" name="cmi_left[]" value="' + imgProps.left + '">');
                    imgHtml.push('<input type="hidden" name="cmi_width[]" value="' + imgProps.width + '">');
                    imgHtml.push('<input type="hidden" name="cmi_height[]" value="' + imgProps.height + '">');
                    imgHtml.push('<input type="hidden" name="cmi_rotate[]" value="' + imgProps.rotate + '">');
                    imgHtml.push('<input type="hidden" name="cmi_src[]" value="' + imgProps.src + '">');

                    paramsHtml.push(imgHtml.join(''));

                    controlIndex++;
                    if (controlIndex === controlMax) {
                        callback(gCanvas, paramsHtml);
                    }
                };
            } else {
                controlIndex++;

                paramsHtml.push(imgHtml.join(''));

                if (controlIndex === controlMax) {
                    callback(gCanvas, paramsHtml);
                }
            }


        });
    };

    Compositron.prototype.mask = function(canvas, maskSrc, callback) {
        var imageCanvas = document.createElement('canvas');
        var imageCtx = imageCanvas.getContext('2d');

        var mask = document.createElement('img');
        mask.src = maskSrc;
        mask.onload = function() {
            imageCanvas.width  = mask.width;
            imageCanvas.height = mask.height;

            imageCtx.drawImage(mask, 0, 0, mask.width, mask.height);
            imageCtx.globalCompositeOperation = 'source-in';
            imageCtx.drawImage(canvas, 0, 0);

            callback(imageCanvas);
        }
    }

    window.Compositron = Compositron;
}($, window));
