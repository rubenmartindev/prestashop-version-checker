<?php

namespace RubenMartinDev\PrestaShopVersionChecker\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
class FunctionsTest extends TestCase
{
    public function testIsPsVersionFunctionExists()
    {
        $this->assertTrue(function_exists('is_ps_version'));
    }

    public function testIsPsVersionReturnsTrueWhenVersionMatches()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(is_ps_version('<1.7'));
        $this->assertTrue(is_ps_version('>=1.6'));
    }

    public function testIsPsVersionReturnsFalseWhenVersionDoesNotMatch()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(is_ps_version('>=1.7'));
        $this->assertFalse(is_ps_version('<1.6'));
    }

    private function setPrestaShopVersion()
    {
        if (!\defined('_PS_VERSION_')) {
            \define('_PS_VERSION_', '1.6.1.24');
        }
    }
}
