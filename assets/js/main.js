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
        document.addEventListener('DOMContentLoaded', function() {
          const passwordField = document.getElementById('password');
          const togglePasswordButton = document.getElementById('togglePassword');
      
          togglePasswordButton.addEventListener('click', function() {
              // Verifica o tipo do campo de senha e alterna entre 'password' e 'text'
              const isPassword = passwordField.type === 'password';
              passwordField.type = isPassword ? 'text' : 'password';
      
              // Atualiza o texto e o ícone do botão com base no tipo atual do campo
              const ariaLabel = isPassword ? 'Ocultar Senha' : 'Mostrar Senha';
              const iconSrc = isPassword ? '../assets/images/mostrars2.png' : '../assets/images/mostrars.png';
      
              togglePasswordButton.setAttribute('aria-label', ariaLabel);
              togglePasswordButton.innerHTML = `<img class="imgsenha" src="${iconSrc}" alt="${ariaLabel}">`;
          });
      });
      