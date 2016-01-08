<?php
/**
 * @FileName    :   OrderListController.php
 * @QQ          :   224156865
 * @date        :   2016/01/08 14:03:31
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class OrderListController extends BaseController
{
    public function run()
    {
        $user_id = Input::get('user_id', 0);
        $sql = "SELECT o.*, u.real_name, u.mobile, u.address, c.name FROM orders as o LEFT JOIN user as u ON u.id = o.user_id LEFT JOIN album as a ON a.id = o.album_id LEFT JOIN template_class as c ON c.id = a.class WHERE o.user_id = $user_id ORDER BY o.created_at DESC";

        $data = DB::select(DB::raw($sql));

        $res = [];
        foreach ($data as $d) {
            $d->status = OrderORM::$status[$d->status];
            $d->pay_status_info = OrderORM::$pay_status[$d->pay_status];
            $res[] = $d;
        }
        return $res;
    }
}

