<?php

public function jssdk(){
    global $signPackage;

	require_once ROOT_PATH."/jssdk.php";
	$APPID = '**';
	$APPSECRET = '**';
	
	$jssdk = new JSSDK($APPID, $APPSECRET);
	$signPackage = $jssdk->GetSignPackage();
	
	//        echo json_encode($signPackage);die;
}

?>