Ext.define('Shopware.apps.OssCustomModel.view.list.List', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.oss-custom-model-list-window',
    region: 'center',

    configure: function() {
        return {
            detailWindow: 'Shopware.apps.OssCustomModel.view.detail.Window',

            columns: {
                name: {},
                date: {},
                content: {},
                active: { width: 60, flex: 0 }
            }
        };
    }
});
