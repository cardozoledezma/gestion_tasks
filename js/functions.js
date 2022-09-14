/**
 * 
 * @param {*} form 
 * @returns 
 */
function serialize(form) {
    let field, s = [], concat = "";
    if (typeof form == 'object' && form.nodeName == "FORM") {
        let len = form.elements.length;
        for (i=0; i<len; i++) {
            field = form.elements[i];
            if (field.name && !field.disabled && field.type != 'file' && field.type != 'reset' && field.type != 'submit' && field.type != 'button') {
                if (field.type == 'select-multiple') {
                    for (j=form.elements[i].options.length-1; j>=0; j--) {
                        if(field.options[j].selected){
                            concat += "~"+field.options[j].value;
                            s[s.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(concat);
                        }
                    }
                }
                else if ((field.type != 'checkbox' && field.type != 'radio') || field.checked) {
                    s[s.length] = encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value);
                }
            }
        }
    }
    return s.join('&').replace(/%20/g, '+');
}
/**
 * Return all values of a multiple select
 * @param {*} select
 * @returns array of values
 */
function getSelectValues(select) {
    let result = [];
    let options = select && select.options;
    let opt;

    for (let i=0, iLen=options.length; i<iLen; i++) {
      opt = options[i];

      if (opt.selected) {
        result.push(opt.value || opt.text);
      }
    }
    return result;
  }