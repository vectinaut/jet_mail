document.addEventListener("DOMContentLoaded", () => {

  const logInBtn = document.querySelector('.log-in__btn');

  const nameInput = document.getElementById('name');
  const telInput = document.getElementById('tel');
  const emailInput = document.getElementById('email');
  const passwordInput = document.getElementById('password');

  const massInputs = [nameInput, telInput, emailInput, passwordInput];


  telInput.addEventListener('focus', function() {
    if(!this.value.trim()){
      this.value = '+';
    }
  });

  telInput.addEventListener('blur', function() {
    if(this.value.trim().length===1){
      this.value = '';
    }
  });

  telInput.addEventListener("keypress", function(){
    if (this.value.length===2 || this.value.length===6 || this.value.length===10 || this.value.length===13){
      this.value=this.value+" ";
    }
  });

  logInBtn.addEventListener('click', () => {
    const name = nameInput.value.trim();
    const tel = telInput.value.trim();
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    let massErrors = [];

    massErrors.push(errorsInName(name));
    massErrors.push(errorsInTel(tel));
    massErrors.push(errorsInEmail(email));
    massErrors.push(errorsInPassword(password));

    for (let i in massErrors){
      manageErrorElement(massErrors[i], i);
    };
  });

  for (let i in massInputs){
    massInputs[i].addEventListener('blur', function(){
      if(this.value.trim()){
        hangListenerOnInput(this.value.trim(), i);
      };
    });
    massInputs[i].addEventListener('keyup', function(){
      if(massInputs[i].parentNode.querySelector('.log-in-form__error')){
        hangListenerOnInput(this.value.trim(), i);
      };
    });
  };

  function hangListenerOnInput(value, i){
    switch (i) {
      case '0':
        manageErrorElement(errorsInName(value), i);
        break;
      case '1':
        manageErrorElement(errorsInTel(value), i);
        break;
      case '2':
        manageErrorElement(errorsInEmail(value), i);
        break;
      case '3':
        manageErrorElement(errorsInPassword(value), i);
        break;
    };
  };


  function manageErrorElement(error, i){
    let count = 0;
    logInBtn.disabled = false;
    if(error){
      if(massInputs[i].parentNode.querySelector('.log-in-form__error')){
        massInputs[i].parentNode.querySelector('.log-in-form__error').classList.remove('passive');
        massInputs[i].parentNode.querySelector('.log-in-form__error').innerHTML = error;
      } else{
        let textError = document.createElement('span');
        textError.classList.add('log-in-form__error');
        textError.innerHTML = error;
        massInputs[i].parentNode.append(textError);
      };
      massInputs[i].classList.add('log-in-form__input-wrong');
      count ++;
    } else {
      if(massInputs[i].parentNode.querySelector('.log-in-form__error')){
        massInputs[i].parentNode.querySelector('.log-in-form__error').classList.add('passive');
        massInputs[i].classList.remove('log-in-form__input-wrong');
      }
    };
    if (count){
      logInBtn.disabled = true;
    }
  };

  function errorsInName(name){
    let textErrorName = '';
    if (!name){
      textErrorName = 'Укажите имя';
    } else if(/[^a-z]/i.test(name) && /[^а-я]/i.test(name)){
      textErrorName = 'Имя может сожержать только буквы';
    }
    return(textErrorName);
  }

  function errorsInEmail(email){
    let textErrorEmail = '';
    if (!email){
      textErrorEmail = 'Укажите электронную почту';
    } else if(!validateEmail(email)){
      textErrorEmail = 'Проверьте адрес электронной почты';
    }
    return(textErrorEmail);
  }

  function errorsInTel(tel){
    let textErrorTel = '';
    if (!tel){
      textErrorTel = 'Укажите номер телефона';
    } else if(!validateTel(tel)){
      textErrorTel = 'Формат: +9 999 999 99 99';
    }
    return(textErrorTel);
  }

  function errorsInPassword(password){
    let textErrorPassword = '';
    if (!password){
      textErrorPassword = 'Укажите пароль';
    } else if(password.length < 8) {
      textErrorPassword = 'Пароль не может содержать менее 8 символов';
    } else if(!validatePassword(password)){
      textErrorPassword = 'Пароль должен содержать строчные и заглавные буквы, цифры и специальные символы';
    }
    return(textErrorPassword);
  }

  function validateEmail(email){
    return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
  };

  function validateTel(tel){
    return tel.match(
        /^[+][0-9][\s][0-9]{3}[\s][0-9]{3}[\s][0-9]{2}[\s][0-9]{2}$/
    );
  };

  function validatePassword(password){
    return password.match(
        /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/
    );
  };

});

