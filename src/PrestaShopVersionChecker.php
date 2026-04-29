<?php

namespace RubenMartinDev\PrestaShopVersionChecker;

use InvalidArgumentException;
use RuntimeException;

class PrestaShopVersionChecker
{
    /**
     * Check if the current version of PrestaShop matches the comparison
     *
     * @param string $compare
     *
     * @return bool
     */
    public static function is($compare)
    {
        if (!\defined('_PS_VERSION_')) {
            throw new RuntimeException('PrestaShop is not initialized');
        }

        $compare = \str_replace(' ', '', $compare);
        $compare = \trim($compare);

        if (!\preg_match('/^<>|<=|<|>=|>|==|!=|=/', $compare, $operator)) {
            throw new InvalidArgumentException('Invalid operator comparison, expected one of: <, <=, >, >=, ==, =, !=, <>');
        }

        if (!\preg_match('/(\d+\.?)+$/i', $compare, $version)) {
            throw new InvalidArgumentException('Invalid version comparison, expected a version number');
        }

        return \version_compare(_PS_VERSION_, $version[0], $operator[0]);
    }

    /**
     * Check if the current version of PrestaShop is lower than the given version
     *
     * @param string $version
     *
     * @return bool
     */
    public static function lt($version)
    {
        return self::is("<{$version}");
    }

    /**
     * Check if the current version of PrestaShop is lower than or equal to the given version
     *
     * @param string $version
     *
     * @return bool
     */
    public static function lte($version)
    {
        return self::is("<={$version}");
    }

    /**
     * Check if the current version of PrestaShop is higher than the given version
     *
     * @param string $version
     *
     * @return bool
     */
    public static function gt($version)
    {
        return self::is(">{$version}");
    }

    /**
     * Check if the current version of PrestaShop is higher than or equal to the given version
     *
     * @param string $version
     *
     * @return bool
     */
    public static function gte($version)
    {
        return self::is(">={$version}");
    }

    /**
     * Check if the current version of PrestaShop is equal to the given version
     *
     * @param string $version
     *
     * @return bool
     */
    public static function eq($version)
    {
        return self::is("=={$version}");
    }

    /**
     * Check if the current version of PrestaShop is not equal to the given version
     *
     * @param string $version
     *
     * @return bool
     */
    public static function neq($version)
    {
        return self::is("!={$version}");
    }
}
