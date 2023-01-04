document.addEventListener("DOMContentLoaded", () => {

  const logInBtn = document.querySelector('.log-in__btn');

  const numberInput = document.getElementById('number');
  const yearInput = document.getElementById('year');
  const cvcInput = document.getElementById('cvc');
  
  const massInputs = [numberInput, yearInput, cvcInput];

  numberInput.addEventListener("keypress", function(){
    if (this.value.length===4 || this.value.length===9 || this.value.length===14){
      this.value=this.value+" ";
    } 
  });


  logInBtn.addEventListener('click', () => {
    const number = numberInput.value.trim();
    const year = yearInput.value.trim();
    const cvc = cvcInput.value.trim();

    let massErrors = [];

    massErrors.push(errorsInNumber(number));
    massErrors.push(errorsInYear(year));
    massErrors.push(errorsInCvc(cvc));

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
        manageErrorElement(errorsInNumber(value), i);
        break;
      case '1':
        manageErrorElement(errorsInYear(value), i);
        break;
      case '2':
        manageErrorElement(errorsInCvc(value), i);
        break;
    };
  };


  function manageErrorElement(error, i){
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
    } else {
      if(massInputs[i].parentNode.querySelector('.log-in-form__error')){
        massInputs[i].parentNode.querySelector('.log-in-form__error').classList.add('passive');
        massInputs[i].classList.remove('log-in-form__input-wrong');
      }
    };
  };

  function errorsInNumber(number){
    let textErrorNumber = '';
    if (!number){
      textErrorNumber = 'Укажите номер карты';
    } else if(!validateNumber(number)){
      textErrorNumber = 'Формат: 9999 9999 9999 9999';
    }
    return(textErrorNumber);
  }

  function errorsInYear(year){
    let textErrorYear = '';
    if (!year){
      textErrorYear = 'Укажите срок действия карты';
    } else if(parseInt(year) < 2022){
      textErrorYear = 'Год должен быть больше 2022';
    } else if(!validateYear(year)){
      textErrorYear = 'Формат: 9999';
    }
    return(textErrorYear);
  }

  function errorsInCvc(cvc){
    let textErrorCvc = '';
    if (!cvc){
      textErrorCvc = 'Укажите cvc';
    } else if(!validateCvc(cvc)){
      textErrorCvc = 'Формат: 999';
    }
    return(textErrorCvc);
  }

  function validateYear(year){
    return year.match(
      /^[0-9]{4}$/
    );
  };

  function validateNumber(number){
    return number.match(
      /^[0-9]{4}[\s][0-9]{4}[\s][0-9]{4}[\s][0-9]{4}$/
    );
  };

  function validateCvc(cvc){
    return cvc.match(
      /^[0-9]{3}$/
    );
  };

});

