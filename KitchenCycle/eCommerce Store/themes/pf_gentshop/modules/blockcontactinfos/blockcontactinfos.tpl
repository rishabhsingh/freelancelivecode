{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- MODULE Block contact infos -->
<div  class="footer-block block contactinfos">
        <h4 class="title_block">{l s='Contact info' mod='blockcontactinfos'}</h4>
        <div class="toggle-footer ">
            <div class="list-group list">
                {if $blockcontactinfos_company != ''}
                    {$blockcontactinfos_company|escape:'html':'UTF-8'}
                {/if}
                
            </div>
        <ul class="list-group list">
            
            {if $blockcontactinfos_address != ''}
                <li>
                    <i class="icon-map-marker"></i>{$blockcontactinfos_address|escape:'html':'UTF-8'}
                </li>
            {/if}
            {if $blockcontactinfos_phone != ''}
                <li>
                    <i class="icon-phone"></i>{l s='Call us now:' mod='blockcontactinfos'} 
                    <span>{$blockcontactinfos_phone|escape:'html':'UTF-8'}</span>
                </li>
            {/if}
            {if $blockcontactinfos_email != ''}
                <li>
                    <i class="icon-envelope"></i>{l s='Email:' mod='blockcontactinfos'} 
                    <span>{mailto address=$blockcontactinfos_email|escape:'html':'UTF-8' encode="hex"}</span>
                </li>
            {/if}
        </ul>
    </div>
</div>
<!-- /MODULE Block contact infos -->
