<?php

namespace App\Helpers;

class TextHelper
{
    public static function normalizeArabic($text)
    {
        $text = preg_replace('/[إأآا]/u', 'ا', $text);
        $text = preg_replace('/ى/u', 'ي', $text);
        $text = preg_replace('/ؤ/u', 'و', $text);
        $text = preg_replace('/ئ/u', 'ي', $text);
        $text = preg_replace('/ة/u', 'ه', $text);
        $text = preg_replace('/[^\p{Arabic}\p{N}\s]/u', '', $text);
        return trim($text);
    }
}
