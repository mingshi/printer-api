<?php
/**
 * @FileName    :   TemplateClassModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 15:19:42
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateClassModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'TemplateClassORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['name'])) {
            $sql = $sql->where('name', '=', $params['name']);
        }

        return $sql;
    } 

    public static function listData($res)
    {
        $result = [];
        foreach ($res as $r) {
            $tmp['id'] = $r->id;
            $tmp['name'] = $r->name;
            $tmp['sort'] = $r->sort;
            $tmp['status'] = $r->status;
            $tmp['front'] = !empty($r->front) ? Config::get('app.image_host') . $r->front : '';

            $result[] = $tmp;
        }

        return $result;
    }
}

