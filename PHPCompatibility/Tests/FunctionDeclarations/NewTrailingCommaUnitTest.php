<?php
/**
 * PHPCompatibility, an external standard for PHP_CodeSniffer.
 *
 * @package   PHPCompatibility
 * @copyright 2012-2020 PHPCompatibility Contributors
 * @license   https://opensource.org/licenses/LGPL-3.0 LGPL3
 * @link      https://github.com/PHPCompatibility/PHPCompatibility
 */

namespace PHPCompatibility\Tests\FunctionDeclarations;

use PHPCompatibility\Tests\BaseSniffTest;

/**
 * Test the NewTrailingComma sniff.
 *
 * @group newTrailingComma
 * @group syntax
 *
 * @covers \PHPCompatibility\Sniffs\FunctionDeclarations\NewTrailingCommaSniff
 *
 * @since 10.0.0
 */
class NewTrailingCommaUnitTest extends BaseSniffTest
{

    /**
     * Test correctly identifying trailing comma's in function declarations.
     *
     * @dataProvider dataTrailingComma
     *
     * @param int $line The line number.
     *
     * @return void
     */
    public function testTrailingComma($line)
    {
        $file = $this->sniffFile(__FILE__, '7.4');
        $this->assertError($file, $line, "Trailing comma's are not allowed in function declaration parameter lists in PHP 7.4 or earlier");
    }

    /**
     * Data provider.
     *
     * @see testTrailingComma()
     *
     * @return array
     */
    public function dataTrailingComma()
    {
        return array(
            array(39),
            array(44),
            array(48),
            array(59),
            array(70),
            array(73),
        );
    }


    /**
     * Verify the sniff does not throw false positives for valid code.
     *
     * @dataProvider dataNoFalsePositives
     *
     * @param int $line The line number.
     *
     * @return void
     */
    public function testNoFalsePositives($line)
    {
        $file = $this->sniffFile(__FILE__, '7.4');
        $this->assertNoViolation($file, $line);
    }

    /**
     * Data provider.
     *
     * @see testNoFalsePositives()
     *
     * @return array
     */
    public function dataNoFalsePositives()
    {
        // No errors expected on the first 33 lines.
        $data = array();
        for ($line = 1; $line <= 33; $line++) {
            $data[] = array($line);
        }

        $data[] = array(76);
        $data[] = array(80);

        return $data;
    }


    /**
     * Verify no notices are thrown at all.
     *
     * @return void
     */
    public function testNoViolationsInFileOnValidVersion()
    {
        $file = $this->sniffFile(__FILE__, '8.0');
        $this->assertNoViolation($file);
    }
}
