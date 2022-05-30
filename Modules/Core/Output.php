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

namespace D3\StageMarker\Modules\Core;

use D3\StageMarker\Application\Model\StageMarker;

class Output extends Output_parent
{
    public function process( $sValue, $sClassName ) : string
    {
        $output = parent::process( $sValue, $sClassName );

        $stageMarker = oxNew(StageMarker::class);
        return $stageMarker->addStageMarker( $output);
    }
}