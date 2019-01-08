(function(){
  $('.form-prevent-multiple-submits').on('submit', function(){
    $('.button-prevent-multiple-submits').attr('disabled', 'true');
  })
})();


// <script>
// function submitForm(btn) {
//         // disable the button
//         btn.disabled = true;
//         // submit the form
//         if(btn.form.checkValidity()){
//           btn.form.submit();
//         }
//         else{
//           document.getElementById('name').validationMessage);
//         }
//     }
// </script>
