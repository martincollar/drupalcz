<?php

declare(strict_types=1);

use DrupalFinder\DrupalFinder;
use DrupalRector\Set\Drupal8SetList;
use DrupalRector\Set\Drupal9SetList;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    // Configure Drupal deprecation sets for Drupal 9, 10, and beyond
    $rectorConfig->sets([
        // All Drupal 8 deprecations (needed for D9+ compatibility)
        Drupal8SetList::DRUPAL_8,
        // All Drupal 9 deprecations (needed for D10+ compatibility)
        Drupal9SetList::DRUPAL_9,
    ]);

    $parameters = $rectorConfig->parameters();

    // Locate Drupal root and configure autoload paths
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(__DIR__);
    $drupalRoot = $drupalFinder->getDrupalRoot();

    // Autoload custom code for better analysis
    $rectorConfig->autoloadPaths([
        $drupalRoot . '/core',
        $drupalRoot . '/modules/contrib',
        $drupalRoot . '/modules/custom',
        $drupalRoot . '/profiles/custom',
        $drupalRoot . '/themes/custom',
    ]);

    // Define paths to process - only custom code
    $rectorConfig->paths([
        $drupalRoot . '/modules/custom',
        $drupalRoot . '/themes/custom',
        $drupalRoot . '/profiles/custom',
    ]);

    // Skip problematic paths
    $rectorConfig->skip([
        '*/upgrade_status/tests/modules/*',
        '*/vendor/*',
        '*/node_modules/*',
        '*/core/*',
        '*/libraries/*',
        '*/modules/contrib/*',
        '*/themes/contrib/*',
    ]);

    // Drupal-specific file extensions
    $rectorConfig->fileExtensions([
        'php',
        'module',
        'theme',
        'install',
        'profile',
        'inc',
        'engine',
    ]);

    // Import configuration
    $rectorConfig->importNames(true, false);
    $rectorConfig->importShortClasses(false);

    // Add Drupal-specific notices as comments
    $parameters->set('drupal_rector_notices_as_comments', true);
};
