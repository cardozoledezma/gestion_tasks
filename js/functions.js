/**
 *
 * @param {*} form
 * @returns
 */

 function parameter($name,$value) {
    // Ex: $(this).parameter([nom],[valeur]);
    var $loc = window.location.href, $hist= window.history, $parameters = $loc.match(/[\\?&].([^&#]*)=([^&#]*)/g), $data = {}, $url = '?';
    for (var $key in $parameters) {
         var couple = $parameters[$key].substring(1, $parameters[$key].length).split('=');  // A chaque fois qu'on trouve l'occurrence "="
         $data[couple[0]] = couple[1];                                                      // Tableau
    }
    if ($value == null)  return $data[$name] ? $data[$name] : null;
    if ($value != false) $data[$name] = $value;

    for (var $key in $data) {
         if ($value == false && $key == $name) continue;                                    // On passe si la valeur est fausse ou si la clé est égale au nom
         $url = $url.concat($key.concat('=' + $data[$key]+'&'));                            // Concaténation de la nouvelle adresse
    }
    $hist.pushState('', document.title, $url.substring(0, $url.length-1));                 // On modifie l'historique de navigation
}

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