

		var form = $('form#contact-form'),
		formElements = form.find('input[type!="submit"],input[type!="hidden"],textarea'),
		name = form.find('input[name="mailname"]'),
		errorNotice = $('.error'),
		errorMessages = {
			required: ' is a required field',
			email: 'You haven\'t entered a valid e-mail address',
			minLength: ' must be greater than '
		}

		errorNotice.hide();

		form.submit(function() {

			var	formok = true,
				errors = [];

			formElements.each(function() {
				var name = this.name,
					nameUC = name.ucfirst(),
					value = this.value,
					placeholderText = this.getAttribute('placeholder'),
					type = this.getAttribute('type'),
					isRequired = this.getAttribute('required'),
					minLength = this.getAttribute('data-minlength');

					if((this.validity) && !this.validity.valid) {
						formok = false;
						if(this.validity.valueMissing) {
							errors.push(nameUC + errorMessages.required);
						} else if((this.validity.typeMismatch) && type == 'email') {
							errors.push(errorMessages.email + nameUC);
						}
						return false;
					}

					if(isRequired) {
						if(value == '') {
							formok = false;
							errors.push(nameUC + errorMessages.required);
							return false;
						}
					}

					if(type == 'email') {
						var emailReg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

						if(!emailReg.test(value)) {
							formok = false;
							errors.push(errorMessages.email);
							return false;
						}
					}

					if(minLength) {
						if(value.length < parseInt(minLength)) {
							formok = false;
							errors.push('Your ' + nameUC + errorMessages.minLength + minLength + ' characters');
							return false;
						}
					}

			});

			if(!formok) {
				showNotice('error', errors);
			} else {
				$.ajax({
					type: form.attr('method'),
					url: form.attr('action'),
					data: form.serialize(),
					success: function() {
						$(form).before('<div class="success"><h5>Thanks ' + name.val() + '! Your E-mail has been sent.</h5></div>');
						form.get(0).reset();
						errorNotice.hide();
					}
				});
			}
			return false;
		});

	function showNotice(type,data) {
		if(type == 'error') {
			errorNotice.show();
			for(x in data) {
				errorNotice.find('ul').append('<li>' +data[x]+ '</li>');
			}
			$('.success').hide();
		}
	}

	String.prototype.ucfirst = function() {
		return this.charAt(0).toUpperCase() + this.slice(1);
	}