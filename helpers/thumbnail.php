<?php
class ThumbnailHelper extends AppHelper {
	//TODO: Add show method using the HTML helper with image function
	var $thumb_dir = 'thumbs';
    function render($image,$params){
        //Set defaults
        $path='';
        $width=150;
        $height=225;
        $quality=75;
        $extension='jpg';
        //Extract Parameters
        if(isset($params['path'])){
            $path = $params['path'].DS;
        }
        if(isset($params['width'])){
            $width = $params['width'];
        }
        if(isset($params['height'])){
            $height = $params['height'];
        }
        if(isset($params['quality'])){
            $quality = $params['quality'];
        }
        if(isset($params['extension'])){
            $extension = $params['extension'];
        }
        //import phpThumb class
        App::import('Vendor','phpthumb', array('file' => 'phpThumb'. DS . 'phpthumb.class.php'));
		//App::import('Vendor', 'FirePHPDebugger', array('file' => 'FirePHP' . DS . 'FirePHP.debugger.php')); 
        $thumbNail = new phpthumb();
        $thumbNail->src = WWW_ROOT.IMAGES_URL.DS.$path.$image;
        $thumbNail->w = $width;
        $thumbNail->h = $height;
        $thumbNail->q = $quality;
        $thumbNail->config_imagemagick_path = '/usr/bin/convert';
        $thumbNail->config_prefer_imagemagick = true;
        $thumbNail->config_output_format = $extension;
        $thumbNail->config_error_die_on_error = false;
        $thumbNail->config_document_root = '';
        $thumbNail->config_temp_directory = APP . 'tmp';
        $thumbNail->config_cache_directory = WWW_ROOT.IMAGES_URL.DS.$path.$this->thumb_dir.DS;
        $thumbNail->config_cache_disable_warning = true;
        $cacheFilename = $width.'x'.$height.'_'.$image;
        $thumbNail->cache_filename = $thumbNail->config_cache_directory.$cacheFilename;
		//new Folder($thumbNail->config_cache_directory, true, 0777);
		
        if(!is_file($thumbNail->cache_filename)){
            if($thumbNail->GenerateThumbnail()) {
                $thumbNail->RenderToFile($thumbNail->cache_filename);
            }
        }
        if(is_file($thumbNail->cache_filename)){
            return $path.$this->thumb_dir.DS.$cacheFilename;
        }
        
    }
}
?>
