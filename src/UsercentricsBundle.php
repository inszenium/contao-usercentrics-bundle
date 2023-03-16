<?php

declare(strict_types=1);

/*
 * This file is part of Usercentrics.
 *
 * (c) Kirsten Roschanski 2023 <support@inszenium.de>
 * @license GPL-3.0-or-later
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 * @link https://github.com/inszenium/contao-usercentrics-bundle
 */

namespace Inszenium\ContaoUsercentricsBundle;

use Inszenium\ContaoUsercentricsBundle\DependencyInjection\UsercentricsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UsercentricsBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): UsercentricsExtension
    {
        return new UsercentricsExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

    }
}
