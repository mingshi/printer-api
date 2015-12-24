<?php
/**
 * @FileName    :   CreateOrderController.php
 * @QQ          :   224156865
 * @date        :   2015/12/24 13:48:11
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class CreateOrderController extends BaseController
{
    public function run()
    {
        $user_id = intval(Input::get('user_id', 0));
        $album_id = intval(Input::get('album_id', 0));
        $quantity = intval(Input::get('quantity', 1));

        $user = UserORM::whereId($user_id)->whereStatus(BaseORM::ENABLE)->first();
        if (empty($user)) {
            return '用户未找到';
        }

        $album = AlbumORM::whereId($album_id)->whereUserId($user_id)->first();
        if (empty($album)) {
            return '相册未找到';
        }

        $source = AlbumSourceORM::whereAlbumId($album_id)->get();
        if (count($source) == 0) {
            return '该相册没有任何图片';
        }

        $template = TemplateORM::whereId($album->template_id)->first();
        if (empty($template)) {
            return '相册模版未找到';
        }

        $price = $template->price;
        $total_amount = $price * $quantity;

        $orm = new OrderORM;
        $orm->user_id = $user_id;
        $orm->album_id = $album_id;
        $orm->quantity = $quantity;
        $orm->total_amount = $total_amount;
        $orm->save();

        $order = OrderORM::find($orm->id);

        return $order;
    }
}

