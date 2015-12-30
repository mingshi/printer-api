<?php
/**
 * @FileName    :   TemplateImagesController.php
 * @QQ          :   224156865
 * @date        :   2015/12/22 15:29:28
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateImagesController extends BaseController
{
    public function run()
    {
        $template_id = intval(Input::get('template_id', 0));
        $template = TemplateORM::find($template_id);

        if (empty($template)) {
            return '模版未找到';
        }

        $images = TemplateSourceORM::whereTemplateId($template_id)->orderBy('is_front', 'DESC')->get();

        return TemplateSourceModel::listData($images);
    }
}

