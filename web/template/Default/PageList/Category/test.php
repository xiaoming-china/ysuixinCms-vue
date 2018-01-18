{nav}
    {foreach from=$list item=v}  
     <li><a href="{$v.url}">{$v.catid}{$v.name}</a></li>  
    {/foreach}  
{/nav}