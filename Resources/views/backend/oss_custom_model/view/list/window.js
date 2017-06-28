Ext.define('Shopware.apps.OssCustomModel.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.oss-custom-model-list-window',
    height: 450,
    title : '{s name=window_title}Custom Model Listing{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.OssCustomModel.view.list.List',
            listingStore: 'Shopware.apps.OssCustomModel.store.Main'
        };
    }
});