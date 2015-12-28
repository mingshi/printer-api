<?php
/**
 * @FileName    :   WxInfoController.php
 * @QQ          :   224156865
 * @date        :   2015/12/28 21:37:26
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class WxInfoController extends BaseController
{
    public function run()
    {
        $open_id = Input::get('wx_id', '');

        $user = [];

        if (!empty($open_id)) {
            $tmpUser = UserORM::whereWxId($open_id)->first();
            if ($tmpUser) {
                $user = $tmpUser;
            } else {
                $id = 0;
                $params = ['wx_id' => $open_id];
                $r = UserORM::edit($id, $params);

                $user = UserORM::find($r[1]->id);;
            }
        }

        return $user;
    }
}

