<?php
/**
 * @FileName    :   ListController.php
 * @QQ          :   224156865
 * @date        :   2015/12/25 10:17:52
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ListController extends BaseController
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $banners = BannerORM::whereStatus(BaseORM::ENABLE)->where('expire', '>', "$now")->orderBy('sort', 'DESC')->get();
    
        return BannerModel::listData($banners);
    }   
}
