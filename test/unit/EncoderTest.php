<?php

declare(strict_types=1);

namespace PSR7SessionEncodeDecodeTest;

use PHPUnit_Framework_TestCase;
use PSR7SessionEncodeDecode\Encoder;

/**
 * @covers \PSR7SessionEncodeDecode\Encoder
 */
class EncoderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Encoder
     */
    private $encoder;

    public function setUp()
    {
        parent::setUp();

        $this->encoder = new Encoder();
    }
    /**
     * @test
     * @dataProvider provideEncodeAndExpectedDecodedData
     */
    public function it_should_encoded_data_correctly(array $encodedString, $expected): void
    {
        $actual = $this->encoder->__invoke($encodedString);

        self::assertEquals($expected, $actual);
    }

    public function provideEncodeAndExpectedDecodedData() : array
    {
        return [
            [
                [],
                '',
            ],
            [
                ['counter' => 0],
                'counter|i:0;',
            ],
            [
                [
                    'product_code' => '2222',
                    'logged_in' => 'yes',
                ],
                'product_code|s:4:"2222";logged_in|s:3:"yes";',
            ],
            [
                [
                    'login_ok' => true,
                    'name'     => 'sica',
                    'integer'  => 34,
                    'obj'      => (object) [
                        'heya' => 123,
                    ],
                ],
                'login_ok|b:1;name|s:4:"sica";integer|i:34;obj|O:8:"stdClass":1:{s:4:"heya";i:123;}',
            ],
        ];
    }
}
