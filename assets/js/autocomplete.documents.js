/**
 * function to have autocomplete metaboxes in admin
 *
 * @since     1.0.0
 */

jQuery(document).ready(function ($) {

	$('body').on('click', 'input.wol-relationships', function () {

		// Setting variables
		var cache = {};

		// Get the method to use in ajax call
		var method = $(this).data("method");
		// Get the element that will receive the related element ID
		var elem_id = $(this).data("elem_id");

		var parent = $(this).parent();

		$(this).autocomplete({
			source   : function (request, response) {

				// The term to search by ajax
				var term = request.term;

				// If it is already in the cache return it with no ajax call
				if (term in cache) {
					response(cache[term]);
					return;
				}

				$.getJSON(ajaxurl, {
					action: 'relationship_autocomplete',
					method: method,
					term  : term
				}, function (data, status, xhr) {
					// Put the answer in the cache and return it
					cache[term] = data.data;
					response(data.data);
				});
			},
			// Min chars length for activating autocomplete
			minLength: 4,

			// Selecting one of the suggested elements
			select: function (event, ui) {

				// Set the value
				$(this).val(ui.item.value);

				// Set the ID
				if ($(this).hasClass('row_desc')) {
					$(this).parent().children('.' + elem_id).val(ui.item.id);
				} else {
					$(this).closest('td').children('#' + elem_id).val(ui.item.id);
				}

				// Avoid any other action
				return false;
			}
		});
	});

	$('span.delete_single_relationship').click(function () {
		var rel_id    = $(this).data("rel_id");
		var tr_parent = $(this).closest('tr');
		$.getJSON(ajaxurl, {
			action: 'delete_relationship',
			rel_id: rel_id
		}, function (data, status, xhr) {
			response = data.data;
			if ("ok" == response['status']) {
				tr_parent.remove();
				$('table.new-relationship').show();
			} else {
				console.log('error');
			}
		})
	});

	$('span.delete_multi_relationship').click(function () {
		var rel_id    = $(this).data("rel_id");
		var tr_parent = $(this).closest('tr');
		$.getJSON(ajaxurl, {
			action: 'delete_relationship',
			rel_id: rel_id
		}, function (data, status, xhr) {
			response = data.data;
			if ("ok" == response['status']) {
				tr_parent.remove();
			} else {
				console.log('error');
			}
		})
	});

	$("span.add_new_relationship").live('click', function () {
		var table_parent = $(this).closest('table');
		var tr_parent = $(this).closest('tr');
		var clone_tr  = tr_parent.clone();

		clone_tr.find('.to_reset').val('');

		tr_parent.after(clone_tr);

		// Check if there is only one add new relationship
		var nr_input = $(table_parent).find("input.to_reset").length;
		if ( 2 < nr_input ) {
			$(table_parent).find(".delete_new_relationship").each(function () {
				$(this).show();
			});
		}

	});

	$("span.delete_new_relationship").live('click', function () {
		var table_parent = $(this).closest('table');
		var tr_parent    = $(this).closest('tr');

		tr_parent.remove();

		// Check if there is only one add new relationship
		var nr_input = $(table_parent).find("input.to_reset").length;
		if (2 < nr_input) {
			$(table_parent).find(".delete_new_relationship").each(function () {
				$(this).show();
			});

		} else {
			$(table_parent).find(".delete_new_relationship").each(function () {
				$(this).hide();
			});
		}
	});

	// Avoid submitting form with a return
	$(window).keydown(function (event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
});
