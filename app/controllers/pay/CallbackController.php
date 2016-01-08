<?php
/**
 * @FileName    :   CallbackController.php
 * @QQ          :   224156865
 * @date        :   2016/01/08 20:57:28
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class CallbackController extends BaseController
{
    public function run()
    {
        $post_str = file_get_contents("php://input", true);
        $post_obj = simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (isset($post_obj->return_code)) {
            $result_code = $post_obj->result_code;
            $return_code = $post_obj->return_code;
            $out_trade_no = $post_obj->out_trade_no;
		
			$payOrder = PayMentORM::where('out_trade_no', '=', $out_trade_no)->first();
            if (!empty($payOrder)) {
                $payOrder->notify_time = date("Y-m-d H:i:s", time());
                $payOrder->result_code = $result_code;
                $payOrder->return_code = $return_code;
                $payOrder->save();
            }

			if ($result_code == "SUCCESS" || $return_code == "SUCCESS") {
				$payOrder->transaction_id = $post_obj->transaction_id;
                $payOrder->time_end = $post_obj->time_end;
                $payOrder->server_paid = 1;
                $payOrder->save();
	            
                //更新订单
                $order = OrderORM::whereId($payOrder->order_id)->first();
                $order->pay_status = 1;
                $order->save();    
			}

			echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';	
        } else {
			echo '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[ERROR_MSG]]></return_msg></xml>';
		}
		exit;
    }
}

