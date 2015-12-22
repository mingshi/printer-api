<?php
/**
 * @FileName    :   AlbumListController.php
 * @QQ          :   224156865
 * @date        :   2015/12/22 13:56:07
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AlbumListController extends BaseController
{
    public function run()
    {
        $user_id = intval(Input::get('user_id', 0));
        $user = UserORM::find($user_id);

        if (empty($user)) {
            return '用户未找到';
        }

        $sql = "SELECT a.*, al.source FROM album as a LEFT JOIN album_source as al ON al.album_id = a.id WHERE a.user_id = " . $user_id . " AND al.is_front = " . BaseORM::ENABLE . "  ORDER BY a.id DESC";

        $results = DB::select(DB::raw($sql));

        return AlbumModel::listData($results);
    }
}

