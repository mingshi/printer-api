<?php
/**
 * @FileName    :   ImageInfoController.php
 * @QQ          :   224156865
 * @date        :   2015/12/30 22:02:07
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ImageInfoController extends BaseController
{
    public function run()
    {
        $image_id = Input::get('image_id', 0);
        $image = TemplateSourceORM::whereId($image_id)->first();
        if (empty($image)) {
            return '模板图片不存在';
        }

        $image->source = Config::get('app.image_host') . $image->source;
        $template_id = $image->template_id;
        $template = TemplateORM::whereId($template_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($template)) {
            return '模板不存在';
        }

        $class = $template->class;
        $class = TemplateClassORM::whereId($class)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($class)) {
            return '相册分类不存在';
        }
        $class->front = Config::get('app.image_host') . $class->front;

        return [
            'image' =>  $image,
            'template'  =>  $template,
            'class' =>  $class
            ];
    }
}

