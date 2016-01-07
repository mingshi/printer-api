<?php
/**
 * @FileName    :   InfoController.php
 * @QQ          :   224156865
 * @date        :   2016/01/07 15:59:52
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class InfoController extends BaseController
{
    public function run()
    {
        $user_id = Input::get('user_id', 0);
        $user = UserORM::whereId($user_id)->first();
        if (empty($user)) {
            return '用户未找到';
        }

        return $user;
    }
}

