<?php
/**
 * @FileName    :   Wxpay.php
 * @QQ          :   224156865
 * @date        :   2016/01/08 18:32:51
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */
require_once app_path() . "/wxpay/lib/WxPay.Api.php";

class Wxpay 
{
    public function getJsApiParameters($out_trade_no='', $fee='', $openId='')
    {
        $input = new WxPayUnifiedOrder();
		$input->SetBody("购买相册打印服务");
		$input->SetOut_trade_no($out_trade_not);
		$input->SetTotal_fee($fee);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetNotify_url('http://api.dayinxiangsh.com/1.0/pay/callback');
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);

        $jsApiParameters = $this->getParameters($order);
		return $jsApiParameters;
    }    

   	public function getParameters($UnifiedOrderResult)
    {
        if(!array_key_exists("appid", $UnifiedOrderResult)
        || !array_key_exists("prepay_id", $UnifiedOrderResult)
        || $UnifiedOrderResult['prepay_id'] == "")
        {
            throw new WxPayException("参数错误");
        }
        $jsapi = new WxPayJsApiPay();
        $jsapi->SetAppid($UnifiedOrderResult["appid"]);
        $timeStamp = time();
        $jsapi->SetTimeStamp("$timeStamp");
        $jsapi->SetNonceStr(WxPayApi::getNonceStr());
        $jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
        $jsapi->SetSignType("MD5");
        $jsapi->SetPaySign($jsapi->MakeSign());
        $parameters = json_encode($jsapi->GetValues());
        return $parameters;
    } 
}

