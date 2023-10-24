"use strict";
var LeadsRendering = function() {

	var init = function() {
		var table = $('#m_datatable');

		table.DataTable({
			responsive: true,
			paging: true,
			columns: [
				{
					title: '#',
                    data: 'id',
					render: function(data, type, full, meta) {
						var number = KTUtil.getRandomInt(1, 14);
						return output;
					},
				},
				{
                    title: 'Name',
					data: 'name',
				},
                {
                    title: 'Email',
					data: 'email',
                    render: function(data, type, full, meta) {
                        return '<a href="mailto:' + data + '">' + data + '</a>';
                    }
				},
                {
                    title: 'Phone',
					data: 'phone',
				},
                {
                    title: 'Tags',
					data: 'tags_id',
				},
                {
                    title: 'Campaign Used',
					data: 'used_campaigns_ids',
				},
                {
                    title: 'Campaign Exclusion',
					data: 'exclude_campaigns_ids',
				},
                {
                    title: 'Creation Date',
					data: 'created_at',
				},
				{
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return '\
							<a href="javascript:;" class="btn btn-block bg-gradient-success btn-sm" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="javascript:;" class="btn btn-block bg-gradient-danger btn-sm" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
					},
				},
			],
            ajax: 'data/objects.txt',
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			init();
		}
	};
}();

jQuery(document).ready(function() {
	LeadsRendering.init();
});
