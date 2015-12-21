<?php
/**
 * @FileName    :   ClassListController.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 22:05:53
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ClassListController extends BaseController
{
    public function run()
    {
        $classes = TemplateClassORM::whereStatus(BaseORM::ENABLE)->orderBy('id', 'DESC')->get();

        return $classes;
    }
}

