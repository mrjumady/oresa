<?php
function color($color = "default" , $text = null)
	{
    	$arrayColor = array(
    		'grey' 		=> '1;30',
    		'red' 		=> '1;31',
    		'green' 	=> '1;32',
    		'yellow' 	=> '1;33',
    		'blue' 		=> '1;34',
    		'purple' 	=> '1;35',
    		'nevy' 		=> '1;36',
    		'white' 	=> '1;0',
    	);	
    	return "\033[".$arrayColor[$color]."m".$text."\033[0m";
    }
function curl($url, $data = null, $headers = null, $proxy = null, $method = null, $header = null) {

	$ch = curl_init();
	$options = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => true,
                CURLOPT_COOKIEJAR => "cok1.txt",
                CURLOPT_COOKIEFILE => "cok1.txt",
	);

        if ($method != "") {
                $options[CURLOPT_CUSTOMREQUEST] = $method;
        }

	if ($data != "") {
		$options[CURLOPT_POST] = true;
		$options[CURLOPT_POSTFIELDS] = $data;
	}

	if ($proxy != "") {
		$options[CURLOPT_HTTPPROXYTUNNEL] =  true;
		$options[CURLOPT_PROXYTYPE] =  CURLPROXY_SOCKS4;
		$options[CURLOPT_PROXY] =  $proxy;
	}

	if ($headers != "") {
		$options[CURLOPT_HTTPHEADER] = $headers;
	}

	curl_setopt_array($ch, $options);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
	curl_close($ch);
	return $response;

}

function fetch_value($str,$find_start,$find_end) {
	$start = @strpos($str,$find_start);
	if ($start === false) {
		return "";
	}
	$length = strlen($find_start);
	$end    = strpos(substr($str,$start +$length),$find_end);
	return trim(substr($str,$start +$length,$end));
}

echo "Bot Refferal App Oresa\n";
echo "Spesial Thanks : Jumady, Muhammad Ikhsan Aprilyadi, Pandu Aji\n\n";

echo color('blue', "[?]")." Reff : ";
    $reff = trim(fgets(STDIN));
echo color('blue', "[?]")." Jumlah : ";
    $jum = trim(fgets(STDIN));
	for($a=0;$a<$jum;$a++){
		sleep (6);

	$regist = curl('http://mrjumady.me/api.php?reff='.$reff);
	$emails = fetch_value($regist,'"email":"','"');
	$msgRegist = fetch_value($regist,'"message":"','"');
		echo color('green', "[+]")." Registration Successfuly | ".$emails;
		echo "\n";
		echo color('green', "[+] ") . $msgRegist;
		echo "\n";
		echo color('yellow', "[+]")." Checking Email";
		echo "\n";
		ulang:
    $get = curl('https://getnada.com/api/v1/inboxes/'.$emails);
	$uid = fetch_value($get,'"uid":"','"');
		if($uid != ""){
	$getlink = curl('https://getnada.com/api/v1/messages/html/'.$uid);
	$link = fetch_value($getlink,'<a href="','" target="_blank">Verifikasi</a>');
	$gass = curl($link);
	echo color('green', "[+]")." Verification Successfuly\n";
	}else{
		goto ulang;
}
	}
