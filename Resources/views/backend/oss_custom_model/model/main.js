Ext.define('Shopware.apps.OssCustomModel.model.Main', {
    extend: 'Shopware.data.Model',

    configure: function() {
        return {
            controller: 'OssCustomModel',
            detail: 'Shopware.apps.OssCustomModel.view.detail.Container'
        };
    },

    fields: [
        { name : 'id', type: 'int', useNull: true },
        { name : 'active', type: 'boolean' },
        { name : 'name', type: 'string', useNull: false },
        { name : 'date', type: 'date' },
        { name : 'content', type: 'string', useNull: false }
    ]
});

