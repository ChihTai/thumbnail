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

      $text_box=imagettfbbox(20,0,realpath("./font/times.ttf"),$code);
      $img_w=$text_box[2]+strlen($code)*10;
      $img_h=$text_box[7]*-1+35;  //定義字顯示區域高度,依照不同字體需要逐步調整
      $img=imagecreatetruecolor($img_w,$img_h);
      //利用字串長度來設定圖片寬度
      //$img=imagecreate(100,30);
      //$img_w=strlen($code)*12;
      //$img=imagecreate(100,30);
      //$img=imagecreate($img_w[2],30);
      //畫出圖形背景顏色
      $bg=imagecolorallocate($img,255,255,255);
      imagefill($img,0,0,$bg);

      $str_x=5;
      $str_y=0;

      for($i=0;$i<strlen($code);$i++){
      //imagecolorallocate — 为一幅图像分配颜色
      $color=imagecolorallocate($img,rand(50,200),rand(50,200),rand(50,200));

      //取得字元的四角座標位置
      $textbox=imagettfbbox(16,0,realpath("./font/times.ttf"),substr($code,$i,1));
//      imagestring($img,5,$str_x,$str_y,substr($code,$i,1),$color); //imagestring — 水平地画一行字符串

      //$textbox[7]*-1 是第四個位置的Y
      //計算在Y軸的位置
      $str_y=rand(0,15)+$textbox[7]*-1+10; //隨機給高度   //   4   3  圖形取位置的順序 第四個點是第三個點*-1
                                                      //   1   2
      //$textbox=imagettftext($img,16,0,$str_x,$str_y,$color,realpath("./font/times.ttf"),substr($code,$i,1)); //imagestring — 水平地画一行字符串      
      //print_r($textback);

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
      switch ($type) {
         case "1":
            //數字
            $code=$code . rand(0,9);
            break;
         case "2":
            $code=$code . chr(rand(97,122));
         break;      
         case "3":
            $code=$code . chr(rand(97,122));
         break; 
      }
   }
   return $code;
}
//echo code(10);
   



   //codepic($code);
?>
