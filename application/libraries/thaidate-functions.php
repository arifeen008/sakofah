<?php
/* 
 * 
 * @author Vee W.
 * @license http://opensource.org/licenses/MIT
 * 
 */


/**
 * Thai date use date() function.
 * 
 * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.date.php
 * @param integer $timestamp The optional timestamp is an integer Unix timestamp.
 * @param boolean $buddhist_era Use Buddhist era? set to true to use that or false not to use.
 * @return string Return the formatted date/time string.
 */
function thaidate($format, $timestamp = '', $buddhist_era = true)
{
    if (!is_bool($buddhist_era)) {
        $buddhist_era = true;
    }

    $thaidate = new \Rundiz\Thaidate\Thaidate();
    $thaidate->buddhist_era = $buddhist_era;
    return $thaidate->date($format, $timestamp);
} // thaidate


/**
 * Thai date use strftime() function.
 * 
 * @param string $format The format as same as PHP date function format. See http://php.net/manual/en/function.strftime.php
 * @param integer $timestamp The optional timestamp is an integer Unix timestamp.
 * @param boolean $buddhist_era Use Buddhist era? set to true to use that or false not to use.
 * @param array|string $locale The locale that will be use in setlocale() function. See http://php.net/setlocale
 * @return string Return the formatted date/time string.
 */
function thaistrftime($format, $timestamp = '', $buddhist_era = true, $locale = 'th')
{
    if ($locale == null) {
        $locale = 'th';
    }

    if (!is_bool($buddhist_era)) {
        $buddhist_era = true;
    }

    $thaidate = new \Rundiz\Thaidate\Thaidate();
    $thaidate->buddhist_era = $buddhist_era;
    $thaidate->locale = $locale;
    return $thaidate->strftime($format, $timestamp);
} // thaistrftime

function TelFormat($mobile)
{
    $minus_sign = "-";   // กำหนดเครื่องหมาย 
    $part1 = substr($mobile, 0, -7);  // เริ่มจากซ้ายตัวที่ 1 ( 0 ) ตัดทิ้งขวาทิ้ง 7 ตัวอักษร ได้ 085 
    $part2 = substr($mobile, 3, -4);  // เริ่มจากซ้าย ตัวที่ 4 (9) ตัดทิ้งขวาทิ้ง 3 ตัวอักษร ได้ 9490 
    $part3 = substr($mobile, 6); // เริ่มจากซ้าย ตัวที่ 8 (8) ไม่ตัดขวาทิ้ง ได้ 862  
    $a = $part1 . $minus_sign . $part2 . $minus_sign . $part3;
    return $a;
}

function BankAccount($mobile)
{
    $minus_sign = "-";   // กำหนดเครื่องหมาย 
    $part1 = substr($mobile, 0, -8);  // เริ่มจากซ้ายตัวที่ 1 ( 0 ) ตัดทิ้งขวาทิ้ง 7 ตัวอักษร ได้ 085 
    $part2 = substr($mobile, 3, -6);  // เริ่มจากซ้าย ตัวที่ 4 (9) ตัดทิ้งขวาทิ้ง 3 ตัวอักษร ได้ 9490 
    $part3 = substr($mobile, 5, -1); // เริ่มจากซ้าย ตัวที่ 8 (8) ไม่ตัดขวาทิ้ง ได้ 862  
    $part4 = substr($mobile, 10);
    $a = $part1 . $minus_sign . $part2 . $minus_sign . $part3 . $minus_sign . $part4;
    return $a;
}
