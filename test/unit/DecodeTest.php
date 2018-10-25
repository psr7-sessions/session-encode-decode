<?php

declare(strict_types=1);

namespace PSR7SessionEncodeDecodeTest;

use PHPUnit\Framework\TestCase;
use PSR7SessionEncodeDecode\Decoder;

/**
 * @covers \PSR7SessionEncodeDecode\Decoder
 */
class DecodeTest extends TestCase
{
    /**
     * @var Decoder
     */
    private $decoder;

    public function setUp()
    {
        parent::setUp();

        $this->decoder = new Decoder();
    }
    /**
     * @test
     * @dataProvider provideEncodeAndExpectedDecodedData
     */
    public function it_should_decode_data_correctly(string $encodedString, $expected): void
    {
        $actual = $this->decoder->__invoke($encodedString);

        self::assertEquals($expected, $actual);
    }

    public function provideEncodeAndExpectedDecodedData() : array
    {
        return [
            [
                '',
                []
            ],
            [
                'counter|i:0;',
                ['counter' => 0]
            ],
            [
                'product_code|s:4:"2222";logged_in|s:3:"yes";',
                [
                    'product_code' => '2222',
                    'logged_in' => 'yes',
                ]
            ],
            [
                'login_ok|b:1;name|s:4:"sica";integer|i:34;obj|O:8:"stdClass":1:{s:4:"heya";i:123;}',
                [
                    'login_ok' => true,
                    'name'     => 'sica',
                    'integer'  => 34,
                    'obj'      => (object) [
                        'heya' => 123,
                    ],
                ]
            ],
        ];
    }
}
