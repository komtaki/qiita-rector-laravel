<?php

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    // リファクタリングディレクトリの指定
    $parameters->set(Option::PATHS, [__DIR__ . '/app', __DIR__ . '/tests']);
    // php version指定
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_74);
    // phpstan設定ファイルの読み込み
    $parameters->set(Option::PHPSTAN_FOR_RECTOR_PATH, getcwd() . '/phpstan.neon');

    $parameters->set(Option::AUTOLOAD_PATHS, [
        __DIR__ . '/config',
    ]);

    $parameters->set(Option::BOOTSTRAP_FILES, [
        __DIR__ . '/bootstrap/app.php',
        __DIR__ . '/rector-bootstrap.php',
    ]);

    $services = $containerConfigurator->services();
    $services->set(TypedPropertyRector::class);
};
