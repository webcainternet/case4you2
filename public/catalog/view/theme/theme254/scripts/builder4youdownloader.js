$(document).ready(function(){
    map.width = Math.ceil(map.width);
    map.height = Math.ceil(map.height);

    for (var i = 0; i < map.components.length; i++) {
        console.log(i);
        map.components[i].image.src = map.components[i].image.src.replace('corau00e7u00e3o', 'coração');
        map.components[i].image.src = map.components[i].image.src.replace(/Cu00f3pia/gi, 'Cópia');
        map.components[i].image.src = map.components[i].image.src.replace(/&amp;/gi, '&');
    }

    var mapDesiredWidth = map.width * 3;
    var mapDesiredHeight = map.height * 3;
    var proportion = {
        width: Math.ceil(mapDesiredWidth / map.width),
        height: Math.ceil(mapDesiredHeight / map.height)
    };
    var i = 0;

    var controlIndex = 0;
    var controlMax = map.components.length;

    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');

    canvas.width = Math.ceil(map.width * proportion.width);
    canvas.height = Math.ceil(map.height * proportion.height);

    function renderOverlays(canvas) {
        var newCanvas = document.createElement('canvas');
        var newCtx = newCanvas.getContext('2d');

        var mask = document.createElement('img');
        mask.src = map.mask;
        mask.onload = function() {
            newCanvas.width  = map.width;
            newCanvas.height = map.height;

            newCtx.drawImage(mask, 0, 0, map.width, map.height);
            newCtx.globalCompositeOperation = 'source-in';
            newCtx.drawImage(canvas, 0, 0);

            canvas = newCanvas;

            newCanvas = document.createElement('canvas');
            newCtx = newCanvas.getContext('2d');

            var overlay = document.createElement('img');
            overlay.src = map.overlay;
            overlay.onload = function() {
                newCanvas.width  = map.width;
                newCanvas.height = map.height;

                newCtx.drawImage(overlay, 0, 0, map.width, map.height);
                newCtx.globalCompositeOperation = 'destination-over';
                newCtx.drawImage(canvas, 0, 0);

                canvas = newCanvas;

                newCanvas = document.createElement('canvas');
                newCtx = newCanvas.getContext('2d');

                var background = document.createElement('img');
                background.src = map.background;
                background.onload = function() {
                    newCanvas.width  = map.width;
                    newCanvas.height = map.height;

                    newCtx.drawImage(background, 0, 0, map.width, map.height);
                    newCtx.globalCompositeOperation = 'source-over';
                    newCtx.drawImage(canvas, 0, 0);

                    var filteredImage = '<img src="' + newCanvas.toDataURL() + '">';
                    $(filteredImage).appendTo('.rendered-file');
                }
            }
        }
    }

    function applyFilter(imageData, filter, callback) {
        $.ajax({
            url: baseUrl + 'index.php?route=module/builder_4_you/image_filter_apply_downloader',
            type: 'POST',
            data: { imgFilter: imageData, filter: filter },
            success: function(imgFiltered) {
                callback(imgFiltered);
            }
        });
    }

    function renderCanvas(canvas) {
        applyFilter(canvas.toDataURL(), map.filter, function(image){
            var printImage = '<img src="' + image + '">';
            $(printImage).appendTo('.print-file');

            var newCanvas = document.createElement('canvas');
            var newCtx = newCanvas.getContext('2d');

            var img = document.createElement('img');
            img.src = image;
            img.onload = function() {
                newCanvas.width = map.width;
                newCanvas.height = map.height;
                newCtx.drawImage(img, 0, 0, map.width, map.height);

                renderOverlays(newCanvas);
            };
        });
    }

    function loadImage(canvas, i) {
        var img;
        var component = map.components[i];

        var container = component.container;
        for (var cont in container) {
            container[cont] = container[cont] * proportion.width;
        }

        var image = component.image;
        for (img in image) {
            if (img !== 'src' && img !== 'rotate') {
                image[img] = image[img] * proportion.width;
            }
        }

        if (image.src !== '') {
            image.center = {
                x: Math.ceil(image.width / 2),
                y: Math.ceil(image.height / 2)
            };

            container.center = {
                x: Math.ceil(container.width / 2),
                y: Math.ceil(container.height / 2)
            };

            var cCanvas = document.createElement('canvas');
            var cCtx = cCanvas.getContext('2d');
            cCanvas.width = Math.ceil(container.width);
            cCanvas.height = Math.ceil(container.height);

            var originalImage = image.src.replace('corau00e7u00e3o', 'coração');
            originalImage =  image.src.replace(/Cu00f3pia/gi, 'Cópia');

            $('.original-images').append('<img src="' + originalImage + '">');

            img = document.createElement('img');
            img.src = originalImage;
            img.onload = function() {
                    var c,s;

                    c = Math.cos(image.rotate);
                    s = Math.sin(image.rotate);
                    if (s < 0) {
                        s = -s;
                    }
                    if (c < 0) {
                        c = -c;
                    }
                    var rotatedWidth = Math.floor(img.height * s + img.width * c);
                    var rotatedHeight = Math.floor(img.height * c + img.width * s);
                    var propRotatedWidth = Math.floor(image.height * s + image.width * c);
                    var propRotatedHeight = Math.floor(image.height * c + image.width * s);


                    var imgCanvas = document.createElement('canvas');
                    var imgCtx = imgCanvas.getContext('2d');
                    imgCanvas.width = rotatedWidth;
                    imgCanvas.height = rotatedHeight;

                    imgCtx.save();
                    imgCtx.translate(rotatedWidth/2, rotatedHeight/2);
                    imgCtx.rotate(image.rotate);
                    imgCtx.drawImage(img, -img.width/2, -img.height/2);

                    imgCtx.restore();

                    var originalLeft = rotatedWidth * image.left / propRotatedWidth;
                    var originalTop = rotatedHeight * image.top / propRotatedHeight;

                    var conversionX = Math.floor((propRotatedWidth - image.width) / 2);
                    var conversionY = Math.floor((propRotatedHeight - image.height) / 2);

                    image.left = image.left - conversionX;
                    image.top = image.top - conversionY;

                    console.log('Rotate Width'+rotatedWidth);
                    console.log('Rotate Height'+rotatedHeight);
                    console.log('Img Left'+image.left);
                    console.log('Img Top'+image.top);
                    console.log('Prop Rotate Width'+propRotatedWidth);
                    console.log('Prop Rotate Height'+propRotatedHeight);
                    console.log('WidthImage'+img.width);
                    console.log('ImageHeight'+img.height);

                    cCtx.drawImage(
                        imgCanvas,
                        0,
                        0,
                        rotatedWidth,
                        rotatedHeight,
                        image.left,
                        image.top,
                        propRotatedWidth,
                        propRotatedHeight
                    );
                    ctx.drawImage(cCanvas, container.left, container.top);


                //cCtx.translate(container.center.x, container.center.y);
                //cCtx.rotate(image.rotate);
                //cCtx.translate(-1 * container.center.x, -1 * container.center.y);

                //cCtx.drawImage(img, Math.ceil(image.left), Math.ceil(image.top), Math.ceil(image.width), Math.ceil(image.height));

                //ctx.drawImage(cCanvas, Math.ceil(container.left), Math.ceil(container.top));

                controlIndex++;
                if (controlIndex === controlMax) {
                    renderCanvas(canvas);
                }
            };
        } else {
            controlIndex++;
            if (controlIndex === controlMax) {
                renderCanvas(canvas);
            }
        }
    }

    for (i = 0; i < controlMax; i++) {
        loadImage(canvas, i);
    }
});

