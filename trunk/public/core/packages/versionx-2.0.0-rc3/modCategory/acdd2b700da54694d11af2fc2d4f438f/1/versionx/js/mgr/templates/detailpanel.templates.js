VersionX.panel.TemplatesDetail.Main = function(config) {
    config = config || {};
    Ext.apply(config,{
        id: 'versionx-panel-templatesdetail',
        border: false,
        layout: 'form',
        items: [{
            html: '<p>'+_('versionx.templates.detail.text')+'</p>',
            border: false,
            bodyCssClass: 'panel-desc'
        },{
            layout: 'form',
            cls: 'main-wrapper',
            labelWidth: 125,
            items: [{
                xtype: 'versionx-combo-templateversions',
                fieldLabel: _('versionx.compare_to'),
                labelStyle: 'padding: 7px 0 0 5px;',
                name: 'compare_to',
                baseParams: {
                    template: (VersionX.record) ? VersionX.record['content_id'] : 0,
                    current: (VersionX.record) ? VersionX.record['version_id'] : 0,
                    action: 'mgr/templates/get_versions'
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
                        id: 'versionx-panel-templatesdetail-versioninfo',
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
                        id: 'versionx-panel-templatesdetail-template-fields',
                        xtype: 'versionx-panel-common-detailpanel',
                        vxRecord: config.vxRecord,
                        vxRecordCmp: config.vxRecordCmp ? config.vxRecordCmp : undefined,
                        vxFieldMap: [
                            { key: 'templatename', lexicon:'name' },
                            { key: 'description', lexicon:'description' },
                            { key: 'category', lexicon:'category' }
                        ]
                    }]
                },{
                    title: _('versionx.common.content'),
                    items: [{
                        id: 'versionx-panel-templatesdetail-content',
                        xtype: 'versionx-panel-common-contentpanel',
                        border: false,
                        vxRecord: config.vxRecord,
                        vxRecordCmp: config.vxRecordCmp ? config.vxRecordCmp : undefined,
                        vxContentField: 'content'
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
    VersionX.panel.TemplatesDetail.Main.superclass.constructor.call(this,config);
};
Ext.extend(VersionX.panel.TemplatesDetail.Main,MODx.FormPanel,{
    compareVersion: function (tf) {
        var cmid = tf.getValue();
        var backTo = (MODx.request.backTo) ? '&backTo='+MODx.request.backTo : '';
        window.location.href = '?a='+VersionX.action+'&action=template&vid='+MODx.request['vid']+'&cmid='+cmid+backTo;
    }
});
Ext.reg('versionx-panel-templatesdetail',VersionX.panel.TemplatesDetail.Main);
