<?php
/**
 * @FileName    :   CreateController.php
 * @QQ          :   224156865
 * @date        :   2016/01/06 21:50:29
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class CreateController extends BaseController
{
    public function run()
    {
        $user_id = Input::get('user_id', 0);
        $class_id = Input::get('class_id', 0);
        $template_id = Input::get('template_id', 0);
        $user = UserORM::whereId($user_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($user)) {
            return '用户未找到';
        }

        $class = TemplateClassORM::whereId($class_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($class)) {
            return '相册分类未找到';
        }

        $template = TemplateORM::whereId($template_id)->whereClass($class_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($template)) {
            return '模版未找到';
        }

        $r = AlbumORM::edit(0, [
            'user_id'   =>  $user_id,
            'class'     =>  $class_id,
            'template_id'   =>  $template_id
            ]);

        return $r[1];
    }
}

