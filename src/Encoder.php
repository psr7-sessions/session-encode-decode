<?php

declare(strict_types=1);

namespace PSR7SessionEncodeDecode;

final class Encoder implements EncoderInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(array $sessionData): string
    {
        if (empty($sessionData)) {
            return '';
        }

        $encodedData = '';

        foreach ($sessionData as $key => $value) {
            $encodedData .= $key . '|' . serialize($value);
        }

        return $encodedData;
    }
}
