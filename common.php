<?php

public function jssdk(){
    global $signPackage;

	require_once ROOT_PATH."/jssdk.php";
	//开发者ID(AppID)
	$APPID = '**';
	//开发者秘钥(APPSECRET)
	$APPSECRET = '**';
	
	$jssdk = new JSSDK($APPID, $APPSECRET);
	$signPackage = $jssdk->GetSignPackage();
	
	//        echo json_encode($signPackage);die;
}

?>
