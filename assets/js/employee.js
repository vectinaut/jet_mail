document.addEventListener("DOMContentLoaded", () => {

  const searchBtn = document.querySelector('.employee-search__btn');

  const emailInput = document.getElementById('email');



  searchBtn.addEventListener('click', () => {
    const email = emailInput.value.trim();

    let errors = errorsInEmail(email); 
    manageErrorElement(errors);  
  });

  emailInput.addEventListener('blur', function(){
    if(this.value.trim()){
      hangListenerOnInput(this.value.trim());
    };
  }); 
  emailInput.addEventListener('keyup', function(){
    if(emailInput.parentNode.querySelector('.employee-search__error')){
      hangListenerOnInput(this.value.trim());
    };
  });

  function hangListenerOnInput(value){
    manageErrorElement(errorsInEmail(value));
  };


  function manageErrorElement(error){
    let count = 0;
    searchBtn.disabled = false;
    if(error){
      if(emailInput.parentNode.querySelector('.employee-search__error')){
        emailInput.parentNode.querySelector('.employee-search__error').classList.remove('passive');
        emailInput.parentNode.querySelector('.employee-search__error').innerHTML = error;
      } else{
        let textError = document.createElement('span');
        textError.classList.add('employee-search__error');
        textError.innerHTML = error;
        emailInput.parentNode.append(textError);
      };
      emailInput.classList.add('employee-search__input-wrong');
      count ++;
    } else {
      if(emailInput.parentNode.querySelector('.employee-search__error')){
        emailInput.parentNode.querySelector('.employee-search__error').classList.add('passive');
        emailInput.classList.remove('employee-search__input-wrong');
      }
    };
    if (count){
      searchBtn.disabled = true;
    }
  };


  function errorsInEmail(email){
    let textErrorEmail = '';
    if (!email){
      textErrorEmail = 'Укажите электронную почту';
    } else if(!validateEmail(email)){
      textErrorEmail = 'Проверьте адрес электронной почты';
    }
    return(textErrorEmail);
  }


  

  function validateEmail(email){
    return email.match(
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
  };

});