<?php
/**
 * @FileName    :   ListController.php
 * @QQ          :   224156865
 * @date        :   2015/12/25 09:54:30
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ListController extends BaseController
{
    public function run()
    {
        $data = ActivityORM::all();

        $result = [];
        foreach ($data as $a) {
            $a->list_image = Config::get('app.image_host') . $a->list_image;
            $result[] = $a;
        }
        
        return $result;
    }
}

