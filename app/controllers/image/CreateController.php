<?php
/**
 * @FileName    :   CreateController.php
 * @QQ          :   224156865
 * @date        :   2016/01/06 21:58:30
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class CreateController extends BaseController
{
    public function run()
    {
        $album_id = Input::get('album_id', 0);
        $source = Input::get('source', '');
        $user_id = Input::get('user_id', 0);

        $album = AlbumORM::whereId($album_id)->whereUserId($user_id)->first();
        if (empty($album)) {
            return '相册未找到';
        }

        if (empty($source)) {
            return '图片路径错误';
        }

        $r = AlbumSourceORM::edit(0, [
            'album_id'  =>  $album_id,
            'source'    =>  $source
            ]);

        return $r[1];
    }
}

