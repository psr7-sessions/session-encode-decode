<?php

declare(strict_types=1);

namespace PSR7SessionEncodeDecode;

final class Decoder implements DecoderInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(string $encodedSessionData): array
    {
        $arr = [];
        foreach (explode(';', rtrim($encodedSessionData, ';')) as $data) {
            [$key, $value] = explode('|', $data);

            $explodedData = explode(':', $value);

            // @todo refactor this conditional
            if (3 === count($explodedData)) {
                // @todo throw exception in case of wrong length
                [$type, $length, $rawValue] = [$explodedData[0], $explodedData[1], trim($explodedData[2], '"')];
            } else {
                [$type, $rawValue] = [$explodedData[0], $explodedData[1]];
            }

            if ('i' === $type) {
                $arr[$key] = (int) $rawValue;
                continue;
            }

            if ('s' === $type) {
                $arr[$key] = (string) $rawValue;
                continue;
            }

            if ('b' === $type) {
                $arr[$key] = (bool) $rawValue;
                continue;
            }
        }

        return $arr;
    }
}
