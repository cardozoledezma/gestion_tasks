console.log( "Le script est lancé..." );

document.getElementById('sort-priority').addEventListener('change', function (event) {
     window.location.href = 'index.php?page=1&sort=' + this.value;
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
