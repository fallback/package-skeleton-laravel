<?php

namespace Spatie\Skeleton;

use OriginalVendor\LaravelPackageTools\Package;
use OriginalVendor\LaravelPackageTools\PackageServiceProvider;
use Spatie\Skeleton\Commands\SkeletonCommand;

class SkeletonServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(':package_name')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_skeleton_table')
            ->hasCommand(SkeletonCommand::class);
    }

    public function bootingPackage(): void
    {
        $routesDirectory = __DIR__ . '/../routes';
        foreach (new \DirectoryIterator($routesDirectory) as $fileinfo) {
            if ($fileinfo->isFile())
            {
                $this->loadRoutesFrom($routesDirectory . '/' . $fileinfo->getFilename());
            }
        }
    }
}
