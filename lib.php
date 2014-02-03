<?php 

class Lib {
    private static $isSmartPhoneAccess;

    /**
    * スマートフォンアクセスか判定する (isSmartphoneのラッパー) 
    * @param useragent (HTTP_USER_AGENT)
    * @return bool
    * true:smart phone access, false: not smartphone access
    */
    public static function isSmartPhoneAccess() {
        if(!isset(self::$isSmartPhoneAccess)) {
            self::$isSmartPhoneAccess = self::isSmartphone($_SERVER['HTTP_USER_AGENT']);
        }
        return self::$isSmartPhoneAccess;
    }

    /**
    * iOS + Safariアクセスか判定する
    * @param useragent (HTTP_USER_AGENT)
    * @return bool
    * true:ios + safari, false: not ios + safari
    */
    public static function isIPhoneSafariAccess(){
        
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $reg = '/(iPhone|iPad).+Safari/';
        
        return preg_match($reg, $ua);
    }
    
    /**
    * スマートフォンアクセスか判定する
    * @param useragent (HTTP_USER_AGENT)
    * @return bool
    * true:smart phone access, false: not smartphone access
    */
    public static function isSmartphone($useragent) {
        $useragent = strtolower($useragent);
        if ((strpos($useragent, "android") !== false)
                || (strpos($useragent, "docomo") !== false)
                || (strpos($useragent, "vodafone") !== false)
                || (strpos($useragent, "kddi") !== false)
                || (strpos($useragent, "iphone") !== false)
                || (strpos($useragent, "ipad") !== false)
                || (strpos($useragent, "ipod") !== false)
                || (strpos($useragent, "iemobile") !== false)
                || (strpos($useragent, "blackberry") !== false)
                || (strpos($useragent, "mobile safari") !== false)
                || (strpos($useragent, "mob safari") !== false)
                || (strpos($useragent, "opera mobi") !== false)
                || (strpos($useragent, "skyfire") !== false)
                || (strpos($useragent, "windows phone") !== false)
                || (strpos($useragent, "symbian") !== false)
                || (strpos($useragent, "playstation") !== false)
                || (strpos($useragent, "nintendo") !== false)
                || (strpos($useragent, "windows ce") !== false)) {
            return true;
        }
        return false;
    }
    
    /**
    * 16進数のランダムなIDを生成する
    * @param int $length [optional] IDの長さ default: 32
    * @return string
    */
    public static function generateRandomID($length = 32) {
        $id = '';
        while (strlen($id) < $length) {
            $id .= md5(uniqid('', true));
        }
        return substr($id, 0, $length);
    }

    /**
    * arrayのdataから2進数のbitフラグを作成する
    * 例: array(1=>1, 2=>0, 3=>1)　==> '101' 戻り値はintで5
    * @param array(int => int)
    * @return int
    */
    public static function convertDataToBits($data) {
        if(!$data) {
            return;
        }
        foreach ($data as $key => $value) {
            if (!is_numeric($key)) {
                return;
            }
            if($value > 1 || $value < 0) {
                return;
            }
        }

        $bits = 0;
        foreach ($data as $key => $value) {
            $mask = 1;
            if($value == 1) {
                $bits = $bits | ($mask << ($key - 1));
            }
        }
        return $bits;
    }

    /**
    * int(bitフラグ)からarray(int=>int)を作成する
    * 例: int5('101')　==> array(1=>1, 2=>0, 3=>1) 
    * @param int
    * @return array(int => int)
    */
    public static function converBitsToData($bits) {
        if(!$bits || !is_numeric($bits) || $bits < 1) {
            return;
        }

        $mask = 1;
        $cnt = 1;
        $data = array();
        while (1) {
            if($bits == 0) {
                break;
            }
            $judge = $bits & $mask;
            if($judge) {
                $array[] = $cnt;
            }
            $cnt++;
            $bits = $bits >> 1;
        }

        return $array;
    }
}