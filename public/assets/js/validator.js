class Validator {
    constructor(inputs) {
        this.validate = inputs;
        this.values = {};
        this.errors = [];
        this.astc = {
            'input_invalid': 'is-invalid',
            'input_valid': 'is-valid',
            'prefixes': false
        }
    }

    getLength(theObject) {
        return Object.keys(theObject).length;
    }

    countValues() {
        return this.getLength(this.validate);
    }

    isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    appendError(input, message) {
        if (typeof this.errors[input] === "undefined") {
            this.errors[input] = [message];
            return false;
        }

        this.errors[input].push(message);
    }

    min(input, rule) {
        if (this.isNumeric(rule[1])) {
            let val = $(input).val().trim();

            if (val != "" && val.length < rule[1]) {
                this.appendError(input, 'Required to enter min ' + rule[1] + ' characters in the field.');
                return false;
            }
        }
    }
    
    num_min(input, rule) {
        if (this.isNumeric(rule[1])) {
            let val = $(input).val().trim();
            if (val != '' && Number(val) < Number(rule[1])) {
                this.appendError(input, 'Required to enter min '+rule[1]+' in the field.');
                return false;
            }
        }
    }

    max(input, rule) {
        if (this.isNumeric(rule[1])) {
            let val = $(input).val().trim();
            if (val != "" && val.length > rule[1]) {
                this.appendError(input, 'The field cannot be less than '+rule[1]);
                return false;
            }
        }
    }
    
    num_max(input, rule) {
        if (this.isNumeric(rule[1])) {
            let val = $(input).val().trim();

            if (val != '' && Number(val) > Number(rule[1])) {
                this.appendError(input, 'The field cannot be greather than '+rule[1]);
                return false;
            }
        }
    }
    
    num(input, rule) {
        let getVal = $(input).val().trim();
        if (getVal != '' && !this.isNumeric(getVal)){
            this.appendError(input, 'Required to enter a number');
            return false;
        }
    }
    
    trimByChar(string, character) {
        const arr = Array.from(string);
        const first = arr.findIndex(char => char !== character);
        const last = arr.reverse().findIndex(char => char !== character);
        return (first === -1 && last === -1) ? '' : string.substring(first, string.length - last);
    }
    
    countExploded(str){
        str = this.trimByChar(str);
        let exploded = str.split(",");
        //console.log(exploded);
        return exploded.length;
    }
    
    explodeMin(input, rule){
        let getVal = $(input).val().trim();
        if (getVal != "" && this.countExploded(getVal) < rule[1][0]){
            this.appendError(input, rule[1][1]);
            return false;
        }
    }
    
    explodeMax(input, rule){
        let getVal = $(input).val().trim();
        if (getVal != "" && this.countExploded(getVal) > rule[1][0]){
            this.appendError(input, rule[1][1]);
            return false;
        }
    }
    
    isset(someFuck){
        if (typeof someFuck !== 'undefined') {
            return true;
        }
        return false;
    }
    
    selectedNodes(input, rule){
        let getVal = $(input).val().trim();
        let count = $(rule[1]['select']).length;
        let what = this.isset(rule[1]['what']) ? rule[1]['what'] : '';    
        let required = this.isset(rule[1]['required']);
        let min = this.isset(rule[1]['min']) ? rule[1]['min'] : 1;
        let max = this.isset(rule[1]['max']) ? rule[1]['max'] : 1;
        
        let Isdepended = this.isset(rule[1]['depended']) && this.isset(rule[1]['depended']['on']);
        let dependedOnValue = Isdepended ? $(rule[1]['depended']['on']).val().trim() : 'FAKE_FILLED';

        console.log(dependedOnValue);
        
        if(required && what == "" && min === false){
            this.appendError(input, 'Required to add '+what);
            return false;
        }
        
        if(dependedOnValue != '' && this.isset(rule[1]['min']) && count < min){
            this.appendError(input, 'Required to add at least '+min+' '+what);
            return false;
        }
        
        if(dependedOnValue != '' && this.isset(rule[1]['max']) && count > max){
            this.appendError(input, 'The number of '+what+' cannot exceed '+max+' in total');
            return false;
        }
        
        if(dependedOnValue == '' && count > 0){
            this.appendError(input, 'Please enter the '+this.trimByChar(rule[1]['depended']['on'],'#')+' or remove the selected '+what);
            return false;
        }
    }
    
    depended(input, rule) {   
        let getVal = $(input).val().trim();
        let Isdepended = this.isset(rule[1]['on']);
        let dependedOnValue = Isdepended ? $(rule[1]['on']).val().trim() : '';
        let message = this.isset(rule[1]['message']) ? rule[1]['message'] : '';
        let onNodes = this.isset(rule[1]['onNodes']) ? $(rule[1]['onNodes']).length : 0;
        
        if(getVal =='' && (dependedOnValue != '' || onNodes > 0) && message != ''){
            this.appendError(input, message);
            return false;
        }
        
        if(getVal !='' && dependedOnValue == ''){
            this.appendError(input, 'Please enter the '+this.trimByChar(rule[1]['on'],'#')+' or clear this input');
            return false;
        }
        
        if(getVal !='' && dependedOnValue == ''){
            this.appendError(input, 'Please enter the '+this.trimByChar(rule[1]['on'],'#')+' or clear this input');
            return false;
        }
        
        if(this.isset(rule[1]['onNodes']) && this.isset(rule[1]['whatNodes']) && getVal !='' && $(rule[1]['onNodes']).length == 0){
            this.appendError(input, 'Required to add some '+rule[1]['whatNodes']);
            return false;
        }
        
    }
    
    year(input, rule) {
        let getVal = $(input).val().trim();
        if(rule[1] == 0 && getVal.toString() == ""){
            return true;
        }
        
        const currentYear = new Date().getFullYear();
        
        if (!this.isNumeric(getVal) || getVal.toString().length != 4 || Number(getVal) > Number(currentYear)){
            this.appendError(input, 'Please enter valid year');
            return false;    
        }
    }

    required(input, rule) {
        let val = $(input).val().trim();
        if (val.length == 0) {
            if(rule[1].length > 3){
                this.appendError(input, rule[1]);
            }
            else{
                this.appendError(input, 'Required to fill this field.');
            }
            return false;
        }
    }

    checkEmail(str) {
        str = str.trim();
        let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!str.match(pattern)) {
            return str != "" ? "Required to enter a valid email address" : "Email can't be blank";
        } else {
            return true;
        }
    }

    email(input, rule) {
        let val = $(input).val().trim();
        if (this.checkEmail(val) === true) {
            // Do not do anything!
        }
        else{
            console.log('mail', this.checkEmail(val));
            this.appendError(input, this.checkEmail(val));
        }
    }

    confirm_password(input, rule) {
        let invalidation_repeatedPassword = $(input).val().trim();
        let invalidation_password = $(rule[1]).val().trim();

        if (invalidation_repeatedPassword != invalidation_password) {
            this.appendError(input, 'Repeated password must be exact same as the password');
            console.log('tu arasworia raghas dayudebulxar?');
            return false;
        }
    }

    failed() {
        if (this.countValues() == 0) return true;
        const validateArray = Object.entries(this.validate);

        for (let row of validateArray) {
            if (this.getLength(row[1]) == 0) continue;

            // Rules onject to array
            const rules = Object.entries(row[1]);

            // loop rules
            for (let rule of rules) {
                let callMethod = rule[0];
                this[callMethod](row[0], rule);
            }
        }

        return this.getLength(this.errors) > 0 ? true : false;
    }

    passed(){
        return this.failed() == true ? false : true;
    }
    
    getErrors(errorsOf = null) {
        return errorsOf === null ? this.errors : this.errors[errorsOf.trim()];
    }

    first(errorsOf = null) {
        if((typeof this.errors[errorsOf] !== 'undefined') && (typeof this.errors[errorsOf.trim()][0] !== 'undefined')){
            return this.errors[errorsOf.trim()][0];
        }
        return null;
    }
    
    clearError(){
        const errorsArray = Object.entries(this.validate);
        for (let row of errorsArray) {
            let input = $(row[0]);
            input.addClass(this.astc.input_valid).removeClass(this.astc.input_invalid);
            $(row[0] + '_error').html('<!--no error-->');
        }
    }

    autoset(object) {
        this.astc.input_invalid = object.input_invalid ?? this.astc.input_invalid;
        this.astc.input_valid = object.input_valid ?? this.astc.input_valid;
        this.astc.prefixes = object.prefixes == true ? true : false;
        const errorsArray = Object.entries(this.validate);

        if (this.failed()) {
            for (let row of errorsArray) {
                let input = $(row[0]);
                if (this.first(row[0])) {
                    input.removeClass(this.astc.input_valid).addClass(this.astc.input_invalid);
                    $(row[0] + '_error').text(this.first(row[0]));
                } else {
                    input.addClass(this.astc.input_valid).removeClass(this.astc.input_invalid);
                    $(row[0] + '_error').html('<!--no error-->');
                }
            }
        }
        
        if (this.passed()) {
            this.clearError();
        }
    }
    
    autosetDefault(){
        this.autoset({'input_invalid': 'invalidInput', 'input_valid': 'validInput', 'prefixes': true});
        return this;
    }
    
    errorsBack(errors, gamonaklisebi = []){
        this.clearError();
        if(this.getLength(errors) > 0){
            for (let index = 0; index < this.getLength(errors); index++){
                if(errors[index]?.message === null){
                    // gamonaklisebi
                    if(!gamonaklisebi.includes(errors[index]?.input)) {
                        $('#'+errors[index]?.input).addClass(this.astc.input_valid).removeClass(this.astc.input_invalid);    
                    }
                    
                    $('#'+errors[index]?.input+'_error').html('<!--no error-->');
                }
                else{
                    if(!gamonaklisebi.includes(errors[index]?.input)) {
                        $('#'+errors[index]?.input).addClass(this.astc.input_invalid).removeClass(this.astc.input_valid);
                    }
                    $('#'+errors[index]?.input+'_error').html(errors[index]?.message);
                }   
            }
        }
    }
}

