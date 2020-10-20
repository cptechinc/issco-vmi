$.fn.extend({
	loadin: function(href, callback) {
		var parent = $(this);
		parent.html('<div></div>');

		var element = parent.find('div');
		console.log('loading ' + href + " into " +  parent.returnelementdescription());
		element.load(href, function() {
			// init_datepicker();
			callback();
		});
	},
	returnelementdescription: function() {
		var element = $(this);
		var tag = element[0].tagName.toLowerCase();
		var classes = '';
		var id = '';
		if (element.attr('class')) {
			classes = element.attr('class').replace(' ', '.');
		}
		if (element.attr('id')) {
			id = element.attr('id');
		}
		var string = tag;
		if (classes) {
			if (classes.length) {
				string += '.'+classes;
			}
		}
		if (id) {
			if (id.length) {
				string += '#'+id;
			}
		}
		return string;
	},
	hasParent: function(selector) {
		var element = $(this);
		return $(this).closest(selector).length > 0;
	},
	formIsCompleted: function() {
		var form = $(this);
		form.find('.required').each(function() {
			if ($(this).val() === '') {
				return false;
			}
		});
		return true;
	},
	formDisableFields: function() {

	},
	resizeModal: function(size) {
		if ($(this).hasClass('modal')){
			var modal_dialog = $(this).find('.modal-dialog');
			var modal_size = '';

			var regex_modal = /(modal-)/;
			var regex_modal_size = /(modal-)(sm|md|lg|xl)/;
			var regex_sizes = /(sm|md|lg|xl)/;

			if (regex_modal_size.test(size)) {
				modal_size = size;
			} else {
				if (regex_sizes.test(size)) {

				} else {
					size = 'md';
				}
				modal_size = 'modal-' + size;
			}

			if (regex_modal_size.test(modal_dialog.attr('class'))) {
				var attrclass = modal_dialog.attr('class');
				attrclass = attrclass.replace(regex_modal_size, modal_size);
				modal_dialog.attr('class', attrclass);
			} else {
				modal_dialog.addClass(modal_size);
			}
		}
	},
	clearValidation: function(){
		var v = $(this).validate();
		$('[name]',this).each(function(){
			v.successList.push(this);
			v.showErrors();
		});
		v.resetForm();
		v.reset();
	}
});

// CREATE DEFAULT SWEET ALERT
const swal2 = Swal.mixin({
	customClass: {
		confirmButton: 'btn btn-success mr-3',
		cancelButton: 'btn btn-danger',
		inputClass: 'form-control',
		selectClass: 'form-control',
	},
	buttonsStyling: false
})
