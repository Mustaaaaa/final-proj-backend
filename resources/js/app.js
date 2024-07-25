import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])



// Logica per i Form di eliminazione 

document.querySelectorAll('.item-delete-form').forEach(form => {
    form.addEventListener('submit', (ev)=>{
        ev.preventDefault();
        const modalDOMElement = form.querySelector('.my-modal');
        const modalDOMElementYes = form.querySelector('.my-modal-yes');
        const modalDOMElementNo = form.querySelector('.my-modal-no');

        modalDOMElement.classList.add('visible');

        modalDOMElementNo.addEventListener('click', function(){
            modalDOMElement.classList.remove('visible');
        })

        modalDOMElementYes.addEventListener('click', function(){
            form.submit();
        })



    })
})
//logica per validazione form piatto-create/edit

document.querySelectorAll('.my-dish-form').forEach(form=> {
    form.addEventListener('submit', (ev) => {
        ev.preventDefault();
        const inputsDishDomEl = form.querySelectorAll('input[type="text"], input[type="number"], select, textarea[data-required="true"]');
        let hasError = false;

        //reset bordi e messaggi d'errore
        inputsDishDomEl.forEach(input => input.classList.remove('border', 'border-danger'));

        inputsDishDomEl.forEach(input => {
            if (input.value.trim() === '') {
                input.classList.add('border', 'border-danger');
                hasError = true;
            }
            
        });
        
        if (hasError) {
            document.getElementById('error-text-dish').textContent = 'riempi i campi richiesti';
        } else {
            document.getElementById('error-text-dish').textContent = '';
            form.submit();
        }

    });
});




//logica per validazione client-side della company-create/edit
document.querySelectorAll('.my-company-form').forEach(form => {
    form.addEventListener('submit', (ev) => {
        ev.preventDefault();

        const inputsDomElement = form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]');
        const checkboxesDOMElement = form.querySelectorAll('input[type="checkbox"]');
        const companyEmailError = document.getElementById('error-mail');
        
        let error = false;

        // Resetto bordi e messagi d'errore
        inputsDomElement.forEach(input => input.classList.remove('border', 'border-danger'));
        checkboxesDOMElement.forEach(checkbox => checkbox.classList.remove('border', 'border-danger'));
        companyEmailError.textContent = '';

        // controllo se almeno una checkbox è selezionata
        let checked = false;
        checkboxesDOMElement.forEach(checkbox => {
            if (checkbox.checked) {
                checked = true;
            }
        });

        if (!checked) {
            checkboxesDOMElement.forEach(checkbox => {
                checkbox.classList.add('border', 'border-danger');
            });
            error = true;
        }

        // controllo se la value degli input sono vuoti

        inputsDomElement.forEach(input => {
            if (input.value.trim() === '') {
                input.classList.add('border', 'border-danger');
                error = true;
            }

        });
        
        const inputEmail = document.getElementById('email');
        const companyEmailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!companyEmailPattern.test(inputEmail.value)) {
    
            inputEmail.classList.add('border', 'border-danger');
            companyEmailError.textContent = 'Inserisci un indirizzo email valido.';
            error = true;
        }

        if (error) {
            document.getElementById('error-text').textContent = 'riempi i campi richiesti';
        } else {
            document.getElementById('error-text').textContent = '';
            form.submit();
        }
    });
});






// Logica per la validazione clientside dell Registrazione

const loginFormDOMElement = document.querySelector('#loginForm');


if(loginFormDOMElement){
    loginFormDOMElement.addEventListener('submit', (ev) => {
        ev.preventDefault();
    
        let status = true;
    
        const userPasswordDOMElement = document.querySelector('#password');
        const userPasswordDOMElementValue = userPasswordDOMElement.value.trim();
    
        const userConfirmPasswordDomeElement = document.querySelector('#password-confirm');
        const userConfirmPasswordDomeElementValue = userConfirmPasswordDomeElement.value.trim();
    
        const userPasswordDOMElementRow = document.querySelector('#passwordRow');
        const userPasswordConfirmDOMElementRow = document.querySelector('#confirmPasswordRow');
    
        const userEmailDOMElement = document.querySelector('#email');
        const userEmailDOMElementValue = userEmailDOMElement.value.trim();
    
        const userEmailDOMElementRow = document.querySelector('#emailRow');
    
    
    
        let errorPasswordLength = userPasswordDOMElementRow.querySelector('strong.error-password-length');
        let errorPasswordNotMatch = userPasswordConfirmDOMElementRow.querySelector('strong.error-password-not-match');
        let errorEmailInvalid = userEmailDOMElementRow.querySelector('strong.error-email-invalid');
    
        if (!errorPasswordLength) {
            errorPasswordLength = document.createElement('strong');
            errorPasswordLength.classList.add('text-danger', 'error-password-length');
            userPasswordDOMElementRow.append(errorPasswordLength);
        }
        errorPasswordLength.innerHTML = '';
    
        if (!errorPasswordNotMatch) {
            errorPasswordNotMatch = document.createElement('strong');
            errorPasswordNotMatch.classList.add('text-danger', 'error-password-not-match');
            userPasswordConfirmDOMElementRow.append(errorPasswordNotMatch);
        }
        errorPasswordNotMatch.innerHTML = '';
    
        if (!errorEmailInvalid) {
            errorEmailInvalid = document.createElement('strong');
            errorEmailInvalid.classList.add('text-danger', 'error-email-invalid');
            userEmailDOMElementRow.append(errorEmailInvalid);
        }
        errorEmailInvalid.innerHTML = '';
    
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(userEmailDOMElementValue)) {
    
            userEmailDOMElement.classList.add('border', 'border-danger');
            errorEmailInvalid.innerHTML = 'Inserisci un indirizzo email valido.';
            status = false;
        }else{
            userEmailDOMElement.classList.remove('border', 'border-danger')
        }
    
        if (userPasswordDOMElementValue !== userConfirmPasswordDomeElementValue) {
    
            userPasswordDOMElement.classList.add('border', 'border-danger');
            userConfirmPasswordDomeElement.classList.add('border', 'border-danger');
    
            errorPasswordNotMatch.innerHTML = 'Le due password non corrispondono.';
            status = false;
        }else{
            userPasswordDOMElement.classList.remove('border', 'border-danger')
            userConfirmPasswordDomeElement.classList.remove('border', 'border-danger')
        }
    
        if (userPasswordDOMElementValue.length < 8) {
            userPasswordDOMElement.classList.add('border', 'border-danger');
    
            errorPasswordLength.innerHTML = 'La Password deve contenere almeno 8 caratteri';
            status = false;
        }else{
            userPasswordDOMElement.classList.remove('border', 'border-danger')
        }
    
        if (status === true) {
            loginFormDOMElement.submit();
        }
    });
}