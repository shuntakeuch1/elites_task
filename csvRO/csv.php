<?php
$filename = "sales.csv";
$handle = fopen($filename,"r");
$title = fgetcsv($handle);
while($array = fgetcsv($handle)){
  $a_sales[$array[0]]=$array[1];
}
//var_dump($a_sales);
$sum_sales = array_sum($a_sales);
$cnt =count($a_sales);
echo "社員数:{$cnt}\n";
echo "売上合計:{$sum_sales}\n";
echo "売上平均:".$sum_sales/$cnt."\n";
fclose($handle);

// CSV作成準備
$t_array = array("社員数","売上合計","売上平均");
$r_array = array($cnt,$sum_sales,$sum_sales/$cnt);

// CSV作成処理
$M_filename = "report.csv";
//  touch($M_filename);
$M_file = fopen($M_filename,"w");
fputcsv($M_file,$t_array);
fputcsv($M_file,$r_array);
fclose($M_file);

?>