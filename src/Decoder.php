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
        if('' === $encodedSessionData) {
            return [];
        }

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

            // integer
            if ('i' === $type) {
                $arr[$key] = (int) $rawValue;
                continue;
            }

            // string
            if ('s' === $type) {
                $arr[$key] = (string) $rawValue;
                continue;
            }

            // bool
            if ('b' === $type) {
                $arr[$key] = (bool) $rawValue;
                continue;
            }

            // object
            if ('O' === $type) {
                $arr[$key] = (bool) $rawValue;
                continue;
            }
        }

        return $arr;
    }
}
