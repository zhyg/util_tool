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
