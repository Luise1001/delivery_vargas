<?php


function ProductImg($rif_comercio, $foto, $files)
{
    $ruta = "../images/products/$rif_comercio/productos";
    $calidad = 20;

    if(file_exists($ruta))
    {
        $ruta .= '/';
        $img = imagejpeg(imagecreatefromstring(file_get_contents($files['file']["tmp_name"])), $ruta.$foto.'.jpg'); 
        $new_img = imagejpeg($img, $ruta, $calidad);
      
        return $new_img;
    }
    else
    {
        $result = mkdir($ruta, 0777, true);

        $ruta .= '/';
        $img = imagejpeg(imagecreatefromstring(file_get_contents($files['file']["tmp_name"])), $ruta.$foto.'.jpg'); 
        $new_img = imagejpeg($img, $ruta, $calidad);

        return $new_img;

    }

    return $ruta;

}

function ProfilePhoto($letter)
{
    $ruta = '../images/profile/letters'; 

    if(file_exists($ruta))
    {
        $foto = $ruta.'/'.$letter.'.jpg';
      if(!file_exists($foto))
      {
        $ruta .= '/';
        $image = imagecreate(512, 512);

        $r = rand(0,255) ;
        $g = rand(0,255) ;
        $b = rand(0,255) ;
        

        $r_t = rand(0,255) ;
        $g_t = rand(0,255) ;
        $b_t = rand(0,255) ;

        $text_color = imagecolorallocate($image, $r_t, $g_t, $b_t);
        $background_color = imagecolorallocate($image, $r, $g, $b);

        $font_path = __DIR__.'/times.ttf';

        imagefill($image, 0, 0, $background_color);
        imagettftext($image, 220, 0, 180, 300, $text_color, $font_path, $letter); 

        $filename = $ruta."$letter.jpg";
        imagejpeg($image, $filename);

        imagedestroy($image);
      }

    }
    else
    {
        $result = mkdir($ruta, 0777, true);

        $foto = $ruta.'/'.$letter.'.jpg';
        if(!file_exists($foto))
        {
          $ruta .= '/';
          $image = imagecreate(512, 512);
  
          $r = rand(0,255) ;
          $g = rand(0,255) ;
          $b = rand(0,255) ;
          
  
          $r_t = rand(0,255) ;
          $g_t = rand(0,255) ;
          $b_t = rand(0,255) ;
  
          $text_color = imagecolorallocate($image, $r_t, $g_t, $b_t);
          $background_color = imagecolorallocate($image, $r, $g, $b);
  
          $font_path = __DIR__.'/times.ttf';
  
          imagefill($image, 0, 0, $background_color);
          imagettftext($image, 220, 0, 180, 300, $text_color, $font_path, $letter); 
  
          $filename = $ruta."$letter.jpg";
          imagejpeg($image, $filename);
  
          imagedestroy($image);
        }

    }

}


function MyProfilePhoto($id, $foto, $files)
{
  
    $ruta = "../images/profile/users/$id/photo";
    $calidad = 30;

    if(file_exists($ruta))
    {
        $ruta .= '/';
        $img = imagejpeg(imagecreatefromstring(file_get_contents($files['file']["tmp_name"])), $ruta.$foto.'.jpg'); 
        $new_img = imagejpeg($img, $ruta, $calidad);
      
        return $new_img;
    }
    else
    {
        $result = mkdir($ruta, 0777, true);

        $ruta .= '/';
        $img = imagejpeg(imagecreatefromstring(file_get_contents($files['file']["tmp_name"])), $ruta.$foto.'.jpg'); 
        $new_img = imagejpeg($img, $ruta, $calidad);

        return $result;

    }

    return $ruta;

}

function SearchProfilePhoto($id, $foto)
{
    $ruta = "../images/profile/users/$id/photo/$foto.jpg";

    if(file_exists($ruta))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function DeletePhoto($foto)
{
    if(file_exists($foto))
    {
        unlink($foto);

        return true;
    }
    else
    {
        return false;
    }
}