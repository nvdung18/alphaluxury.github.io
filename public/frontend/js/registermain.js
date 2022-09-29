// Object
function Validator(options) {

    function getParent(element, selector) {
        while(element.parentElement) {
            if(element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;           
        }
    }

    var selectorRules = {};
   // Hien thi message loi
    function validate(inputElement, rule) {
        var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        var errorMessage;
        // Lay ra cac rule cua selector
        // Cu the lay ra function test in the rule
        var rules = selectorRules[rule.selector];
        // Lap qua tung rule(check)
        // Neu co loi dung viec kiem tra
        for(var i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](formElement.querySelector(rule.selector + ':checked'));
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if(errorMessage) break;
        }

        if(errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;

    }
   //    Lay elemnt cua form
    var formElement = document.querySelector(options.form);
    if(formElement) {
        // Khi submit form
        formElement.onsubmit = function(e) {
            // Loa Bo Mac Dinh
            e.preventDefault();

            var isFormValid = true;

            // Lap qua tung rule va validate 
            options.rules.forEach((rule) => {
                // rule is a object of a function
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if(!isValid) {
                    isFormValid = false;
                }
            });

            if(isFormValid) {
                if(typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelectorAll('[name]:not([disable])');
                    var formValues = Array.from(enableInputs).reduce((values, input) => {
                        switch(input.type) {
                            case 'radio':
                                values[input.name] = formElement.querySelector('input[name="' + input.name +'"]:checked').value;
                                break;
                            case 'checkbox':
                                if(!input.matches(':checked')) {
                                    values[input.name] = '';
                                    return values;
                                };
                                if(!Array.isArray(values[input.name])) {
                                    values[input.name] = [];
                                }
                                values[input.name].push(input.value); 
                                break;
                            case 'file':
                                values[input.name] = input.files;
                                break;
                            default:
                                values[input.name] = input.value;
                        }
                        return values; 
                    },{});
                    options.onSubmit(formValues);
                } else {
                    formElement.submit();
                }
            } 
        }

        options.rules.forEach((rule) => {
          if(Array.isArray(selectorRules[rule.selector])) {
            selectorRules[rule.selector].push(rule.test);
          } else {
            selectorRules[rule.selector] = [rule.test]
          }
          var inputElements = formElement.querySelectorAll(rule.selector);
           Array.from(inputElements).forEach((inputElement) => {
               // Xu ly truong hop blur khoi input
            inputElement.onblur = function() {
                       validate(inputElement, rule);
                   }
               // Xu li moi khi nguoi dung nhap vao input
    
               inputElement.oninput = function() {
                   var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);               
                   errorElement.innerText = '';
                   getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
               }
               inputElement.onchange = function() {
                var errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);               
                errorElement.innerText = '';
                getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
            }
           });
        } );
        }
}

Validator.isRequired = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            return value ? undefined : message ||  'Vui long nhap truong nay';
        }
    };
}

Validator.isEmail = function(selector, message) {
    return {
        selector: selector,
        test: function(value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message || 'Truong nay phai la email';
        }
    };
}

Validator.minLength = function(selector, min, message) {
    return {
        selector: selector,
        test: function(value) {
            return value.length >= min ? undefined :  message || 'Vui long nhap tren ' +min;
        }
    };
}

Validator.isConfirmed = function(selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function(value) {
            return value === getConfirmValue() ? undefined : message || 'Kiem tra lai lan nua';
        }
    }
}