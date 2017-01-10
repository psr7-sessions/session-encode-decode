<?php

declare(strict_types=1);

namespace PSR7SessionEncodeDecode;

interface DecoderInterface
{
    public function __invoke(string $encodedSessionData): array;
}
