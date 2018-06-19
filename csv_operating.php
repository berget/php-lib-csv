<?php
/**
 * CSV 檔案寫入
 * @param  String $file        file a path String
 * @param  Array 	$headerdata  首列欄位的資料
 * @param  Two Array 	$contentdata 傳入兩層的陣列
 */
function writecsv($file, $headerdata, $contentdata) {

	$fp = fopen($file, 'w+');
	
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
 * @param  String $file         file a path String
 * @param  Int $length       要讀取的長度
 * @param  bool $parse_header 是否讀取第一列資訊
 * @return Array               回傳讀取結果
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