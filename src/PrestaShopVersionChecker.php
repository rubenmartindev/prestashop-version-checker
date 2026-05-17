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
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public static function is($compare)
    {
        if (!\defined('_PS_VERSION_')) {
            throw new RuntimeException('PrestaShop is not initialized');
        }

        $compare = self::parseCompare($compare);

        return \version_compare(_PS_VERSION_, $compare['version'], $compare['operator']);
    }

    /**
     * Check if the compare is valid
     *
     * @param string $compare
     *
     * @return bool
     */
    public static function isCompareValid($compare)
    {
        try {
            self::parseCompare($compare);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    /**
     * Check if the current version of PrestaShop is lower than the given version
     *
     * @deprecated Since 1.1.0 and will be removed in the next major. Use method PrestaShopVersionChecker::is().
     *
     * @param string $version
     *
     * @return bool
     */
    public static function lt($version)
    {
        @\trigger_error(
            \sprintf('%s is deprecated since 1.1.0 and will be removed in the next major. Use %s::%s() instead.', __METHOD__, __CLASS__, 'is'),
            \E_USER_DEPRECATED
        );

        return self::is("<{$version}");
    }

    /**
     * Check if the current version of PrestaShop is lower than or equal to the given version
     *
     * @deprecated Since 1.1.0 and will be removed in the next major. Use method PrestaShopVersionChecker::is().
     *
     * @param string $version
     *
     * @return bool
     */
    public static function lte($version)
    {
        @\trigger_error(
            \sprintf('%s is deprecated since 1.1.0 and will be removed in the next major. Use %s::%s() instead.', __METHOD__, __CLASS__, 'is'),
            \E_USER_DEPRECATED
        );

        return self::is("<={$version}");
    }

    /**
     * Check if the current version of PrestaShop is higher than the given version
     *
     * @deprecated Since 1.1.0 and will be removed in the next major. Use method PrestaShopVersionChecker::is().
     *
     * @param string $version
     *
     * @return bool
     */
    public static function gt($version)
    {
        @\trigger_error(
            \sprintf('%s is deprecated since 1.1.0 and will be removed in the next major. Use %s::%s() instead.', __METHOD__, __CLASS__, 'is'),
            \E_USER_DEPRECATED
        );

        return self::is(">{$version}");
    }

    /**
     * Check if the current version of PrestaShop is higher than or equal to the given version
     *
     * @deprecated Since 1.1.0 and will be removed in the next major. Use method PrestaShopVersionChecker::is().
     *
     * @param string $version
     *
     * @return bool
     */
    public static function gte($version)
    {
        @\trigger_error(
            \sprintf('%s is deprecated since 1.1.0 and will be removed in the next major. Use %s::%s() instead.', __METHOD__, __CLASS__, 'is'),
            \E_USER_DEPRECATED
        );

        return self::is(">={$version}");
    }

    /**
     * Check if the current version of PrestaShop is equal to the given version
     *
     * @deprecated Since 1.1.0 and will be removed in the next major. Use method PrestaShopVersionChecker::is().
     *
     * @param string $version
     *
     * @return bool
     */
    public static function eq($version)
    {
        @\trigger_error(
            \sprintf('%s is deprecated since 1.1.0 and will be removed in the next major. Use %s::%s() instead.', __METHOD__, __CLASS__, 'is'),
            \E_USER_DEPRECATED
        );

        return self::is("=={$version}");
    }

    /**
     * Check if the current version of PrestaShop is not equal to the given version
     *
     * @deprecated Since 1.1.0 and will be removed in the next major. Use method PrestaShopVersionChecker::is().
     *
     * @param string $version
     *
     * @return bool
     */
    public static function neq($version)
    {
        @\trigger_error(
            \sprintf('%s is deprecated since 1.1.0 and will be removed in the next major. Use %s::%s() instead.', __METHOD__, __CLASS__, 'is'),
            \E_USER_DEPRECATED
        );

        return self::is("!={$version}");
    }

    /**
     * @param string $compare
     *
     * @return array{operator: string, version: string}
     *
     * @throws InvalidArgumentException
     */
    private static function parseCompare($compare)
    {
        if (false === \is_string($compare)) {
            throw new InvalidArgumentException('$compare must be a string');
        }

        $compare = \trim($compare);
        $compare = \str_replace(' ', '', $compare);

        if (false == \preg_match('/^(<>|<=|<|>=|>|==|!=|=|lt|le|gt|ge|eq|ne)/i', $compare, $operator)) {
            throw new InvalidArgumentException('Invalid operator comparison, expected one of: "<>", "<=", "<," ">=", ">," "==", "=," "!=", "lt", "le", "gt", "ge", "eq" or "ne"');
        }

        $operator = \reset($operator);
        $operator = \strtolower($operator);

        if (false == \preg_match('/(\d+\.?)+$/', $compare, $version)) {
            throw new InvalidArgumentException('Invalid version comparison, expected a version number');
        }

        $version = \reset($version);

        return [
            'operator'  => $operator,
            'version'   => $version,
        ];
    }
}
