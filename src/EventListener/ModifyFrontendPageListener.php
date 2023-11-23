<?php

namespace Inszenium\ContaoUsercentricsBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Template;
use Contao\PageModel;

/*
<!-- BEGIN Usercentrics related code -->
<link rel="preconnect" href="//app.usercentrics.eu">
<link rel="preconnect" href="//api.usercentrics.eu">
<link rel="preconnect" href="//privacy-proxy.usercentrics.eu">
<link rel="preload" href="//app.usercentrics.eu/browser-ui/latest/bundle.js" as="script">
<link rel="preload" href="//privacy-proxy.usercentrics.eu/latest/uc-block.bundle.js" as="script">
<script id="usercentrics-cmp" data-settings-id="JQtvKIE0y" src="https://app.usercentrics.eu/browser-ui/latest/bundle.js" defer></script>
<script type="application/javascript" src="https://privacy-proxy.usercentrics.eu/latest/uc-block.bundle.js"></script>
<!-- END Usercentrics related code -->
*/

/**
 * @Hook("parseFrontendTemplate")
 */
class ModifyFrontendPageListener
{
    public function __invoke(string $buffer, string $templateName): string
    {
        if (false === strpos($templateName, 'fe_', 0)) {
            return $buffer;
        }

        global $objPage;  
        $objRootPage = PageModel::findByPk($objPage->rootId);
        if (isset($objRootPage->usercentricsApiKey) && $objRootPage->usercentricsApiKey != '') {      
            $settingId = $objRootPage->usercentricsApiKey;
            $protector = $objRootPage->usercentricsProtectorActive;
            $euProxy   = $objRootPage->usercentricsEuProxy;

        } elseif ($objPage->languageMain) {
            $objPageMain = PageModel::findByPk($objPage->languageMain);
            $objRootPage = PageModel::findByPk($objPageMain->rootId);
            $settingId = $objRootPage->usercentricsApiKey;
            $protector = $objRootPage->usercentricsProtectorActive;
            $euProxy   = $objRootPage->usercentricsEuProxy;
        }     

        if (!empty($settingId)) {
            if((int)$euProxy === 1) {
                $script = sprintf('
                    <!-- BEGIN Usercentrics related code -->
                    <link rel="preconnect" href="//app.eu.usercentrics.eu">
                    <link rel="preconnect" href="//api.eu.usercentrics.eu">
                    <link rel="preconnect" href="//sdp.eu.usercentrics.eu">
                    <link rel="preload" href="//app.eu.usercentrics.eu/browser-ui/latest/loader.js"as="script">
                    <script id="usercentrics-cmp" async data-eu-mode="true" data-settings-id="%s" src="https://app.eu.usercentrics.eu/browser-ui/latest/loader.js"></script>',$settingId);
                if ((int)$protector === 1) {
                    $script .= '
                    <link rel="preload" href="//sdp.eu.usercentrics.eu/latest/uc-block.bundle.js" as="script">
                    <script type="application/javascript" src="https://sdp.eu.usercentrics.eu/latest/uc-block.bundle.js"></script>';
                }
                $script .= '
                    <!-- END Usercentrics related code -->';
            } else {
                $script = sprintf('
                    <!-- BEGIN Usercentrics related code -->
                    <link rel="preconnect" href="//app.usercentrics.eu">
                    <link rel="preconnect" href="//api.usercentrics.eu">
                    <link rel="preconnect" href="//sdp.usercentrics.eu">
                    <link rel="preload" href="//app.usercentrics.eu/browser-ui/latest/loader.js"as="script">
                    <script id="usercentrics-cmp" async data-eu-mode="true" data-settings-id="%s" src="https://app.usercentrics.eu/browser-ui/latest/loader.js"></script>',$settingId);    
                if ((int)$protector === 1) {
                    $script .= '
                    <link rel="preload" href="//sdp.usercentrics.eu/latest/uc-block.bundle.js" as="script">
                    <script type="application/javascript" src="https://sdp.usercentrics.eu/latest/uc-block.bundle.js"></script>';
                }
                $script .= '
                    <!-- END Usercentrics related code -->';
            }

            $buffer = str_replace(
                '</title>',
                "</title>\n$script",
                $buffer
            );
        }

        return $buffer;
    }
}
