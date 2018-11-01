<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('subir_img_base64') ){

	function subir_img_base64($img, $dir, $name, $d){
	    $imgx = explode(',', $img);
		$img = end($imgx);
	    $sImagen = base64_decode($img);
	    $path = dirname(dirname(__DIR__))."/files/".$dir;
	    if( !file_exists($path) ){ mkdir($path); }
	    $path .= "/".$name;
	    @file_put_contents($path, $sImagen);
/*	    $aImage = @imageCreateFromPng( $path );
	    $nWidth  = $d[0];
	    $nHeight = $d[1];
	    $aSize = @getImageSize( $path );
	    if( $aSize[0] > $aSize[1] ){
	        $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
	    }else{
	        $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
	    }
	    $aThumb = @imageCreateTrueColor( $nWidth, $nHeight );
	    @imageCopyResampled( 
	    	$aThumb, $aImage, 
	    	0, 0, 
	    	0, 0, 
	    	$nWidth, $nHeight,
	    	$aSize[0], $aSize[1] 
	   	);
	    @imagepng( $aThumb, $path );
	    @imageDestroy( $aImage ); 
	    @imageDestroy( $aThumb );*/
	    return $name;
	}

}
