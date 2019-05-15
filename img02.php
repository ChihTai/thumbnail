<?php
/***************************************
 imagecreatefrompng(source) 指定建立的圖檔類型，同型的函式有gif,jpeg
 imagesx(image),imagesy(image) 取得寬高
 imagecreatetruecolor(x,y) 建立全彩圖形資源
 imagecopyresampled(des,source,fx,fy,dx,dy,fw,fh,dw,dy);
    縮放圖形到目的圖形資源中
 imagejpeg(image,path) 將圖形資源存成jpeg，同型的函式有gif,png
 imagedestroy(image) 刪除圖形資源
 ***************************************/
//練習:製作一個圖形驗證碼機制



$code=code(4);

codepic($code);
?>

<img src="./code/login_code.png">


<?php


function codepic($code){
   
   //利用字串長度來設定圖片寬度
   $text_box=imagettfbbox(20,0,realpath("./font/times.ttf"),$code);
   $img_w=$text_box[2]+strlen($code)*10;
   $img_h=$text_box[7]*-1+35;
   $img=imagecreatetruecolor($img_w,$img_h);
   
   $bg=imagecolorallocate($img,255,200,255);

   imagefill($img,0,0,$bg);

   $str_x=5;
   $str_y=0;
   for($i=0;$i<strlen($code);$i++){

     $color=imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));

      //imagestring($img,5,$str_x,$str_y,substr($code,$i,1),$color);
      // image true type font bounding box 
      //取得毎個字元的四角坐標值
      
      $textbox=imagettfbbox(20,0,realpath("./font/times.ttf"),substr($code,$i,1));
      
      //計算字元在Y軸的位置
      $str_y=rand(0,15)+$textbox[7]*-1+10;
      
      //產生傾斜角度
      $angle=rand(-30,30);

      imagettftext($img,20,$angle,$str_x,$str_y,$color,realpath("./font/times.ttf"),substr($code,$i,1));
      
      //計算下一個字元在X軸的位置
      $str_x=$str_x+$textbox[2]+10;
   }


   imagepng($img,"./code/login_code.png");

}


function code($x){
   $code="";
   for($i=0;$i<$x;$i++){
      $type=rand(1,3);
      switch($type){
         case "1":
            //數字
            $code=$code . rand(0,9);
         break;
         case "2":
            //小寫英文
            $code=$code . chr(rand(97,122));
         break;
         case "3":
            //大寫英文
            $code=$code . chr(rand(65,90));
         break;
      }
   }

   return $code;
}

?>