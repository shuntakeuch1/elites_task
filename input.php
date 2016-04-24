<?php
echo "半角アルファベットの文字列を入力してください";
$s = trim(fgets(STDIN));
echo "正の整数を入力してください";
$n = trim(fgets(STDIN));
$strLen =mb_strlen($s);//文字列の長さを返す
if($n<$strLen){
$ans = substr("$s",$n-1,1);//s文字列のn列目を返す
}else{
$ans =$n."以下の正の整数を入力しでください";
}
echo "s=\"{$s}\",n=".$n."\"{$ans}\"\n" ;

?>
