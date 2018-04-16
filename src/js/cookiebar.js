jQuery(document).ready( function($){

function cookiebar() {
  window.addEventListener( "load", function() {
  window.cookieconsent.initialise({
    // position: "top",
    // static: true,
    content: {
      // message: "Utilizamos cookies para assegurar uma melhor experiência de navegação.",
      // dismiss: "Aceitar",
      // link: "",
      // href: "www.delmaralmeida.com"
    },
  })});

} cookiebar();

});