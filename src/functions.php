<?php

use RubenMartinDev\PrestaShopVersionChecker\PrestaShopVersionChecker;

if (!function_exists('is_ps_version')) {
    /**
     * Check if the current version of PrestaShop matches the comparison
     *
     * @param string $compare
     *
     * @return bool
     */
    function is_ps_version($compare)
    {
        return PrestaShopVersionChecker::is($compare);
    }
}
