console.log( "Le script est lancé..." );

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

if(document.getElementById('sort-priority')) document.getElementById('sort-priority').addEventListener('change', function (event) {
     console.log(typeof parseInt(this.value));
     if(!this.value.match(/priorité/g)){
          parameter("sort", this.value);
          window.location.href = window.location.href;
     }
});
if(document.getElementById('sort-theme')) document.getElementById('sort-theme').addEventListener('change', function (event) {
     if(!this.value.match(/thème/g)){
          parameter("theme", this.value);
          window.location.href = window.location.href;
     }
});

document.getElementById('mobile-button').addEventListener('click', function (event) {
     if(document.querySelector('.ul-navbar').classList.contains('active')) document.querySelector('.ul-navbar').classList.remove('active');
     else  document.querySelector('.ul-navbar').classList.add("active");
});

if(document.querySelector('.modal_task')){
     document.querySelector('.modal_task').addEventListener("dblclick",function(event){
         this.remove();
     });
     document.querySelector('.close_modal').addEventListener("click",function(event){
         document.querySelector('.modal_task').remove();
         this.remove();
     });
 }
 if(document.querySelector('.modal_error')){
     document.querySelector('#btn_close').addEventListener("click",function(event){
         document.querySelector('.modal_error').remove();
     });
}

if(window.innerWidth >= 1024){
     document.querySelector('.ul-navbar').classList.remove('active');
}

const formCreate = document.getElementById('form-create-task');
formCreate.addEventListener('submit',function(event){
     event.preventDefault();

     let h = 0, formElements = [];
     for(let i=0;i<this.children.length;i++){
          if(this.children[i].id.match(/label|createSubmit/g) == null && this.children[i].value.length != 0){ formElements[h] = this.children[i].value;h++; }
     }
     if(formElements.length < 4){
          console.log("Erreur un champ n'est pas rempli !");
          return false;
     }
     console.table(formElements);
     const serializer = serialize(this);
     async function waitingForResponseInsert() {
          const response = await fetch("./includes/insert.php?" + serializer);
          const todoList = await response.json();
          console.table(todoList);
          if(todoList['success'].message == 'success'){
               console.log('Insert [task] effectué...');
               window.location.reload();
          }
     }

     waitingForResponseInsert();
});


const check = document.querySelectorAll('.id-checkbox');
check.forEach(element => element.addEventListener('change', function (event) {
     const id_checked = this.id.match(/\d+/)[0];
     const valid_checked = this.checked;

     async function waitingForResponseChecked() {
          const response = await fetch("./includes/update.php?status=done&id=" + id_checked + "&checked=" + valid_checked);
          const todoList = await response.json();
          // console.table(todoList);
          if(todoList['success'].message == 'success'){
               console.log('Update [done] effectué...');
               window.location.reload();
          }
     }

     waitingForResponseChecked();
}));

const description = document.querySelectorAll( '.btn-description');
description.forEach(element => element.addEventListener('click', function (event) {
     const id_description = this.id.match(/\d+/)[0];
     const text_description = document.getElementById("id-description"+id_description).value;

     async function waitingForResponse() {
          const response = await fetch("./includes/update.php?status=description&id=" + id_description + "&value=" + text_description);
          const todoList = await response.json();
          // console.table(todoList);
          if(todoList['success'].message == 'success'){
               console.log('Update [description] effectué...');
               // window.location.reload();
          }
     }

     waitingForResponse();
}));
