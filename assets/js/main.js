$(function() {
	'use strict';

	
  $('.form-control').on('input', function() {
	  var $field = $(this).closest('.form-group');
	  if (this.value) {
	    $field.addClass('field--not-empty');
	  } else {
	    $field.removeClass('field--not-empty');
	  }
	});

});


        document.getElementById('cpf').addEventListener('input', function (e) {
            let input = e.target.value;
            
            // Remove caracteres não numéricos
            input = input.replace(/\D/g, '');

            // Adiciona a formatação de CPF
            if (input.length <= 11) {
                // Formata o CPF apenas se tiver 11 caracteres ou menos
                input = input.replace(/(\d{3})(\d)/, '$1.$2');
                input = input.replace(/(\d{3})(\d)/, '$1.$2');
                input = input.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            
            // Atualiza o valor do input
            e.target.value = input;
        });

