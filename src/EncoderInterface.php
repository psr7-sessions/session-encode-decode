<?php

declare(strict_types=1);

namespace PSR7SessionEncodeDecode;

interface EncoderInterface
{
    public function __invoke(array $sessionData): string;
}
