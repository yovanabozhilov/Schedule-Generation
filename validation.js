function validateRegisterFormOnSubmit(theForm) {
    var reason = "";

    reason += comparePasswords(theForm.password , theForm.password_repeat);
    reason += validateName(theForm.first_name);
    reason += validateName(theForm.last_name);
    reason += validateEmail(theForm.email);

    if (reason != "") {
        alert("Възникна проблем:\n" + reason);
        return false;
    }
    return true;
}



function validateLoginFormOnSubmit(theForm) {
    var reason = "";

    reason += validateEmail(theForm.email);
    reason += validatePassword(theForm.password);

    if (reason != "") {
        alert("Възникна проблем:\n" + reason);
        return false;
    }
    return true;
}



function validateName(fld) {
    var error = "";
    var illegalChars = /\W/;
	
    if (fld.value == "") {
        fld.style.background = '#ffb6c1';
        error = "Не е въведено име.\n";
    } else if ((fld.value.length < 2) || (fld.value.length > 45)) {
        fld.style.background = '#ffb6c1';
        error = "Невалидна дължина на името.\n";
    } else if (illegalChars.test(fld.value)) {
        fld.style.background = '#ffb6c1';
        error = "Името съдържа непозволени символи.\n";
    } else {
        fld.style.background = 'White';
    }
    return error;
}



function validatePassword(fld) {
    fld.style.background = 'White'; 

    var error = "";
	
    if (fld.value == "") {
        fld.style.background = '#ffb6c1'; 
        error = "Не е въведена парола.\n"; 
    } else if (fld.value.length < 8) {
        error = "Дължината на паролата трябва да бъде поне 8 символа.\n";
        fld.style.background = '#ffb6c1'; 
    } else if (fld.value.length > 20) {
        error = "Паролата не може да бъде повече от 20 символа.\n"; 
        fld.style.background = '#ffb6c1'; 
    } else if (!/[A-Z]/.test(fld.value)) {
        error = "Паролата трябва да съдържа поне една голяма буква.\n"; 
        fld.style.background = '#ffb6c1'; 
    } else if (!/\d/.test(fld.value)) {
        error = "Паролата трябва да съдържа поне една цифра.\n"; 
        fld.style.background = '#ffb6c1'; 
    } else {
        fld.style.background = 'White'; 
    }

    return error; 
}



function comparePasswords(password , repeatedPassword){
    var error = "";

    error += validatePassword(password);
    error += validatePassword(repeatedPassword);

    if(error != ""){
        password.style.background  = '#ffb6c1';
        repeatedPassword.style.background  = '#ffb6c1';
    }else if (password.value != repeatedPassword.value) {
        error = "Паролите не съвпадат!\n";
        password.style.background  = '#ffb6c1';
        repeatedPassword.style.background  = '#ffb6c1';
    } else {
        password.style.background = 'White';
        repeatedPassword.style.background = 'White';
    }
    return error;

}

function trim(s) {
    return s.replace(/^\s+|\s+$/, '');
}

function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                       
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;

    if (fld.value == "") {
        fld.style.background  = '#ffb6c1';
        error = "Не е въведен валиден имейл адрес.\n";
    } else if (!emailFilter.test(tfld)) {            
        fld.style.background  = '#ffb6c1';
        error = "Моля въведи валиден имейл адрес.\n";
    }else if ((fld.value.length < 5) || (fld.value.length > 45)) {
        error = "Невалидна дължина на имейл адреса. \n";
        fld.style.background = '#ffb6c1';
    } else if (fld.value.match(illegalChars)) {
        fld.style.background  = '#ffb6c1';
        error = "Имейл адресът съдържа непозволени символи.\n";
    } else {
        fld.style.background = 'White';
    }
    return error;
}