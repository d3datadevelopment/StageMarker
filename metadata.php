<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types=1);

/**
 * Metadata version
 */

use D3\StageMarker\Modules\Core\Output as ModuleOutput;
use OxidEsales\Eshop\Core\Output as OxidOutput;

$sMetadataVersion = '2.1';

$sModuleId = 'd3stagemarker';
$logo = '<img src="https://logos.oxidmodule.com/d3logo.svg" alt="(D3)" style="height:1em;width:1em">';

/**
 * Module information
 */
$aModule = [
    'id'          => $sModuleId,
    'title'       => $logo.' Stage Marker',
    'description' => [
        'de' => '',
        'en' => '',
    ],
    'thumbnail'   => '',
    'version'     => '1.0.0.0',
    'author'      => 'D&sup3; Data Development (Inh.: Thomas Dartsch)',
    'email'       => 'support@shopmodule.com',
    'url'         => 'https://www.oxidmodule.com/',
    'controllers' => [],
    'extend'      => [
        OxidOutput::class => ModuleOutput::class
    ],
    'events'      => [],
    'templates'   => [],
    'settings'    => [
        [
            'group'     => $sModuleId.'_general',
            'name'      => $sModuleId.'_showinfrontend',
            'type'      => 'bool',
            'value'     => false,
        ],
        [
            'group'     => $sModuleId.'_general',
            'name'      => $sModuleId.'_showinbackend',
            'type'      => 'bool',
            'value'     => false,
        ],
        [
            'group'     => $sModuleId.'_general',
            'name'      => $sModuleId.'_stagetitle',
            'type'      => 'str',
            'value'     => false,
        ],
        [
            'group'     => $sModuleId.'_general',
            'name'      => $sModuleId.'_stagebgcolor',
            'type'      => 'str',
            'value'     => 'red',
        ],
        [
            'group'     => $sModuleId.'_general',
            'name'      => $sModuleId.'_stagefgcolor',
            'type'      => 'str',
            'value'     => 'white',
        ],
    ],
    'blocks'      => [],
];
