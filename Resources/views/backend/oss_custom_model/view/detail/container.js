Ext.define('Shopware.apps.OssCustomModel.view.detail.Container', {
    extend: 'Shopware.model.Container',
    padding: 20,

    /**
     * Translations
     * @object
     */
    snippets : {
        growlMessage: '{s name=window/main_title}Custom Model{/s}'
    },

    configure: function() {
        var me = this;

        return {
            controller: 'OssCustomModel',

            fieldSets: [{
                title: 'Product data',
                fields: {
                    name: {},
                    active: {},
                    date: {}
                }
            }, {
                title: 'Additional data',
                layout: 'fit',
                fields: {
                    content: {
                        fieldLabel: "Content",
                        xtype: 'tinymce',
                        anchor: '95%',
                        margin: '0 0 15'
                    }
                }
            }]
        };
    }
});