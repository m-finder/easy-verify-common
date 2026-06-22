<?php

if (!function_exists('filter_special')) {
    /**
     * 过滤字符串中的特殊字符
     */
    function filter_special($str): string
    {
        if (is_null($str)) {
            return '';
        }

        // 过滤特殊符号
        $regex = '/[\x{1F600}-\x{1F64F}|' .
            '\x{1F300}-\x{1F5FF}' .
            '\x{1F680}-\x{1F6FF}' .
            '\x{1F700}-\x{1F77F}' .
            '\x{1F780}-\x{1F7FF}' .
            '\x{1F800}-\x{1F8FF}' .
            '\x{1F900}-\x{1F9FF}' .
            '\x{2600}-\x{26FF}' .
            '\x{2700}-\x{27BF}' .
            '\x{FE00}-\x{FE0F}' .
            '\x{1F1E6}-\x{1F1FF}]/u';

        $str = preg_replace($regex, '', $str);

        $search = [
            ' ',
            '　',
            ' ',
            '‭',
            '‬',
            chr(194) . chr(160),
            "\n",
            "\r",
            "\t",
            "\r\n",
            "\f",
            "\v",
        ];
        return str_replace($search, '', $str);
    }
}


if (!function_exists('yuan2fen')) {
    /**
     * 金额元转分
     * @param $amount
     * @param int $scale
     * @return int
     */
    function yuan2fen($amount, int $scale = 0): int
    {
        return bcmul($amount, 100, $scale);
    }
}


if (!function_exists('fen2yuan')) {
    /**
     * 金额分转元
     * @param int|null $amount
     * @param int $scale
     * @param bool $format
     * @return string|int|null
     */
    function fen2yuan(?int $amount = null, int $scale = 2, bool $format = false): string|int|null
    {
        return empty($amount) ? 0 : ($format ? number_format(bcdiv($amount, 100, 5), $scale) : bcdiv($amount, 100, 2));
    }
}