// messageInfo( "Le script est lancé..." );

document.querySelector('.message').addEventListener('click', function(event){
     if(document.querySelector('.message').classList.contains('active')){
          document.querySelector('.message').classList.add('noactive');
          document.querySelector('.message').classList.remove('active');
     }
     else{
          document.querySelector('.message').classList.add('active');
          document.querySelector('.message').classList.remove('noactive');
     }
});

if(parameter('dir') == 2){
     let selectColor;
     let colors = document.querySelector('.choice-color');
     let defaultColor = "#f6b73c";
     colors.value = defaultColor;
     colors.addEventListener("change", function(event){
          document.getElementById('selectColor').value =  event.target.value;
     });
}

if(document.querySelector('.xdebug-var-dump')) document.querySelector('.xdebug-var-dump').addEventListener('click', function(event){
     this.style.display = "none";
});

document.querySelector('.ul-navbar').addEventListener('click', function (event) {
     this.classList.remove('active');
});

if(document.getElementById('sort-priority')) document.getElementById('sort-priority').addEventListener('change', function (event) {
     messageInfo(typeof parseInt(this.value));
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


/*** Action to create a task ***/
// if(document.getElementById('form-create-task')){
//      const formCreate = document.getElementById('form-create-task');
//      formCreate.addEventListener('submit',function(event){
//           event.preventDefault();

//           let h = 0, formElements = [];
//           for(let i=0;i<this.children.length;i++){
//                if(this.children[i].id.match(/label|createSubmit/g) == null && this.children[i].value.length != 0){
//                     console.log(i + "->");
//                     if(i === 3){
//                          formElements[h] = getSelectValues(this.children[i]).join(" ");
//                     }
//                     else{
//                          formElements[h] = this.children[i].value;
//                          h++;
//                     }
//                }
//           }
//           if(formElements.length < 5){
//                messageInfo("Erreur un champ n'est pas rempli ! [" + formElements.length + "]");
//                return false;
//           }
//           console.table(formElements);
//           const serializer = serialize(this);
//           messageInfo(serializer);
//           async function waitingForResponseInsert() {
//                const response = await fetch("./includes/insert.php?" + serializer);
//                const todoList = await response.json();
//                console.table(todoList);
//                if(todoList['success'].message == 'success'){
//                     window.location.reload();
//                }
//                else messageInfo(todoList);
//           }

//           waitingForResponseInsert();
//      });
// }

/*** Action to update cell "done" ***/
const check = document.querySelectorAll('.id-checkbox');
check.forEach(element => element.addEventListener('change', function (event) {
     const id_checked = this.id.match(/\d+/)[0];
     const valid_checked = this.checked;

     async function waitingForResponseChecked() {
          const response = await fetch("./includes/update.php?status=done&id=" + id_checked + "&checked=" + valid_checked);
          const update = await response.json();
          if(update['success'].message == 'success'){
               window.location.reload();
          }
          else messageInfo('Update n\'a pas été effectué...');
     }

     waitingForResponseChecked();
}));

/*** Action to update cell "description" ***/
const description = document.querySelectorAll('.btn-description');
description.forEach(element => element.addEventListener('click', function (event) {
     const id_description = this.id.match(/\d+/)[0];
     const text_description = document.getElementById("id-description"+id_description).value;
     const serial = serializer(this.parent);
     messageInfo(element);

     async function waitingForResponseUpdate() {
          const response = await fetch("./includes/update.php?status=description&id=" + id_description + "&value=" + text_description);
          const update = await response.json();
          if(update['success'].message == 'success'){
               messageInfo('Update [description] effectué...');
               window.location.reload();
          }
          else messageInfo('Update n\'a pas été effectué...');
     }

     waitingForResponseUpdate();
}));
const button = document.querySelectorAll(".btn-description");
const form = document.querySelectorAll(".formAccueil");
button.forEach(elem => elem.addEventListener('click', function (event) {
     event.preventDefault();
     messageInfo(this);
     const serial = serialize(this);
     const ID = this.id.match(/\d+/)[0];
     messageInfo(serial);
     messageInfo( "&id="+ ID + "&" + serial + "&themes=");

     async function waitingForResponseUpdate() {
          const response = await fetch("./includes/update.php?status=description&id=" + ID + "&" + serial);
          const update = await response.json();
          if(update['success'].message == 'success'){
               messageInfo('Update [description] effectué...');
               window.location.href = window.location.href;
          }
          else messageInfo('Update n\'a pas été effectué...');
     }
}));