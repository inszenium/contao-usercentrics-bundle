<?php

declare(strict_types=1);

// *
// * inszenium, Inh. Stefan Lehmann
// * Contao Default Theme
// *

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['hide']['eval']['tl_class'] = 'clr w50';

$GLOBALS['TL_DCA']['tl_page']['fields']['usercentricsApiKey'] = [
    'inputType' => 'text',
    'exclude' => true,
    'eval' => ['maxlength' => 128, 'tl_class' => 'w50', 'rgxp' => 'alnum'],
    'sql' => ['type' => 'string', 'length' => 128, 'default' => ''],
];

$GLOBALS['TL_DCA']['tl_page']['fields']['usercentricsProtectorActive'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'clr w50 m12'],
    'sql' => "char(1) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_page']['fields']['usercentricsEuProxy'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12'],
    'sql' => "char(1) NOT NULL default ''",
];

PaletteManipulator::create()
    ->addLegend('usercentrics_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE, true)
    ->addField('usercentricsApiKey', 'usercentrics_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('usercentricsProtectorActive', 'usercentrics_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('usercentricsEuProxy', 'usercentrics_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('rootfallback', 'tl_page')
;
