<?php

  if(session_id()=='' || !isset($_SESSION)){
    session_start();
  }
  
  $captcha_num = rand(100000, 999999);
  $_SESSION['code'] = $captcha_num;
  
  $text = $_SESSION["code"];

  $my_img = imagecreate( 200, 60 );                             //width & height
  $background  = imagecolorallocate( $my_img, 246, 221, 204);
  $text_colour = imagecolorallocate( $my_img, 0, 0, 0);
  $line_colour = imagecolorallocate( $my_img, 255, 248, 220);
  imagestring( $my_img, 8, 30, 25, $text, $text_colour );
  imagesetthickness ( $my_img, 6 );
  imageline( $my_img, 30, 45, 165, 45, $line_colour );

  header( "Content-type: image/png" );
  imagepng( $my_img );
  imagecolordeallocate( $my_img, $line_colour );
  imagecolordeallocate( $my_img, $text_colour );
  imagecolordeallocate( $my_img, $background );
  imagedestroy( $my_img );
?> 