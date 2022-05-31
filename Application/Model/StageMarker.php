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

namespace D3\StageMarker\Application\Model;

use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Registry;

class StageMarker extends Base
{
    /**
     * @param string $output
     *
     * @return string
     */
    public function addStageMarker(string $output) :string
    {
        if ($this->stageBarIsActive()) {
            $re = $this->getRegexPattern();
            $subst = '$1'.$this->getMarkerHtml();
            $output = preg_replace($re, $subst, $output);
        }

        return $output;
    }

    /**
     * @return bool
     */
    protected function stageBarIsActive(): bool
    {
        return ( $this->stageBarIsActiveInFrontend() || $this->stageBarIsActiveInBackend());
    }

    /**
     * @return bool
     */
    protected function stageBarIsActiveInFrontend(): bool
    {
        return false === $this->isAdmin() &&
               Registry::getConfig()->getConfigParam('d3stagemarker_showinfrontend');
    }

    /**
     * @return bool
     */
    protected function stageBarIsActiveInBackend(): bool
    {
        return true === $this->isAdmin() &&
               Registry::getConfig()->getConfigParam('d3stagemarker_showinbackend') &&
               in_array($this->getClassItemKey(), $this->getBackendClassItemKeys());
    }

    /**
     * @return string
     */
    public function getClassItemKey(): string
    {
        return Registry::getConfig()->getActiveView()->getClassKey().':'.
               Registry::getRequest()->getRequestEscapedParameter('item');
    }

    /**
     * @return string[]
     */
    protected function getBackendClassItemKeys(): array
    {
        return [
            'login:',
            'navigation:header.tpl'
        ];
    }

    /**
     * @return string
     */
    protected function getRegexPattern(): string
    {
        return '/(<\s*\bbody\b.*?>)/m';
    }

    /**
     * @return string
     */
    public function getMarkerHtml(): string
    {
        return '<div id=stageMarker" '.$this->getImplodedMarkerCss().' '.$this->getMarkerJS().
               '>'.
                Registry::getConfig()->getConfigParam('d3stagemarker_stagetitle').
               '</div>';
    }

    /**
     * @return array
     */
    public function getMarkerCss(): array
    {
        return [
            'position'      => 'fixed',
            'background-color'  => Registry::getConfig()->getConfigParam('d3stagemarker_stagebgcolor') ?? 'red',
            'top'           => '0',
            'z-index'       => '9999',
            'width'         => '100%',
            'text-align'    => 'center',
            'font-weight'   => 'bold',
            'color'         => Registry::getConfig()->getConfigParam('d3stagemarker_stagefgcolor') ?? 'white',
            'padding'       => '0',
            'display'       => 'block',
            'font-size'     => '14px',
            'line-height'   => 'normal',
            'cursor'        => 'pointer'
        ];
    }

    /**
     * @return string
     */
    public function getImplodedMarkerCss(): string
    {
        $css = $this->getMarkerCss();

        array_walk($css, function(&$value, $key) {
            $value = "$key:$value;";
        });

        return ' style="'.implode('', $css).'" ';
    }

    /**
     * @return string
     */
    public function getMarkerJS(): string
    {
        return ' onclick="this.style.display=(this.style.display===\'block\' ? \'none\' : \'block\');" ';
    }
}