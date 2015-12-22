<?php
/**
 * @FileName    :   TemplateListController.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 22:14:48
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateListController extends BaseController
{
    public function run()
    {
        $class_id = intval(Input::get('class_id', 0));
        if (empty($class_id)) {
            return '相册类别错误';
        }

        $class = TemplateClassORM::whereId($class_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($class)) {
            return '相册分类未找到';
        }

        $sql = "SELECT t.*, ts.source FROM template as t LEFT JOIN template_source as ts ON ts.template_id = t.id WHERE t.status=" . BaseORM::ENABLE . " AND ts.is_front = " . BaseORM::ENABLE. " ORDER BY t.sort DESC";
        $results = DB::select(DB::raw($sql));

        return TemplateModel::listData($results);
    }
}

