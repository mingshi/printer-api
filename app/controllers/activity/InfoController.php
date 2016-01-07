<?php
/**
 * @FileName    :   InfoController.php
 * @QQ          :   224156865
 * @date        :   2016/01/07 23:37:36
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class InfoController extends BaseController
{
    public function run()
    {
        $activiy_id = Input::get('activity_id', 0);
        $r = ActivityORM::find($activiy_id);

        if (empty($r)) {
            return '没有该活动信息';
        }

        return $r;
    }
}

