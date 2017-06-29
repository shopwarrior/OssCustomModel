{extends file='parent:frontend/custom/index.tpl'}

{* content wrapper *}
{block name="frontend_index_content" prepend}
    {block name="frontend_oss_custom_model"}
        <div class="container">
            {action module=widgets controller=OssCustomModel customId=$sCustomPage.id}
        </div>
    {/block}
{/block}