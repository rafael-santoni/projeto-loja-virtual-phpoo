function alertDefault(t,n,o){swal({title:n,text:o,type:t,confirmButtonColor:"#DD6B55",closeOnConfirm:!1})}function alertNotLoggedIn(t,n){swal({title:t,text:n,type:"warning",showCancelButton:!0,confirmButtonColor:"#DD6B55",confirmButtonText:"Sim, ir para página de Login",closeOnConfirm:!1},function(){window.location.href="/login"})}function alertHtml(t,n,o){swal({title:t,text:n,html:!0,customClass:o})}