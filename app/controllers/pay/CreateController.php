<?php
/**
 * @FileName    :   CreateController.php
 * @QQ          :   224156865
 * @date        :   2016/01/08 16:26:40
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */


class CreateController extends BaseController
{
    public function run()
    {
        $order_id = Input::get('order_id', 0);
        $user_id = Input::get('user_id', 0);
        $open_id = Input::get('open_id', '');

        $pay_ment = PayMentORM::whereOrderId($order_id)->where('openid', '<>', '')->first();
        if (empty($pay_ment)) {
            $order = OrderORM::whereId($order_id)->wherePayStatus(BaseORM::DISABLE)->first();
            if (empty($order)) {
                return '订单未找到';
            }
        
            if ($user_id != $order->user_id) {
                return '用户不正确';
            }

            $album = AlbumORM::whereId($order->album_id)->first();
            if (empty($album)) {
                return '相册未找到';
            }
            $template = TemplateORM::whereId($album->template_id)->first();
            if (empty($template)) {
                return '相册模版未找到';
            }
            $params['out_trade_no'] = $this->_generate_out_trade_no($order_id, $user_id);
            $params['subject'] = '购买相册打印服务';
            $params['quantity'] = $order->quantity;
            $params['total_fee'] = $order->total_amount;
            $params['price'] = $template->price;
            $params['body'] = '购买相册打印服务';
            $params['user_id'] = $user_id;
            $params['openid'] = $open_id;
            $params['order_id'] = $order_id;
            $r = PayMentORM::edit(0, $params);
            $pay_ment = $r[1];
        }
        
        try {
            $m = new Wxpay();
            $jsParameters = $m->getJsApiParameters($pay_ment->out_trade_no, $pay_ment->total_fee * 100, $pay_ment->openid);
            return json_decode($jsParameters, true);
        } catch (Exception $e) {
            return '内部错误';
        }
    }

    private function _generate_out_trade_no($order_id, $user_id)
    {
        return 'DaYinXiangPrint' . $order_id . $user_id;   
    }
}

