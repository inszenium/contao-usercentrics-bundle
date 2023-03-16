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

namespace Inszenium\ContaoUsercentricsBundle\ContaoManager;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create('Inszenium\ContaoUsercentricsBundle\UsercentricsBundle')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle']),
        ];
    }
}
