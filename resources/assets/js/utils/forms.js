function showValidationErrors(fields, errors) {
    return Object.keys(fields)
                 .reduce((acc, field) => {
                     if(errors.hasOwnProperty(field)) {
                         acc[field] = errors[field][0];
                         return acc;
                     }
                     acc[field] = '';
                     return acc;
                 }, {});
}

function clearFormErrors(fields) {
    return Object.keys(fields)
                 .reduce((acc, field) => {
                     acc[field] = "";
                     return acc;
                 }, {})
}

export {showValidationErrors, clearFormErrors};