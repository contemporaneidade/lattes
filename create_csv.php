<?php

$dir    = "../scielo/files/artigos/html/";
$files 	= scandir($dir);
$output	= "output/output_".date("Ymd_His").".csv";

$handle = fopen($output, 'w+');
fwrite($handle, "id; url; artigo\n");

for ($i = 2; $i < sizeof($files); ++$i) {
	$handle2 = @fopen($dir.$files[$i], "r");
	if ($handle2) {
		while (!feof($handle2)) {
			$buffer = fgets($handle2, 4096);
			
			$pattern = '/http:\/\/lattes\.cnpq\.br\/([0-9]*)/';
			if (preg_match($pattern, $buffer, $arr)) {
				fwrite($handle, $arr[0]."; ".$arr[1]."; ".$files[$i]."\n");
			}
		}
	}
	fclose($handle2);
}
fclose($handle);
echo "[OK]";

?>