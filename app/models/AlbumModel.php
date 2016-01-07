<?php
/**
 * @FileName    :   AlbumModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 14:24:19
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AlbumModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'AlbumORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['user_id'])) {
            $sql = $sql->where('user_id', '=', $params['user_id']);
        }

        return $sql;
    } 

    public static function listData($results)
    {
        $res = [];
        foreach ($results as $r) {
            $tmp = [];
            $tmp['id'] = $r->id;
            $tmp['user_id'] = $r->user_id;
            $tmp['class']   = $r->class;
            $tmp['template_id'] = $r->template_id;
            $tmp['created_at'] = $r->created_at;
            $tmp['source'] = Config::get('app.image_host') . $r->source;

            $res[] = $tmp;
        }

        return $res;
    }
}

