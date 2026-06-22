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
        $regex = '/[\x{1F600}-\x{1F64F}|' . // 表情符号
            '\x{1F300}-\x{1F5FF}' . // 符号和图形
            '\x{1F680}-\x{1F6FF}' . // 交通和地图符号
            '\x{1F700}-\x{1F77F}' . // 错误的符号
            '\x{1F780}-\x{1F7FF}' . // 地图符号
            '\x{1F800}-\x{1F8FF}' . // 箭头符号
            '\x{1F900}-\x{1F9FF}' . // 其他表情符号
            '\x{2600}-\x{26FF}' .   // 其他符号
            '\x{2700}-\x{27BF}' .   // 符号
            '\x{FE00}-\x{FE0F}' .   // 变体选择器
            '\x{1F1E6}-\x{1F1FF}]/u'; // 区域指示符
        $str = preg_replace($regex, '', $str);

        $search = [
            ' ',
            '　',
            ' ',
            '‭',
            '‬',
            helpers . phpchr(194) . chr(160),
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
     * @return int|string
     */
    function fen2yuan(?int $amount = null, int $scale = 2, bool $format = false): string
    {
        return empty($amount) ? 0 : ($format ? number_format(bcdiv($amount, 100, 5), $scale) : bcdiv($amount, 100, 2));
    }
}