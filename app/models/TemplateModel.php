<?php
/**
 * @FileName    :   TemplateModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/18 14:06:06
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'TemplateORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['class'])) {
            $sql = $sql->where('class', '=', $params['class']);
        }

        return $sql;
    } 

    public static function listData($data)
    {
        $res = [];
        foreach ($data as $d) {
            $tmp['id'] = $d->id;
            $tmp['name'] = $d->name;
            $tmp['sort'] = $d->sort;
            $tmp['status'] = $d->status;
            $tmp['price'] = $d->price;
            $tmp['class'] = $d->class;
            $tmp['source'] = Config::get('app.image_host') . $d->source;
            $res[] = $tmp;
        }

        return $res;
    }
}

