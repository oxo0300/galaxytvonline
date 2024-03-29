
VersionX.grid.TemplateVariables = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: VersionX.config.connector_url,
        id: 'versionx-grid-templatevars',
        baseParams: {
            action: 'mgr/templatevars/getlist',
            templatevar: (VersionX.inVersion) ? MODx.request['id'] : 0
        },
        params: [],
        viewConfig: {
            forceFit: true,
            enableRowBody: true,
            emptyText: _('versionx.error.noresults')
        },
        fields: [
            {name: 'version_id', type: 'int'},
            {name: 'content_id', type: 'int'},
            {name: 'name', type: 'string'},
            {name: 'categoryname', type: 'string'},
            {name: 'saved', type: 'string'},
            {name: 'username', type: 'string'},
            {name: 'mode', type: 'string'},
            {name: 'marked', type: 'boolean'}
        ],
        paging: true,
		remoteSort: true,
		columns: [{
			header: _('versionx.version_id'),
			dataIndex: 'version_id',
			sortable: true,
			width: .07
		},{
			header: _('versionx.content_id',{what: _('tv')}),
			dataIndex: 'content_id',
		    sortable: true,
			width: .05
		},{
			header: _('versionx.saved'),
			dataIndex: 'saved',
			sortable: true,
			width: .15
		},{
			header: _('name'),
			dataIndex: 'name',
		    sortable: true,
			width: .3
		},{
			header: _('category'),
			dataIndex: 'categoryname',
		    sortable: true,
			width: .15
		},{
			header: _('user'),
			dataIndex: 'username',
		    sortable: true,
			width: .1
		},{
			header: _('versionx.mode'),
			dataIndex: 'mode',
		    sortable: true,
			width: .05,
            renderer: function (val) { return _('versionx.mode.'+val); }
		},{
			header: _('versionx.marked'),
			dataIndex: 'marked',
		    sortable: true,
			width: .1,
            hidden: true
		}]
		,listeners: {}
    });
    VersionX.grid.TemplateVariables.superclass.constructor.call(this,config);
};
Ext.extend(VersionX.grid.TemplateVariables,MODx.grid.Grid,{
    getMenu: function() {
        var r = this.getSelectionModel().getSelected();
        var d = r.data;

        var m = [];
        m.push({
            text: _('versionx.menu.viewdetails'),
            handler: function(grid, rowIndex, e) {
                var eid = d.version_id;
                var backTo = (VersionX.inVersion) ? '&backTo='+MODx.request['a']+'-'+MODx.request['id'] : '';
                window.location.href = '?a='+VersionX.action+'&action=templatevar&vid='+eid+backTo;
            }
        });
        if (m.length > 0) {
            this.addContextMenuItem(m);
        }
    }
});
Ext.reg('versionx-grid-templatevars',VersionX.grid.TemplateVariables);
