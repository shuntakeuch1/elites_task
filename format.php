<?php
echo "正の整数を入力してください";
$m=trim(fgets(STDIN));
$m=(string)$m;
$strLen=mb_strlen($m);
echo "2以上の桁数を入力してください";
$n=trim(fgets(STDIN));
if($n<2){
echo "もう一度やり直してください";
exit;
}
$f="0";
for($i=1;$i<$n-$strLen;$i++){
$f="0".$f ;
}
echo $f.$m."\n";
?>
