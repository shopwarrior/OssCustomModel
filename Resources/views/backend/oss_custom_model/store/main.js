
Ext.define('Shopware.apps.OssCustomModel.store.Main', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'OssCustomModel'
        };
    },
    model: 'Shopware.apps.OssCustomModel.model.Main'
});