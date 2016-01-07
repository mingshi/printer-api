<?php
/**
 * @FileName    :   AlbumInfoController.php
 * @QQ          :   224156865
 * @date        :   2016/01/07 13:30:16
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AlbumInfoController extends BaseController
{
    public function run()
    {
        $user_id = Input::get('user_id', 0);
        $album_id = Input::get('album_id', 0);

        $user = UserORM::whereId($user_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($user)) {
            return '用户未找到';
        }

        $album = AlbumORM::whereId($album_id)->whereUserId($user_id)->first();
        if (empty($album)) {
            return '相册未找到';
        }

        $sources = AlbumSourceORM::whereAlbumId($album_id)->orderBy('is_front', 'DESC')->get();
        $template_source_count = TemplateSourceORM::whereTemplateId($album->template_id)->count();

        $images = [];
        foreach ($sources as $s) {
            $tmp = [];
            $tmp['id'] = $s->id;
            $tmp['album_id'] = $s->album_id;
            $tmp['source'] = Config::get('app.image_host') . $s->source;
            $tmp['is_front'] = $s->is_front;
            $images[] = $tmp;
        }

        $can_add = 0;
        if ($template_source_count > count($sources)) {
            $can_add = 1;
        }

        return [
            'album'  =>  $album,
            'images'    =>  $images,
            'can_add'   =>  $can_add
        ];
    }
}

