<?php

class B4YImageManipulation
{
    public function __construct(){}

    public function create_image($src) {
        $ctx = null;
        $file_extension = explode(".", $src);
        $file_extension = end($file_extension);
        $file_extension = strtolower($file_extension);
        $file_extension = str_replace('jpeg', 'jpg', $file_extension);
        switch ($file_extension) {
            case 'jpg':
                $ctx = imagecreatefromjpeg($src);
                break;

            case 'png':
                $ctx = imagecreatefrompng($src);
                break;

            case 'gif':
                $ctx = imagecreatefromgif($src);
                break;
        }
        return $ctx;
    }

    public function crop_image($ctx, $crop) {
        $dst = imagecreatetruecolor($crop['width'], $crop['width']);
        $success = imagecopy ( $dst , $ctx, 0, 0, $crop['x'], $crop['y'], $crop['width'], $crop['width']);

        if (!$success) {
            $dst = $success;
        }

        return $dst;
    }

    public function mask_image($ctx, $model) {
        $mask_path = $model . ".png";
        $mask = imagecreatefrompng($mask_path);

        $xSize = imagesx( $ctx );
        $ySize = imagesy( $ctx );
        $newPicture = imagecreatetruecolor( $xSize, $ySize );
        imagesavealpha( $newPicture, true );
        imagefill( $newPicture, 0, 0, imagecolorallocatealpha( $newPicture, 0, 0, 0, 127 ) );

        // Resize mask if necessary
        if( $xSize != imagesx( $mask ) || $ySize != imagesy( $mask ) ) {
            $tempPic = imagecreatetruecolor( $xSize, $ySize );
            imagecopyresampled( $tempPic, $mask, 0, 0, 0, 0, $xSize, $ySize, imagesx( $mask ), imagesy( $mask ) );
            imagedestroy( $mask );
            $mask = $tempPic;
        }

        // Perform pixel-based alpha map application
        for( $x = 0; $x < $xSize; $x++ ) {
            for( $y = 0; $y < $ySize; $y++ ) {
                $alpha = imagecolorsforindex( $mask, imagecolorat( $mask, $x, $y ) );
                $alpha = 127 - floor( $alpha[ 'red' ] / 2 );
                $color = imagecolorsforindex( $ctx, imagecolorat( $ctx, $x, $y ) );
                imagesetpixel( $newPicture, $x, $y, imagecolorallocatealpha( $newPicture, $color[ 'red' ], $color[ 'green' ], $color[ 'blue' ], $alpha ) );
            }
        }

        // Copy back to original picture
        imagedestroy( $ctx );
        $new_ctx = $newPicture;
        return $new_ctx;
    }

    public function filter_image($ctx) {
        imagealphablending( $ctx, false );
        imagesavealpha( $ctx, true );

        $name = date('Y-m-d H:i:s') . rand(1000, 9999);
        $name = md5($name);
        $filters_folder = DIR_IMAGE . '/data/builder4you/filtered';

        if (!is_dir($filters_folder)) {
            @mkdir($filters_folder);
        }


        $path_normal = $filters_folder . '/' . $name . ".png";
        $path_c40 = $filters_folder . '/' . $name . "_c40.png";
        $path_gray = $filters_folder . '/' . $name . "_gray.png";
        $path_sepia = $filters_folder . '/' . $name . "_sepia.png";

        $contrast_filter = $this->my_filter($ctx, array('contrast' => 0));
        imagepng($contrast_filter, $path_normal);

        $contrast2_filter = $this->my_filter($ctx, array('contrast' => -40));
        imagepng($contrast2_filter, $path_c40);

        $grayscale_filter = $this->my_filter($ctx, array('grayscale' => true));
        imagepng($grayscale_filter, $path_gray);

        $sepia_filter = $this->my_filter($ctx, array('colorize' => true, 'red' => 100, 'green' => 50, 'blue' => 0));
        imagepng($sepia_filter, $path_sepia);

        return array($path_normal, $path_c40, $path_gray, $path_sepia);
    }

    public function filter_image_downloader($ctx, $filter) {
        imagealphablending( $ctx, false );
        imagesavealpha( $ctx, true );

        $name = date('Y-m-d H:i:s') . rand(1000, 9999);
        $name = md5($name);
        $filters_folder = DIR_IMAGE . '/data/builder4you/filtered';

        if (!is_dir($filters_folder)) {
            @mkdir($filters_folder);
        }

        $image_path = '';

        switch ($filter) {
            case 'c40':
                $image_path = $filters_folder . '/' . $name . "_c40.jpg";
                $contrast2_filter = $this->my_filter($ctx, array('contrast' => -40));
                imagejpeg($contrast2_filter, $image_path);
                break;

            case 'gray':
                $image_path = $filters_folder . '/' . $name . "_gray.jpg";
                $grayscale_filter = $this->my_filter($ctx, array('grayscale' => true));
                imagejpeg($grayscale_filter, $image_path);
                break;

            case 'sepia':
                $image_path = $filters_folder . '/' . $name . "_sepia.jpg";
                $sepia_filter = $this->my_filter($ctx, array('colorize' => true, 'red' => 100, 'green' => 50, 'blue' => 0));
                imagejpeg($sepia_filter, $image_path);
                break;

            default:
                $image_path = $filters_folder . '/' . $name . ".jpg";
                $contrast_filter = $this->my_filter($ctx, array('contrast' => 0));
                imagejpeg($contrast_filter, $image_path);
                break;
        }

        return $image_path;
    }

    private function my_filter($ctx, $filter) {
        $defaults = array(
            'contrast' => 0,
            'grayscale' => false,
            'colorize' => false,
            'red' => 0,
            'green' => 0,
            'blue' => 0
        );

        $parameters = array_merge($defaults, $filter);

        if ($parameters['contrast'] != $defaults['contrast']) {
            imagefilter($ctx, IMG_FILTER_CONTRAST, $parameters['contrast']);
        }

        if ($parameters['grayscale']) {
            imagefilter($ctx, IMG_FILTER_GRAYSCALE);
        }

        if ($parameters['colorize']) {
            imagefilter($ctx, IMG_FILTER_COLORIZE, $parameters['red'], $parameters['green'], $parameters['blue']);
        }

        return $ctx;

    }

}

/*
 * jQuery File Upload Plugin PHP Class 6.4.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

class B4YUploadHandler {
    protected $options;
    // PHP File Upload error message codes:
    // http://php.net/manual/en/features.file-upload.errors.php
    protected $error_messages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload',
        'post_max_size' => 'The uploaded file exceeds the post_max_size directive in php.ini',
        'max_file_size' => 'File is too big',
        'min_file_size' => 'File is too small',
        'accept_file_types' => 'Filetype not allowed',
        'max_number_of_files' => 'Maximum number of files exceeded',
        'max_width' => 'Image exceeds maximum width',
        'min_width' => 'Image requires a minimum width',
        'max_height' => 'Image exceeds maximum height',
        'min_height' => 'Image requires a minimum height'
    );

    function __construct($options = null, $initialize = true, $error_messages = null) {
        $this->options = array(
            'script_url' => $this->get_full_url().'/',
            'upload_dir' => dirname($this->get_server_var('SCRIPT_FILENAME')).'/files/',
            'upload_url' => $this->get_full_url().'/files/',
            'user_dirs' => false,
            'mkdir_mode' => 0755,
            'param_name' => 'files',
            // Set the following option to 'POST', if your server does not support
            // DELETE requests. This is a parameter sent to the client:
            'delete_type' => 'DELETE',
            'access_control_allow_origin' => '*',
            'access_control_allow_credentials' => false,
            'access_control_allow_methods' => array(
                'OPTIONS',
                'HEAD',
                'GET',
                'POST',
                'PUT',
                'PATCH',
                'DELETE'
            ),
            'access_control_allow_headers' => array(
                'Content-Type',
                'Content-Range',
                'Content-Disposition'
            ),
            // Enable to provide file downloads via GET requests to the PHP script:
            'download_via_php' => false,
            // Defines which files can be displayed inline when downloaded:
            'inline_file_types' => '/\.(gif|jpe?g|png)$/i',
            // Defines which files (based on their names) are accepted for upload:
            'accept_file_types' => '/.+$/i',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => 5000000,
            'min_file_size' => 1,
            // The maximum number of files for the upload directory:
            'max_number_of_files' => null,
            // Image resolution restrictions:
            'max_width' => null,
            'max_height' => null,
            'min_width' => 1,
            'min_height' => 1,
            // Set the following option to false to enable resumable uploads:
            'discard_aborted_uploads' => true,
            // Set to true to rotate images based on EXIF meta data, if available:
            'orient_image' => false,
            'image_versions' => array(
                // Uncomment the following version to restrict the size of
                // uploaded images:
                /*
                '' => array(
                    'max_width' => 1920,
                    'max_height' => 1200,
                    'jpeg_quality' => 95
                ),
                */
                // Uncomment the following to create medium sized images:
                /*
                'medium' => array(
                    'max_width' => 800,
                    'max_height' => 600,
                    'jpeg_quality' => 80
                ),
                */
                'thumbnail' => array(
                    // Uncomment the following to force the max
                    // dimensions and e.g. create square thumbnails:
                    'crop' => true,
                    'max_width' => 150,
                    'max_height' => 150
                )
            )
        );
        if ($options) {
            $this->options = array_merge($this->options, $options);
        }
        if ($error_messages) {
            $this->error_messages = array_merge($this->error_messages, $error_messages);
        }
        if ($initialize) {
            $this->initialize();
        }
    }

    protected function initialize() {
        switch ($this->get_server_var('REQUEST_METHOD')) {
            case 'OPTIONS':
            case 'HEAD':
                $this->head();
                break;
            case 'GET':
                $this->get();
                break;
            case 'PATCH':
            case 'PUT':
            case 'POST':
                $this->post();
                break;
            case 'DELETE':
                $this->delete();
                break;
            default:
                $this->header('HTTP/1.1 405 Method Not Allowed');
        }
    }

    protected function get_full_url() {
        $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        return
            ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT']))).
            substr($_SERVER['SCRIPT_NAME'],0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
    }

    protected function get_user_id() {
        @session_start();
        return session_id();
    }

    protected function get_user_path() {
        if ($this->options['user_dirs']) {
            return $this->get_user_id().'/';
        }
        return '';
    }

    protected function get_upload_path($file_name = null, $version = null) {
        $file_name = $file_name ? $file_name : '';
        $version_path = empty($version) ? '' : $version.'/';
        return $this->options['upload_dir'].$this->get_user_path()
            .$version_path.$file_name;
    }

    protected function get_query_separator($url) {
        return strpos($url, '?') === false ? '?' : '&';
    }

    protected function get_download_url($file_name, $version = null) {
        if ($this->options['download_via_php']) {
            $url = $this->options['script_url']
                .$this->get_query_separator($this->options['script_url'])
                .'file='.rawurlencode($file_name);
            if ($version) {
                $url .= '&version='.rawurlencode($version);
            }
            return $url.'&download=1';
        }
        $version_path = empty($version) ? '' : rawurlencode($version).'/';
        return $this->options['upload_url'].$this->get_user_path()
            .$version_path.rawurlencode($file_name);
    }

    protected function set_file_delete_properties($file) {
        $file->delete_url = $this->options['script_url']
            .$this->get_query_separator($this->options['script_url'])
            .'file='.rawurlencode($file->name);
        $file->delete_type = $this->options['delete_type'];
        if ($file->delete_type !== 'DELETE') {
            $file->delete_url .= '&_method=DELETE';
        }
        if ($this->options['access_control_allow_credentials']) {
            $file->delete_with_credentials = true;
        }
    }

    // Fix for overflowing signed 32 bit integers,
    // works for sizes up to 2^32-1 bytes (4 GiB - 1):
    protected function fix_integer_overflow($size) {
        if ($size < 0) {
            $size += 2.0 * (PHP_INT_MAX + 1);
        }
        return $size;
    }

    protected function get_file_size($file_path, $clear_stat_cache = false) {
        if ($clear_stat_cache) {
            clearstatcache(true, $file_path);
        }
        return $this->fix_integer_overflow(filesize($file_path));

    }

    protected function is_valid_file_object($file_name) {
        $file_path = $this->get_upload_path($file_name);
        if (is_file($file_path) && $file_name[0] !== '.') {
            return true;
        }
        return false;
    }

    protected function get_file_object($file_name) {
        if ($this->is_valid_file_object($file_name)) {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = $this->get_file_size(
                $this->get_upload_path($file_name)
            );
            $file->url = $this->get_download_url($file->name);
            foreach($this->options['image_versions'] as $version => $options) {
                if (!empty($version)) {
                    if (is_file($this->get_upload_path($file_name, $version))) {
                        $file->{$version.'_url'} = $this->get_download_url(
                            $file->name,
                            $version
                        );
                    }
                }
            }
            $this->set_file_delete_properties($file);
            return $file;
        }
        return null;
    }

    protected function get_file_objects($iteration_method = 'get_file_object') {
        $upload_dir = $this->get_upload_path();
        if (!is_dir($upload_dir)) {
            return array();
        }
        return array_values(array_filter(array_map(
            array($this, $iteration_method),
            scandir($upload_dir)
        )));
    }

    protected function count_file_objects() {
        return count($this->get_file_objects('is_valid_file_object'));
    }

    protected function create_scaled_image($file_name, $version, $options) {
        $file_path = $this->get_upload_path($file_name);
        if (!empty($version)) {
            $version_dir = $this->get_upload_path(null, $version);
            if (!is_dir($version_dir)) {
                mkdir($version_dir, $this->options['mkdir_mode'], true);
            }
            $new_file_path = $version_dir.'/'.$file_name;
        } else {
            $new_file_path = $file_path;
        }
        if (!function_exists('getimagesize')) {
            error_log('Function not found: getimagesize');
            return false;
        }
        list($img_width, $img_height) = @getimagesize($file_path);
        if (!$img_width || !$img_height) {
            return false;
        }
        $max_width = $options['max_width'];
        $max_height = $options['max_height'];
        $scale = min(
            $max_width / $img_width,
            $max_height / $img_height
        );
        if ($scale >= 1) {
            if ($file_path !== $new_file_path) {
                return copy($file_path, $new_file_path);
            }
            return true;
        }
        if (!function_exists('imagecreatetruecolor')) {
            error_log('Function not found: imagecreatetruecolor');
            return false;
        }
        if (empty($options['crop'])) {
            $new_width = $img_width * $scale;
            $new_height = $img_height * $scale;
            $dst_x = 0;
            $dst_y = 0;
            $new_img = @imagecreatetruecolor($new_width, $new_height);
        } else {
            if (($img_width / $img_height) >= ($max_width / $max_height)) {
                $new_width = $img_width / ($img_height / $max_height);
                $new_height = $max_height;
            } else {
                $new_width = $max_width;
                $new_height = $img_height / ($img_width / $max_width);
            }
            $dst_x = 0 - ($new_width - $max_width) / 2;
            $dst_y = 0 - ($new_height - $max_height) / 2;
            $new_img = @imagecreatetruecolor($max_width, $max_height);
        }
        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                $image_quality = isset($options['jpeg_quality']) ?
                    $options['jpeg_quality'] : 75;
                break;
            case 'gif':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                $image_quality = null;
                break;
            case 'png':
                @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
                @imagealphablending($new_img, false);
                @imagesavealpha($new_img, true);
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                $image_quality = isset($options['png_quality']) ?
                    $options['png_quality'] : 9;
                break;
            default:
                $src_img = null;
        }
        $success = $src_img && @imagecopyresampled(
            $new_img,
            $src_img,
            $dst_x,
            $dst_y,
            0,
            0,
            $new_width,
            $new_height,
            $img_width,
            $img_height
        ) && $write_image($new_img, $new_file_path, $image_quality);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    protected function get_error_message($error) {
        return array_key_exists($error, $this->error_messages) ?
            $this->error_messages[$error] : $error;
    }

    function get_config_bytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val)-1]);
        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }
        return $this->fix_integer_overflow($val);
    }

    protected function validate($uploaded_file, $file, $error, $index) {
        if ($error) {
            $file->error = $this->get_error_message($error);
            return false;
        }
        $content_length = $this->fix_integer_overflow(intval(
            $this->get_server_var('CONTENT_LENGTH')
        ));
        $post_max_size = $this->get_config_bytes(ini_get('post_max_size'));
        if ($post_max_size && ($content_length > $post_max_size)) {
            $file->error = $this->get_error_message('post_max_size');
            return false;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            $file->error = $this->get_error_message('accept_file_types');
            return false;
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = $this->get_file_size($uploaded_file);
        } else {
            $file_size = $content_length;
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
            ) {
            $file->error = $this->get_error_message('max_file_size');
            return false;
        }
        if ($this->options['min_file_size'] &&
            $file_size < $this->options['min_file_size']) {
            $file->error = $this->get_error_message('min_file_size');
            return false;
        }
        if (is_int($this->options['max_number_of_files']) && (
                $this->count_file_objects() >= $this->options['max_number_of_files'])
            ) {
            $file->error = $this->get_error_message('max_number_of_files');
            return false;
        }
        list($img_width, $img_height) = @getimagesize($uploaded_file);
        if (is_int($img_width)) {
            if ($this->options['max_width'] && $img_width > $this->options['max_width']) {
                $file->error = $this->get_error_message('max_width');
                return false;
            }
            if ($this->options['max_height'] && $img_height > $this->options['max_height']) {
                $file->error = $this->get_error_message('max_height');
                return false;
            }
            if ($this->options['min_width'] && $img_width < $this->options['min_width']) {
                $file->error = $this->get_error_message('min_width');
                return false;
            }
            if ($this->options['min_height'] && $img_height < $this->options['min_height']) {
                $file->error = $this->get_error_message('min_height');
                return false;
            }
        }
        return true;
    }

    protected function upcount_name_callback($matches) {
        $index = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        $ext = isset($matches[2]) ? $matches[2] : '';
        return ' ('.$index.')'.$ext;
    }

    protected function upcount_name($name) {
        return preg_replace_callback(
            '/(?:(?: \(([\d]+)\))?(\.[^.]+))?$/',
            array($this, 'upcount_name_callback'),
            $name,
            1
        );
    }

    protected function get_unique_filename($name, $type, $index, $content_range) {
        while(is_dir($this->get_upload_path($name))) {
            $name = $this->upcount_name($name);
        }
        // Keep an existing filename if this is part of a chunked upload:
        $uploaded_bytes = $this->fix_integer_overflow(intval($content_range[1]));
        while(is_file($this->get_upload_path($name))) {
            if ($uploaded_bytes === $this->get_file_size(
                    $this->get_upload_path($name))) {
                break;
            }
            $name = $this->upcount_name($name);
        }
        return $name;
    }

    protected function trim_file_name($name, $type, $index, $content_range) {
        // Remove path information and dots around the filename, to prevent uploading
        // into different directories or replacing hidden system files.
        // Also remove control characters and spaces (\x00..\x20) around the filename:
        $name = trim(basename(stripslashes($name)), ".\x00..\x20");
        // Use a timestamp for empty filenames:
        if (!$name) {
            $name = str_replace('.', '-', microtime(true));
        }
        // Add missing file extension for known image types:
        if (strpos($name, '.') === false &&
            preg_match('/^image\/(gif|jpe?g|png)/', $type, $matches)) {
            $name .= '.'.$matches[1];
        }
        return $name;
    }

    protected function get_file_name($name, $type, $index, $content_range) {
        return $this->get_unique_filename(
            $this->trim_file_name($name, $type, $index, $content_range),
            $type,
            $index,
            $content_range
        );
    }

    protected function handle_form_data($file, $index) {
        // Handle form data, e.g. $_REQUEST['description'][$index]
    }

    protected function orient_image($file_path) {
        if (!function_exists('exif_read_data')) {
            return false;
        }
        $exif = @exif_read_data($file_path);
        if ($exif === false) {
            return false;
        }
        $orientation = intval(@$exif['Orientation']);
        if (!in_array($orientation, array(3, 6, 8))) {
            return false;
        }
        $image = @imagecreatefromjpeg($file_path);
        switch ($orientation) {
            case 3:
                $image = @imagerotate($image, 180, 0);
                break;
            case 6:
                $image = @imagerotate($image, 270, 0);
                break;
            case 8:
                $image = @imagerotate($image, 90, 0);
                break;
            default:
                return false;
        }
        $success = imagejpeg($image, $file_path);
        // Free up memory (imagedestroy does not delete files):
        @imagedestroy($image);
        return $success;
    }

    protected function handle_image_file($file_path, $file) {
        if ($this->options['orient_image']) {
            $this->orient_image($file_path);
        }
        $failed_versions = array();
        foreach($this->options['image_versions'] as $version => $options) {
            if ($this->create_scaled_image($file->name, $version, $options)) {
                if (!empty($version)) {
                    $file->{$version.'_url'} = $this->get_download_url(
                        $file->name,
                        $version
                    );
                } else {
                    $file->size = $this->get_file_size($file_path, true);
                }
            } else {
                $failed_versions[] = $version;
            }
        }
        switch (count($failed_versions)) {
            case 0:
                break;
            case 1:
                $file->error = 'Failed to create scaled version: '
                    .$failed_versions[0];
                break;
            default:
                $file->error = 'Failed to create scaled versions: '
                    .implode($failed_versions,', ');
        }
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
        $file = new stdClass();
        $file->name = $this->get_file_name($name, $type, $index, $content_range);
        $file->size = $this->fix_integer_overflow(intval($size));
        $file->type = $type;
        if ($this->validate($uploaded_file, $file, $error, $index)) {
            $this->handle_form_data($file, $index);
            $upload_dir = $this->get_upload_path();
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, $this->options['mkdir_mode'], true);
            }
            $file_path = $this->get_upload_path($file->name);
            $append_file = $content_range && is_file($file_path) &&
                $file->size > $this->get_file_size($file_path);
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                // multipart/formdata uploads (POST method uploads)
                if ($append_file) {
                    file_put_contents(
                        $file_path,
                        fopen($uploaded_file, 'r'),
                        FILE_APPEND
                    );
                } else {
                    move_uploaded_file($uploaded_file, $file_path);
                }
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                    $file_path,
                    fopen('php://input', 'r'),
                    $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = $this->get_file_size($file_path, $append_file);
            if ($file_size === $file->size) {
                $file->url = $this->get_download_url($file->name);
                list($img_width, $img_height) = @getimagesize($file_path);
                if (is_int($img_width)) {
                    $this->handle_image_file($file_path, $file);
                }
            } else {
                $file->size = $file_size;
                if (!$content_range && $this->options['discard_aborted_uploads']) {
                    unlink($file_path);
                    $file->error = 'abort';
                }
            }
            $this->set_file_delete_properties($file);
        }
        return $file;
    }

    protected function readfile($file_path) {
        return readfile($file_path);
    }

    protected function body($str) {
        echo $str;
    }

    protected function header($str) {
        header($str);
    }

    protected function get_server_var($id) {
        return isset($_SERVER[$id]) ? $_SERVER[$id] : '';
    }

    protected function generate_response($content, $print_response = true) {
        if ($print_response) {
            $json = json_encode($content);
            $redirect = isset($_REQUEST['redirect']) ?
                stripslashes($_REQUEST['redirect']) : null;
            if ($redirect) {
                $this->header('Location: '.sprintf($redirect, rawurlencode($json)));
                return;
            }
            $this->head();
            if ($this->get_server_var('HTTP_CONTENT_RANGE')) {
                $files = isset($content[$this->options['param_name']]) ?
                    $content[$this->options['param_name']] : null;
                if ($files && is_array($files) && is_object($files[0]) && $files[0]->size) {
                    $this->header('Range: 0-'.(
                        $this->fix_integer_overflow(intval($files[0]->size)) - 1
                    ));
                }
            }
            $this->body($json);
        }
        return $content;
    }

    protected function get_version_param() {
        return isset($_GET['version']) ? basename(stripslashes($_GET['version'])) : null;
    }

    protected function get_file_name_param() {
        return isset($_GET['file']) ? basename(stripslashes($_GET['file'])) : null;
    }

    protected function get_file_type($file_path) {
        switch (strtolower(pathinfo($file_path, PATHINFO_EXTENSION))) {
            case 'jpeg':
            case 'jpg':
                return 'image/jpeg';
            case 'png':
                return 'image/png';
            case 'gif':
                return 'image/gif';
            default:
                return '';
        }
    }

    protected function download() {
        if (!$this->options['download_via_php']) {
            $this->header('HTTP/1.1 403 Forbidden');
            return;
        }
        $file_name = $this->get_file_name_param();
        if ($this->is_valid_file_object($file_name)) {
            $file_path = $this->get_upload_path($file_name, $this->get_version_param());
            if (is_file($file_path)) {
                if (!preg_match($this->options['inline_file_types'], $file_name)) {
                    $this->header('Content-Description: File Transfer');
                    $this->header('Content-Type: application/octet-stream');
                    $this->header('Content-Disposition: attachment; filename="'.$file_name.'"');
                    $this->header('Content-Transfer-Encoding: binary');
                } else {
                    // Prevent Internet Explorer from MIME-sniffing the content-type:
                    $this->header('X-Content-Type-Options: nosniff');
                    $this->header('Content-Type: '.$this->get_file_type($file_path));
                    $this->header('Content-Disposition: inline; filename="'.$file_name.'"');
                }
                $this->header('Content-Length: '.$this->get_file_size($file_path));
                $this->header('Last-Modified: '.gmdate('D, d M Y H:i:s T', filemtime($file_path)));
                $this->readfile($file_path);
            }
        }
    }

    protected function send_content_type_header() {
        $this->header('Vary: Accept');
        if (strpos($this->get_server_var('HTTP_ACCEPT'), 'application/json') !== false) {
            $this->header('Content-type: application/json');
        } else {
            $this->header('Content-type: text/plain');
        }
    }

    protected function send_access_control_headers() {
        $this->header('Access-Control-Allow-Origin: '.$this->options['access_control_allow_origin']);
        $this->header('Access-Control-Allow-Credentials: '
            .($this->options['access_control_allow_credentials'] ? 'true' : 'false'));
        $this->header('Access-Control-Allow-Methods: '
            .implode(', ', $this->options['access_control_allow_methods']));
        $this->header('Access-Control-Allow-Headers: '
            .implode(', ', $this->options['access_control_allow_headers']));
    }

    public function head() {
        $this->header('Pragma: no-cache');
        $this->header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->header('Content-Disposition: inline; filename="files.json"');
        // Prevent Internet Explorer from MIME-sniffing the content-type:
        $this->header('X-Content-Type-Options: nosniff');
        if ($this->options['access_control_allow_origin']) {
            $this->send_access_control_headers();
        }
        $this->send_content_type_header();
    }

    public function get($print_response = true) {
        if ($print_response && isset($_GET['download'])) {
            return $this->download();
        }
        $file_name = $this->get_file_name_param();
        if ($file_name) {
            $response = array(
                substr($this->options['param_name'], 0, -1) => $this->get_file_object($file_name)
            );
        } else {
            $response = array(
                $this->options['param_name'] => $this->get_file_objects()
            );
        }
        return $this->generate_response($response, $print_response);
    }

    public function post($print_response = true) {
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
            return $this->delete($print_response);
        }
        $upload = isset($_FILES[$this->options['param_name']]) ?
            $_FILES[$this->options['param_name']] : null;
        // Parse the Content-Disposition header, if available:
        $file_name = $this->get_server_var('HTTP_CONTENT_DISPOSITION') ?
            rawurldecode(preg_replace(
                '/(^[^"]+")|("$)/',
                '',
                $this->get_server_var('HTTP_CONTENT_DISPOSITION')
            )) : null;
        $file_name = sha1($file_name . date('m/d/Y h:i:s a', time()));
        // Parse the Content-Range header, which has the following form:
        // Content-Range: bytes 0-524287/2000000
        $content_range = $this->get_server_var('HTTP_CONTENT_RANGE') ?
            preg_split('/[^0-9]+/', $this->get_server_var('HTTP_CONTENT_RANGE')) : null;
        $size =  $content_range ? $content_range[3] : null;
        $files = array();
        if ($upload && is_array($upload['tmp_name'])) {
            // param_name is an array identifier like "files[]",
            // $_FILES is a multi-dimensional array:
            foreach ($upload['tmp_name'] as $index => $value) {
                $files[] = $this->handle_file_upload(
                    $upload['tmp_name'][$index],
                    $file_name ? $file_name : $upload['name'][$index],
                    $size ? $size : $upload['size'][$index],
                    $upload['type'][$index],
                    $upload['error'][$index],
                    $index,
                    $content_range
                );
            }
        } else {
            // param_name is a single object identifier like "file",
            // $_FILES is a one-dimensional array:
            $files[] = $this->handle_file_upload(
                isset($upload['tmp_name']) ? $upload['tmp_name'] : null,
                $file_name ? $file_name : (isset($upload['name']) ?
                        $upload['name'] : null),
                $size ? $size : (isset($upload['size']) ?
                        $upload['size'] : $this->get_server_var('CONTENT_LENGTH')),
                isset($upload['type']) ?
                        $upload['type'] : $this->get_server_var('CONTENT_TYPE'),
                isset($upload['error']) ? $upload['error'] : null,
                null,
                $content_range
            );
        }
        return $this->generate_response(
            array($this->options['param_name'] => $files),
            $print_response
        );
    }

    public function delete($print_response = true) {
        $file_name = $this->get_file_name_param();
        $file_path = $this->get_upload_path($file_name);
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        if ($success) {
            foreach($this->options['image_versions'] as $version => $options) {
                if (!empty($version)) {
                    $file = $this->get_upload_path($file_name, $version);
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
            }
        }
        return $this->generate_response(array('success' => $success), $print_response);
    }

}

class Controllermodulebuilder4you extends Controller {
    public function record_newsletter() {
        $this->load->model('module/builder_4_you');

        $this->model_module_builder_4_you->record_newsletter($_POST['txtnews']);

        header('Content-type: application/json');
        echo json_encode(array('success' => true));
        exit;
    }

    public function send_contact_email() {
        $text = "Formulário de contato:\n\n";
        $text .= "Nome: " . $_POST['name'] . "\n";
        $text .= "Sobrenome: " . $_POST['surname'] . "\n";
        $text .= "Email: " . $_POST['email'] . "\n";
        $text .= "Mensagem:\n" . $_POST['message'];


        $subject = "Formulário de contato";

        $mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->hostname = $this->config->get('config_smtp_host');
        $mail->username = $this->config->get('config_smtp_username');
        $mail->password = $this->config->get('config_smtp_password');
        $mail->port = $this->config->get('config_smtp_port');
        $mail->timeout = $this->config->get('config_smtp_timeout');
        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_email'));
        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        $mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
        $mail->send();

        header('Content-type: application/json');
        echo json_encode(array('success' => true));
        exit;
    }

    public function download_product_pack() {
        // Instances
        $this->load->language('module/builder_4_you');
        $this->load->model('module/builder_4_you');
        $this->load->model('module/gallery_4_you');
        $this->load->model('tool/image');

        // Strings
        $strings = array();
        $text_strings = array(
                'heading_title',
        );

        foreach ($text_strings as $text) {
            $strings[$text] = $this->language->get($text);
            $this->data[$text] = $strings[$text];
        }

        $token = $_REQUEST['token'];
        $map = $this->model_module_builder_4_you->get_custom_product($_REQUEST['product_id'], $token);

        if ($map) {
            $this->data['map'] = $map;

            $date1 = date_create();
            $timestamp1 = date_timestamp_get($date1);
            $ramdomico4 = rand(1000,9999);
            $idsession = $timestamp1."".$ramdomico4;
            $idcsession = $idsession;
            $_SESSION["userid"] = $idsession;
            $this->data['idcsession'] = $idsession;

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/builder_4_you_downloader.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/module/builder_4_you_downloader.tpl';
            } else {
                $this->template = 'default/template/module/builder_4_you_downloader.tpl';
            }

            $this->response->setOutput($this->render());
        } else {
            echo "Não autorizado";
            exit;
        }
    }

    public function facebook_tab() {
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/builder_4_you_downloader.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/builder_4_you_facebook.tpl';
        } else {
            $this->template = 'default/template/module/builder_4_you_facebook.tpl';
        }

        $this->response->setOutput($this->render());
    }

    public function image_filter_apply_downloader() {
        $this->load->model('tool/image');

        $theme_path = '/catalog/view/theme/' . $this->config->get('config_template');
        $imgFiltered = $_POST["imgFilter"];

        $imgFiltered = explode('base64,', $imgFiltered);
        $imgFiltered = $imgFiltered[1];
        $imgFiltered = base64_decode($imgFiltered);
        $im = imagecreatefromstring($imgFiltered);

        if ($im !== false) {
            $manipulation = new B4YImageManipulation();
            $image = $manipulation->filter_image_downloader($im, $_POST['filter']);
            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];

            $image = explode('data', $image);
            $image = 'data' . $image[1];

            echo $this->model_tool_image->resize($image, $width, $height);
        }
        else {
            echo 'An error occurred.';
        }

        die();
    }

    public function image_filter_apply() {
        $this->load->model('tool/image');

        $theme_path = '/catalog/view/theme/' . $this->config->get('config_template');
        $imgFiltered = $_POST["imgFilter"];

        $imgFiltered = explode('base64,', $imgFiltered);
        $imgFiltered = $imgFiltered[1];
        $imgFiltered = base64_decode($imgFiltered);
        $im = imagecreatefromstring($imgFiltered);

        if ($im !== false) {
            $manipulation = new B4YImageManipulation();
            $images = $manipulation->filter_image($im);
            $parsed = array();

            foreach ($images as $image) {
                $size = getimagesize($image);
                $width = $size[0];
                $height = $size[1];

                $image = explode('data', $image);
                $image = 'data' . $image[1];
                $par = array(
                    'thumbnail' => $this->model_tool_image->resize($image, 120, 120 * $height / $width),
                    'original' => $this->model_tool_image->resize($image, $width, $height)
                );

                array_push($parsed, $par);
            }

            header('Content-type: application/json');
            echo json_encode($parsed);
        }
        else {
            echo 'An error occurred.';
        }

        die();
    }

    public function post_product() {
        $product_id = false;

        $this->load->model('module/builder_4_you');

        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {

            $user_input = array();
            foreach ($this->request->post as $key => $value) {
                $key = strip_tags($key);
                $key = trim($key);
                if (!is_array($value)) {
                    $value = strip_tags($value);
                    $value = trim($value);
                }
                $user_input[$key] = $value;
            }

            $product_id = $this->model_module_builder_4_you->create_product($user_input['idcsession'], $user_input['desc'], $user_input['image'], $user_input['type'], $user_input);
        }

        if ($product_id) {
            $date2 = date_create();
            $timestamp2 = date_timestamp_get($date2);
            $ramdomico2 = rand(1000,9999);
            $idsession = $timestamp2 . "" . $ramdomico2;
            $_SESSION["userid"] = $user_input['idcsession'];
            $idcsession = $idsession;

            $this->cart->add($product_id);

            header('Location: ' . HTTP_SERVER . '/index.php?route=checkout/cartcustom');
        } else {
            header('Location: ' . HTTP_SERVER);
        }

        exit;
    }

    public function index() {
        // Instances
        $this->load->language('module/builder_4_you');
        $this->load->model('module/builder_4_you');
        $this->load->model('module/gallery_4_you');
        $this->load->model('tool/image');

        // Strings
        $strings = array();
        $text_strings = array(
                'heading_title',
        );

        foreach ($text_strings as $text) {
            $strings[$text] = $this->language->get($text);
            $this->data[$text] = $strings[$text];
        }

        $this->data['title'] = 'Criar Capinhas Personalizadas | Case4You';
        $this->data['description'] = 'Criar Sua Capinha Personalizada Ficou Fácil. Escolha o Seu Modelo e USe Fotos do Facebook e Instagram!';
        $this->data['entries'] = $this->model_module_builder_4_you->get_entries();
        $this->data['galleries'] = $this->model_module_gallery_4_you->get_entries();

        $date1 = date_create();
        $timestamp1 = date_timestamp_get($date1);
        $ramdomico4 = rand(1000,9999);
        $idsession = $timestamp1."".$ramdomico4;
        $idcsession = $idsession;
        $_SESSION["userid"] = $idsession;
        $this->data['idcsession'] = $idsession;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/builder_4_you.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/builder_4_you.tpl';
        } else {
            $this->template = 'default/template/module/builder_4_you.tpl';
        }

        $this->children = array(
            'common/footer',
            'common/header',
            'common/content_top'
        );

        $this->response->setOutput($this->render());
    }

    public function instagram_auth() {
        $html = "<!doctype html>
                <html>
                    <head></head>
                    <body>
                        <p>Você está sendo redirecionado de volta para a case4you...<p>
                        <script>
                            opener.instagramCallback(window.location.hash.split('=')[1]);
                            self.close();
                        </script>
                    </body>
                </html>";
        $this->response->setOutput($html);
    }

    public function get_instagram_photos() {
        $entries = array();

        // Get cURL resource
        $curl = curl_init();

        $curl_url = '';

        if (array_key_exists('pagination', $_POST)) {
            $curl_url = $_POST['pagination'];
        } else {
            $curl_url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $_POST['token'];
        }

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $curl_url,
            CURLOPT_USERAGENT => 'case4you'
        ));
        // Send the request & save response to $resp
        $result = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);

        $parsed = json_decode($result, true);
        foreach ($parsed['data'] as $entry) {
            $image = $entry['images']['thumbnail'];
            if (strpos($image['url'], '.jpg') !== false) {
                array_push($entries, $entry);
            }
        }

        $rs = array(
            'entries' => $entries,
            'raw' => $parsed
        );

        header('Content-type: application/json');
        echo json_encode($rs);
        exit;
    }

    public function upload() {
        $options = array(
            'thumbnail' => array (
                'max_width' => 150,
                'max_height' => 150,
                'crop' => true
            ),
            'upload_dir' => DIR_IMAGE . 'data/builder4you/uploads/',
            'upload_url' => HTTP_SERVER . 'image/data/builder4you/uploads/'
        );
        $upload_handler = new B4YUploadHandler($options);
    }

    public function grab_external_image() {
        $this->load->model('tool/image');

        $original = str_replace('&amp;', '&', $_POST['original']);
        $thumbnail = str_replace('&amp;', '&', $_POST['thumbnail']);
        $dir = DIR_IMAGE . 'data/builder4you/social/';

        if (!is_dir($dir)) {
            @mkdir($dir);
        }

        $original_name = preg_replace('/[\/:\?=;\.]/i', '', $original);
        $thumbnail_name = preg_replace('/[\/:\?=;\.]/i', '', $thumbnail);

        $original_name = str_replace('jpg', '', $original_name);
        $original_name = str_replace('jpeg', '', $original_name);
        $original_name = str_replace('png', '', $original_name);
        $original_name = str_replace('gif', '', $original_name);

        $thumbnail_name = str_replace('jpg', '', $thumbnail_name);
        $thumbnail_name = str_replace('jpeg', '', $thumbnail_name);
        $thumbnail_name = str_replace('png', '', $thumbnail_name);
        $thumbnail_name = str_replace('gif', '', $thumbnail_name);

        $original_path = $dir . $original_name . '.jpg';
        $thumbnail_path = $dir . $thumbnail_name . '.jpg';

        if (!file_exists($original_path)) {
            copy($original, $original_path);
            copy($thumbnail, $thumbnail_path);
        } else {
            if (!file_exists($thumbnail_path)) {
                $thumbnail_path = $original_path;
            }
        }

        // header('Content-type: application/json');
        // echo json_encode(urldecode($original));
        // exit;

        $thumbnail_path = explode('data', $thumbnail_path);
        $thumbnail_path = 'data' . $thumbnail_path[1];

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $base_url = $this->config->get('config_ssl');
        } else {
            $base_url = $this->config->get('config_url');
        }

        $original_url = $base_url . 'image/data/builder4you/social/' . $original_name . '.jpg';

        $response = array(
            'original' => $original_url,
            'thumbnail' => $this->model_tool_image->resize($thumbnail_path, 90, 90)
        );

        header('Content-type: application/json');
        echo json_encode($response);
        exit;
    }
}

?>
