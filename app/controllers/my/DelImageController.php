<?php
/**
 * @FileName    :   DelImageController.php
 * @QQ          :   224156865
 * @date        :   2016/01/07 15:13:07
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class DelImageController extends BaseController
{
    public function run()
    {
        $user_id = Input::get('user_id', 0);
        $ids = Input::get('ids', '');

        if (empty($ids)) {
            return '图片不能为空';
        }
        
        $ids_arr = explode(',', $ids);
        $images = AlbumSourceORM::whereIn('id', $ids_arr)->get();
        if (count($images) <= 0) {
            return '图片未找到';
        }

        $albums = [];
        foreach ($images as $i) {
            $albums[] = $i->album_id;
        }

        $album_array = AlbumORM::whereIn('id', $albums)->get();
        if (count($album_array) <= 0) {
            return '相册未找到';
        }

        $users = [];
        foreach ($album_array as $a) {
            $users[] = $a->user_id;
        }
    
        foreach ($users as $u) {
            if ($u != $user_id) {
                return '用户信息错误';
                break;               
            }
        }
        
        try {
            $images = AlbumSourceORM::whereIn('id', $ids_arr)->delete();
            return [];
        } catch (Exception $e) {
            return '删除失败';
        }
    }
}

