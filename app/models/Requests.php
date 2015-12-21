<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Config;

class Requests
{
    /**
     * 对query进行分页操作但不最终运行
     *
     * @param Builder $query query
     * @param int     $page  page
     * @param int     $take  take
     *
     * @return Builder
     */
    public static function paging($query, $page, $take)
    {
        if ($page < 1) {
            $page = 1;
        }
        $skip = ($page - 1) * $take;
        return $query->take($take)->skip($skip);
    }

    /**
     * mobile 处理手机号 隐藏中间4位
     *
     * @param str $mobile 手机号码
     *
     * @return string
     */
    public static function mobile($mobile)
    {
        if (strlen($mobile) >= 8) {
            $mobile_start = substr($mobile, 0, 3);
            $mobile_end = substr($mobile, 7);
            return "{$mobile_start}XXXX{$mobile_end}";
        } else {
            return $mobile;
        }
    }

    public static function get_binary_search_array(Array $search_arr, Array $all_arr)
    {
        $diff = array_diff($all_arr, $search_arr);

        $base_number = 0;
        foreach ($search_arr as $s) {
            $base_number = $base_number | intval($s);
        }

        $retval = array($base_number);
        while (count($diff) > 0) {
            $value = intval(array_pop($diff));
            $append_value = $value | $base_number;
            $retval[] = $append_value;
            foreach ($diff as $d) {
                $append_value = intval($d) | $append_value;
                $retval[] = $append_value;
            }
        }
        return $retval;
    }

    /**
     * getMicrotime
     * 返回当前时间戳的毫秒数
     *
     * @return int
     */
    public static function getMicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return $usec + $sec;
    }

    public static function json_error($msg = '')
    {
        $params = json_encode(Input::all());
        $str = $msg.' '.$params;
        Requests::log($str);

        $err = new stdClass();
        $err->status = 'error';
        $err->message = trim($msg);
        if (isset($_GET['jsoncallback'])) {
            header('Content-Type:text/html;Charset=utf-8');
            echo $_GET['jsoncallback'] . "(".json_encode($err).")";  
            exit;
        } else {
            header('Content-Type: application/json');
            $retval = json_encode($err);
            echo $retval;
            exit;
        }
    }

    public static function json_success($result = null)
    {
        $success = new stdClass();
        $success->status = 'success';
        $success->result = $result;
        if (isset($_GET['jsoncallback'])) {
            header('Content-Type:text/html;Charset=utf-8');
            echo $_GET['jsoncallback'] . "(".json_encode($success).")";  
            exit;
        } else {
            header('Content-Type: application/json');
            $retval = json_encode($success);
            echo $retval;
            exit;
        }
    }

    public static function log($str, $file = "/tmp/api.log")
    {
        $stderr = fopen($file,'a');
        fwrite($stderr,"\r\n".date("Y-m-d H:i:s", time())." ".@$_SERVER['REQUEST_URI']." ".$str);
        fclose($stderr);
    }

    /**
     * 检查手机号是否为11位数字
     *
     * @param string $mobile 手机号
     *
     * @return bool
     */
    public static function checkMobile($mobile)
    {
        if (preg_match("/^[0-9]{11}$/", $mobile)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 根據key返回內部鏈接的地址到? 不帶後面參數
     *
     * @param string $key internal link key
     *
     * @return string
     */
    public static function internalLink($key)
    {
        $env = Config::get('env');
        $internal_link = $env['internal_link'];
        if (isset($internal_link[$key])) {
            return $internal_link[$key];
        } else {
            return '';
        }
    }

    /**
     * 给sql中in用的,把id放在数组里.
     *
     * @param ORM    $data 数据库中查出的数据
     * @param string $key  key
     *
     * @return array
     */
    public static function in($data, $key)
    {
        $ids = array(-1);
        foreach ($data as $d) {
            if (isset($d->$key)) {
                $ids[] = $d->$key;
            }
        }
        return $ids;
    }

    public static function ids($data, $key)
    {
        $ids = array();
        foreach ($data as $d) {
            if (isset($d->$key)) {
                $ids[$d->$key] = $d;
            }
        }
        return $ids;
    }

    /**
     * 算两个点之间的距离,单位是米.
     *
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     *
     * @return float
     */
    public static function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters

        /*
          Convert these degrees to radians
          to work with the formula
        */

        $lat1 = ($lat1 * pi()) / 180;
        $lng1 = ($lng1 * pi()) / 180;

        $lat2 = ($lat2 * pi()) / 180;
        $lng2 = ($lng2 * pi()) / 180;

        /*
          Using the
          Haversine formula

          http://en.wikipedia.org/wiki/Haversine_formula

          calculate the distance
        */

        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }

    public static function timeToDteTime($timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
    }

    public static function pwdConversion($pwd)
    {
        return md5($pwd);
    }

    public static function pwdConversionNew($pwd)
    {
        return md5(md5($pwd));
    }
}
