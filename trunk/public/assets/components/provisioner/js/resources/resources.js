/**
 * Loads the panel for managing resources.
 * 
 * @class PV.panel.Resources
 * @extends MODx.FormPanel
 * @param {Object} config An object of configuration properties
 * @xtype pv-panel-resources
 */
PV.panel.Resources = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        id: 'pv-panel-resources'
		,title: _('menu_resources_tab')
        ,bodyStyle: ''
        ,padding: 10
        ,defaults: { collapsible: false ,autoHeight: true }
        ,items: [{
            html: '<h2>'+_('pv_resources')+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
            ,id: 'pv-resources-header'
        },{            
            html: '<p>'+_('resources_desc')+'</p>'
            ,border: false

         },{
            xtype: 'pv-tree-resource'     
        	
		}]
    });
    PV.panel.Resources.superclass.constructor.call(this,config);
};
Ext.extend(PV.panel.Resources,MODx.FormPanel);
Ext.reg('pv-panel-resources',PV.panel.Resources);
