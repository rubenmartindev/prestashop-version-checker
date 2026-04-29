<?php

namespace RubenMartinDev\PrestaShopVersionChecker\Tests\Unit;

use PHPUnit\Framework\TestCase;
use RubenMartinDev\PrestaShopVersionChecker\PrestaShopVersionChecker;
use RuntimeException;

class PrestaShopVersionCheckerTest extends TestCase
{
    public function testIsThrowsExceptionWhenPrestaShopNotInitialized()
    {
        $this->expectException(RuntimeException::class);

        PrestaShopVersionChecker::is('>1.7');
    }

    public function testIsThrowsExceptionWhenInvalidOperator()
    {
        $this->setPrestaShopVersion();

        $this->expectException(\InvalidArgumentException::class);

        PrestaShopVersionChecker::is('a1.7');
    }

    public function testIsThrowsExceptionWhenInvalidVersion()
    {
        $this->setPrestaShopVersion();

        $this->expectException(\InvalidArgumentException::class);

        PrestaShopVersionChecker::is('>a');
    }

    public function testIsReturnsTrueWhenVersionMatches()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::is('<>1.6.0'));
        $this->assertTrue(PrestaShopVersionChecker::is('<=1.6.1.24'));
        $this->assertTrue(PrestaShopVersionChecker::is('<1.7'));
        $this->assertTrue(PrestaShopVersionChecker::is('>=1.6.1'));
        $this->assertTrue(PrestaShopVersionChecker::is('>1.6'));
        $this->assertTrue(PrestaShopVersionChecker::is('==1.6.1.24'));
        $this->assertTrue(PrestaShopVersionChecker::is('!=1.6.0'));
        $this->assertTrue(PrestaShopVersionChecker::is('=1.6.1.24'));
    }

    public function testIsReturnsFalseWhenVersionDoesNotMatch()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::is('<>1.6.1.24'));
        $this->assertFalse(PrestaShopVersionChecker::is('<=1.6.0'));
        $this->assertFalse(PrestaShopVersionChecker::is('<1.6'));
        $this->assertFalse(PrestaShopVersionChecker::is('>=1.7'));
        $this->assertFalse(PrestaShopVersionChecker::is('>1.7'));
        $this->assertFalse(PrestaShopVersionChecker::is('==1.6.0'));
        $this->assertFalse(PrestaShopVersionChecker::is('!=1.6.1.24'));
        $this->assertFalse(PrestaShopVersionChecker::is('=1.6.0'));
    }

    public function testLtReturnsTrueWhenVersionIsLessThan()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::lt('1.7'));
    }

    public function testLtReturnsFalseWhenVersionIsNotLessThan()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::lt('1.6.0'));
    }

    public function testLteReturnsTrueWhenVersionIsLessThanOrEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::lte('1.6.1.24'));
    }

    public function testLteReturnsFalseWhenVersionIsNotLessThanOrEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::lte('1.6.0'));
    }

    public function testGtReturnsTrueWhenVersionIsGreaterThan()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::gt('1.6.0'));
    }

    public function testGtReturnsFalseWhenVersionIsNotGreaterThan()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::gt('1.7'));
    }

    public function testGteReturnsTrueWhenVersionIsGreaterThanOrEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::gte('1.6.1.24'));
    }

    public function testGteReturnsFalseWhenVersionIsNotGreaterThanOrEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::gte('1.7'));
    }

    public function testEqReturnsTrueWhenVersionIsEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::eq('1.6.1.24'));
    }

    public function testEqReturnsFalseWhenVersionIsNotEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::eq('=1.6.0'));
    }

    public function testNeqReturnsTrueWhenVersionIsNotEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertTrue(PrestaShopVersionChecker::neq('1.6.0'));
    }

    public function testNeqReturnsFalseWhenVersionIsEqual()
    {
        $this->setPrestaShopVersion();

        $this->assertFalse(PrestaShopVersionChecker::neq('1.6.1.24'));
    }

    private function setPrestaShopVersion()
    {
        if (!\defined('_PS_VERSION_')) {
            \define('_PS_VERSION_', '1.6.1.24');
        }
    }
}
