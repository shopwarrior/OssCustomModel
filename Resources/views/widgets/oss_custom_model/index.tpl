{if $ossCustomModels|count}
    <div
            class="image-slider" data-image-slider="true" data-thumbnails="false" data-loopslides="true"
            data-dotnavigation="true" data-startIndex="{count($ossCustomModels)-1}"
    >
        <div class="image-slider--container">
            <div class="content-slider--title-wrapper">
                <h1>{s name="OssCustomModelTitle"}Slider with Custom Models there{/s}</h1>
            </div>

            <div class="image-slider--slide">
                {$mediaFile = {link file='frontend/_public/src/img/no-picture.jpg'}}
                {if $ossCustomBanner}
                    {$mediaFile = $ossCustomBanner.source}
                {/if}
                {foreach $ossCustomModels as $model}
                    <div class="image-slider--item" style="background-image: url('{$mediaFile}')">
                        {include file="widgets/oss_custom_model/_include/item.tpl" item=$model}
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
{/if}