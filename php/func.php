<?php
/**
 * 修正unicode不经escape_string入db，用'\u'替换'u'
 * @param  string   $ori    原始字符串
 * @return string           修正后的字符串
 */
function amend_unicode($ori)
{
    if (strpos($ori, 'u') === false) {
        return $ori;
    }

    $ret = '';
    $first = true;
    $arr = explode('u', $ori);
    foreach ($arr as $wd) {
        if ($first) {
            $ret = $wd;
            $first = false;
            continue;
        }

        $llen = strlen($wd);
        if ($llen == 4) {
            if (preg_match("/^[0-9a-f]{4}/", $wd)) {
                $ret .= '\u' . $wd;
            } else {
                $ret .= 'u' . $wd;
            }
        } else {
            $ret .= 'u' . $wd;
        }
    }

    return $ret;
}

/**
 * 归一化带分隔符的字符串
 * @param  string   $string     原始字符串
 * @param  string   $delimiter  分隔符
 * @return boolean/string
 */
function get_str_unique($string, $delimiter)
{
    if (empty($string) || empty($delimiter) || !is_string($string) || !is_string($delimiter)) {
        return false;
    }

    $ret = implode($delimiter, array_filter(array_unique(explode($delimiter, $string)), function ($var) {
        return !empty($var);
    }));

    return $ret;
}

/**
 * 替换sql中的'select'与'from'之间的字符串
 * @param  string           $string     原始sql字符串
 * @return boolean/string
 */
function get_count_sql($string)
{
    if (empty($string) || !is_string($string)) {
        redelimiterturn false;
    }

    $start = stripos($string, 'select');
    $length = stripos($string, 'from');
    if ($start === false || $length === false) {
        return false;
    }

    $start = $start + strlen('select') + 1;
    $length = $length - $start - 1;
    $string = substr_replace($string, 'count(*) count', $start, $length);

    return $string;
}

/**
 * 十进制数转成二进制数组
 * example 11 => array(1, 2, 8)
 * @param  string           $val
 * @return array
 */
function decimal_to_binaryarray($val)
{
  $ret = array(); 
  $val = str_split(decbin(intval($val)));
  $len = count($val);
  for ($i = $len - 1; $i >= 0; $i--) {
    if ($val[$i]) {
        array_push($ret, pow(2, $len-$i-1));
    }   
  }
  return $ret;
}
