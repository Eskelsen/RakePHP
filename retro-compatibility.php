<?php

if (!function_exists('mb_strpos')) {
    exit('Extensão mbstring é obrigatória' . PHP_EOL);
}

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle) {
        return mb_substr($haystack, 0, mb_strlen($needle)) === $needle;
    }
}

if (!function_exists('str_ends_with')) {
    function str_ends_with($haystack, $needle) {
        if ($needle === '') {
            return true;
        }

        return mb_substr($haystack, -mb_strlen($needle)) === $needle;
    }
}