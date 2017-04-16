/* dropdown-advanced plugin */
(function($) {
	// safe to use $ here and not cause conflicts
	$.fn.extend({
		dropdownadvanced: function(options) {
			var opts = $.extend({}, $.fn.dropdownadvanced.defaults, options);
			output_debug = opts.debug;

			var debug = function(message) {
				if (opts.debug === true) {
					//console.log(message);
				}
			};

			return this.each(function() {
				var t = this;
				var select_area = $(this).find('.dropdown-advanced-select-area');
				var options = $(this).find('.dropdown-options');

				var select = $('[name=' + $(this).attr('rel') + ']');
				select.hide();

				$(this).parent().show();

				select.live('change', function() {
					var text = $(this).find(':selected').text();
					// console.log('The select changed to: "' + text +  '"');
					$(t).parent().find('.dropdown-label').text(text);
				});

				var clearMenus = function() {
					$(t).parents().filter('.btn-group').removeClass('open');
				};

				var releasePopup = function() {
					$('.dropdown-input-add-new-name, input[name=q]').val('');
					options.find('li').removeClass('hide');
					clearMenus(t);
				};

				// Binding the click to a link in the options.
				var bind_clicks_to_options = function() {
					options.find('a').unbind('click');
					options.find('a').click(function() {
						var value = $(this).attr("value");
						debug('Item clicked "' + value + '".');

						select.find('option').removeAttr('selected');
						select.find('[value="' + value + '"]').attr('selected', 'selected');

						options.find('li').removeClass('active');
						$(this).parent().addClass('active');

						select.change();
						releasePopup();
						return false;
					});
				};

				var create_dropdown_option = function(value, id, _class) {
					return $('<li>').addClass(_class).append($('<a>').attr({href: '', value: id}).text(value));
				};

				// When start, populate the dropdown options with the select options.
				select.find('option').each(function(i, e) {
					var id = $(e).attr('value');
					var value = $(e).text();
					if ($(e).attr('selected') == 'selected') {
						_class = 'active';
					} else {
						_class = undefined;
					}
					var li = create_dropdown_option(value, id, _class);
					options.append(li);
					bind_clicks_to_options();
				});

				// Creating error div and appending to select-area.
				debug('Creating erro div.');
				$('<div>').addClass('error').text('').prependTo(select_area);

				// apply plugin functionality to each element
				if ($(this).hasClass('dropdown-with-search')) {
					debug('Creating the search input.');
					var label = $('<label>').addClass('control-label').text('Buscar');
					var input = $('<input>').attr({type: 'search', name: 'q'});
					var wrapper = $('<div>').addClass('dropdown-search');
					select_area.prepend(wrapper.append(label).append(input));

					debug('Binding keyup for ".dropdown-search input".');
					// Searching when type.
					$(this).find('.dropdown-search input').keyup(function() {
						var text = $(this).val();
						debug('Searching for "' + text + '".');
						// debug(options.find('li a'));
						options.find('li').addClass('hide');
						var search = options.find('li a:contains("' + text + '")');
						if (search.length) {
							select_area.find('.error').hide();
							search.each(function(i, e) {
								$(e).parent().removeClass('hide');
							});
						} else {
							select_area.find('.error').text('Nenhum item encontrado.').show();
						}
					});
				}

				// Hack to contains work ignoring case-sensitive.
				// $.expr[':'].icontains = function(obj, index, meta, stack) {
				// return (obj.textContent || obj.innerText || jQuery(obj).text() || '').toLowerCase().indexOf(meta[3].toLowerCase()) >= 0;
				// };

				var show_add_new = function() {
					$(t).find('.dropdown-add-new').show();
					select_area.hide();
				};

				var show_select_area = function() {
					$(t).find('.dropdown-add-new').hide();
					select_area.show();
				};

				var add_callback = function(value, id, err) {
					debug('Called the callback function from btn-add-new.');
					if (err) {
						debug('Error whiling trying to create new item "' + err + '".');
						alert('Erro ao tentar criar o item: ' + err);
					} else {
						debug('Inserting the item "' + value + '", id "' + id + '".');

						// Add the new option and change the submit.
						var select_option = $('<option>').attr({value: id}).text(value);
						select.append(select_option);
						select.find('option').removeAttr('selected');
						select_option.attr('selected', 'selected');
						select.change();

						// Clean all selections and select the new one.
						options.find('li').removeClass('active');
						var li = create_dropdown_option(value, id, 'active');
						options.append(li);
						bind_clicks_to_options();
					}
					show_select_area();
					releasePopup();
				};

				// Binding add-new click to show the add-new form.
				$(this).find('.dropdown-btn-add-new').click(function () {
					debug('Binding the button add-new.');
					show_add_new();
					var input = $(t).find('.dropdown-input-add-new-name').focus();
					$(t).find('.dropdown-btn-submit').unbind('click').click(function() {
						debug('Clicked the submit.');
						// Mock adding.
						var value = input.val();
						if (value && opts.success) {
							debug('Calling the success callback.');
							opts.success({value: value}, function(id, err){ add_callback(value, id, err); });
						}
						return false;
					});

					// Binding the cancel button.
					$(t).find('.dropdown-btn-cancel').click(function() {
						debug('Binding the cancel button for add-new.');
						$(t).find('.dropdown-input-add-new-name').val('');
						show_select_area();
						return false;
					});

					return false;
				});

				bind_clicks_to_options();
			});
		}
	});
})(jQuery);