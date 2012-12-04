VersionX.panel.SnippetsDetail = function(config) {
    config = config || {};
    Ext.apply(config,{
        id: 'versionx-panel-snippetsdetail',
        border: false,
        layout: 'form',
        items: [{
            html: '<p>'+_('versionx.snippets.detail.text')+'</p>',
            border: false,
            bodyCssClass: 'panel-desc'
        },{
            layout: 'form',
            cls: 'main-wrapper',
            labelWidth: 125,
            items: [{
                xtype: 'versionx-combo-snippetversions',
                fieldLabel: _('versionx.compare_to'),
                labelStyle: 'padding: 7px 0 0 5px;',
                name: 'compare_to',
                baseParams: {
                    snippet: (VersionX.record) ? VersionX.record['content_id'] : 0,
                    current: (VersionX.record) ? VersionX.record['version_id'] : 0,
                    action: 'mgr/snippets/get_versions'
                },
                listeners: {
                    'select': this.compareVersion
                }
            },{
                xtype: 'panel',
                bodyStyle: 'height: 12px',
                border: false
            },{
                xtype: 'modx-tabs',
                bodyStyle: 'padding: 15px;',
                width: '98%',
                border: true,
                defaults: {
                    border: false,
                    autoHeight: true,
                    defaults: {
                        border: false
                    }
                },
                items: [{
                    title: _('versionx.common.version-details'),
                    items: [{
                        id: 'versionx-panel-snippetsdetail-versioninfo',
                        xtype: 'versionx-panel-common-detailpanel',
                        vxRecord: config.vxRecord,
                        vxRecordCmp: config.vxRecordCmp ? config.vxRecordCmp : undefined,
                        vxFieldMap: [
                            { key: 'version_id', lexicon:'versionx.version_id' },
                            { key: 'user', lexicon:'user' },
                            { key: 'saved', lexicon:'versionx.saved' },
                            { key: 'mode', lexicon:'versionx.mode' }
                        ]
                    }]
                },{
                    title: _('versionx.common.fields'),
                    items: [{
                        id: 'versionx-panel-snippetsdetail-snippet-fields',
                        xtype: 'versionx-panel-common-detailpanel',
                        vxRecord: config.vxRecord,
                        vxRecordCmp: config.vxRecordCmp ? config.vxRecordCmp : undefined,
                        vxFieldMap: [
                            { key: 'name', lexicon:'name' },
                            { key: 'description', lexicon:'description' },
                            { key: 'category', lexicon:'category' }
                        ]
                    }]
                },{
                    title: _('versionx.common.content'),
                    items: [{
                        id: 'versionx-panel-snippetsdetail-content',
                        xtype: 'versionx-panel-common-contentpanel',
                        border: false,
                        vxRecord: config.vxRecord,
                        vxRecordCmp: config.vxRecordCmp ? config.vxRecordCmp : undefined,
                        vxContentField: 'snippet'
                    }]
                },{
                    title: _('versionx.common.properties'),
                    tabTip: _('versionx.common.properties.off'),
                    items: [],
                    disabled: true
                }]
            }]
        }],
        listeners: {
        }
    });
    VersionX.panel.SnippetsDetail.superclass.constructor.call(this,config);
};
Ext.extend(VersionX.panel.SnippetsDetail,MODx.FormPanel,{
    compareVersion: function (tf) {
        var cmid = tf.getValue();
        var backTo = (MODx.request.backTo) ? '&backTo='+MODx.request.backTo : '';
        window.location.href = '?a='+VersionX.action+'&action=snippet&vid='+MODx.request['vid']+'&cmid='+cmid+backTo;
    }
});
Ext.reg('versionx-panel-snippetsdetail',VersionX.panel.SnippetsDetail);
