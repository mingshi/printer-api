<?php
/**
 * @FileName    :   WxCreateController.php
 * @QQ          :   224156865
 * @date        :   2015/12/28 21:48:14
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class WxCreateController extends BaseController
{
    public function run()
    {
        $wx_id = Input::get('wx_id', '');

        if (!empty($wx_id)) {
            
        }

        return '';
    }
}

