<?php

namespace App\Utilities;

class StringHelper
{
    /**
     * Truncates text without cutting the last word in half.
     */
    public function smartTruncate(string $text, int $length, string $ellipses = ''): string
    {
        if (mb_strlen($text) <= $length) {
            return $text;
        }

        $firstSpacePosition = mb_stripos($text . ' ', ' ', $length);
        $truncated = mb_substr($text, 0, $firstSpacePosition ? $firstSpacePosition : $length);

        if (mb_substr($truncated, strlen($ellipses) * -1) !== $ellipses) {
            $truncated .= $ellipses;
        }

        return $truncated;
    }
}
