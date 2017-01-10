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
        if ('' === $encodedSessionData) {
            return [];
        }

        preg_match_all('/(^|;|\})(\w+)\|/i', $encodedSessionData, $matchesarray, PREG_OFFSET_CAPTURE);

        $decodedData = [];

        $lastOffset = null;
        $currentKey = '';
        foreach ($matchesarray[2] as $value) {
            $offset = $value[1];
            if (null !== $lastOffset) {
                $valueText = substr($encodedSessionData, $lastOffset, $offset - $lastOffset);

                /** @noinspection UnserializeExploitsInspection */
                $decodedData[$currentKey] = unserialize($valueText);
            }
            $currentKey = $value[0];

            $lastOffset = $offset + strlen($currentKey) + 1;
        }

        $valueText = substr($encodedSessionData, $lastOffset);

        /** @noinspection UnserializeExploitsInspection */
        $decodedData[$currentKey] = unserialize($valueText);

        return $decodedData;
    }
}
