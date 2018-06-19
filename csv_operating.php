<?php
/**
 * CSV 檔案寫入
 * @param  string $file        [description]
 * @param  array 	$headerdata  [description]
 * @param  two array 	$contentdata [description]
 * @return [type]              [description]
 */
function writecsv($file, $headerdata, $contentdata) {
	if (! file_exists($file)) {
		return 'error';
	}

	$fp = fopen($file, 'w');
	
	if (!empty($headerdata)) {
		fputs($fp,mb_convert_encoding(implode(",",$headerdata),"Big5","UTF-8")."\r\n"); //這是要轉成UTF-8編碼的語法
	}

	if (!empty($contentdata)) {
		foreach ($contentdata as $data) {
			fputs($fp,mb_convert_encoding(implode(",",$data),"Big5","UTF-8")."\r\n"); //這是要轉成UTF-8編碼的語法
		}
	}

	fclose($fp);
}

/**
 * 讀取csv檔
 * @param  [type] $file         [description]
 * @param  [type] $length       [description]
 * @param  [type] $parse_header [description]
 * @return [type]               [description]
 */
function readcsv($file, $length=8000, $parse_header=True) {
	if (! file_exists($file)) {
		return ;
	}

	$data = array();

	if (($handle = fopen($file, "r")) !== FALSE) {
		while (($result = fgetcsv($handle, $length, ",")) !== FALSE) {
			$data[] = $result;
		}
		fclose($handle);
	}

	return $data;
}