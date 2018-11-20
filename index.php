<?php 

require_once(ROOT_PATH."common.php");

?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>Title</title>
	</head>

	<body>
		<?php global $news,$signPackage;?> 地址位置测试
			
			
		<div id="address"></div>	
	</body>

	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script>
		wx.config({
			debug: false,
			appId: '<?php echo $signPackage["appId"];?>',
			timestamp: <?php echo $signPackage["timestamp"];?>,
			nonceStr: '<?php echo $signPackage["nonceStr"];?>',
			signature: '<?php echo $signPackage["signature"];?>',
			jsApiList: [
				// 所有要调用的 API 都要加到这个列表中
				'checkJsApi',
				'onMenuShareTimeline',
				'onMenuShareAppMessage',
				'onMenuShareQQ',
				'onMenuShareWeibo',
				'hideMenuItems',
				'showMenuItems',
				'hideAllNonBaseMenuItem',
				'showAllNonBaseMenuItem',
				'translateVoice',
				'startRecord',
				'stopRecord',
				'onRecordEnd',
				'playVoice',
				'pauseVoice',
				'stopVoice',
				'uploadVoice',
				'downloadVoice',
				'chooseImage',
				'previewImage',
				'uploadImage',
				'downloadImage',
				'getNetworkType',
				'openLocation',
				'getLocation',
				'hideOptionMenu',
				'showOptionMenu',
				'closeWindow',
				'scanQRCode',
				'chooseWXPay',
				'openProductSpecificView',
				'addCard',
				'chooseCard',
				'openCard',
				'openAddress'
				
			]
		});
	</script>

	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=百度秘钥"></script>
	<script type="text/javascript">
		wx.ready(function() {
			wx.checkJsApi({
				jsApiList: ['getLocation'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
				success: function(res) {
					// 以键值对的形式返回，可用的api值true，不可用为false
					// 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
					alert(JSON.stringify(res));
				}
			});

			wx.getLocation({

				success: function(res) {
					var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
					var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
					var speed = res.speed; // 速度，以米/每秒计
					var accuracy = res.accuracy; // 位置精度
					var gpsPoint = new BMap.Point(longitude, latitude);

					//坐标转换完之后的回调函数
					translateCallback = function(data) {
						if(data.status === 0) {
	//                    alert("lng:"+data.points[0].lng);
	//                    alert("lat:"+data.points[0].lat);
							alert(JSON.stringify(data));
							var geoc = new BMap.Geocoder();
							geoc.getLocation(new BMap.Point(data.points[0].lng, data.points[0].lat), function(result) {
								if(result) {
									//address表示用户当前所在的位置
									address = result.address;
									$("#address").html(address);
									//addressComponents表示地址详细信息，包括：streetNumber、street、district、city、province
		                            //surroundingPois，包括：title、uid、point、city、Si、type、address、postcode、phoneNumber、ju、business
		                            //point包括：lng、lat;
		                            
									//打印地址返回结果
									//alert(JSON.stringify(result));
								}
							});
						}
					}

					setTimeout(function() {
						var convertor = new BMap.Convertor();
						var pointArr = [];
						pointArr.push(gpsPoint);
						convertor.translate(pointArr, 3, 5, translateCallback)
					}, 1000);
				},
				cancel: function(res) {
					alert('用户拒绝授权获取地理位置');
				}
			});
		});
	</script>

</html>