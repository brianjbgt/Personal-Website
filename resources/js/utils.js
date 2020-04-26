
var utils = function() {
    return {
        hasInputError: function(inputname, errors){
            var error = errors[inputname];
        
            return {hasError: error != undefined, message: typeof error != typeof undefined ? error.join(" "): undefined};
        }
    };
}

export default utils


