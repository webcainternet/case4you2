

function MontaCapa(modelo, layout) {
   $(document).ready(function(){
   var response = '';
   $.ajax({ type: "GET",
            url: "http://case4you.com.br/app/capinha/?m="+modelo+"&l="+layout,
            async: false,
            success : function(text)
            {
                response = text;
            }
   });

   var myNode = document.getElementById("divcapinha");
   while (myNode.firstChild) {
       myNode.removeChild(myNode.firstChild);
   }

   $('#divcapinha').prepend(response);
   });

   if (modelo == '0') { document.getElementById("mascarasuperior").style.backgroundImage = "url('/app/img/mask-iphone4-top.png')"; }
   if (modelo == '1') { document.getElementById("mascarasuperior").style.backgroundImage = "url('/app/img/mask-iphone5-top.png')"; }
   if (modelo == '2') { document.getElementById("mascarasuperior").style.backgroundImage = "url('/app/img/mask-galaxy3-top.png')"; }
   if (modelo == '3') { document.getElementById("mascarasuperior").style.backgroundImage = "url('/app/img/mask-galaxy4-top.png')"; }

}

function lixeiraremove(divname) {
   var myNode = document.getElementById(divname);

   while (myNode.firstChild) {
         myNode.removeChild(myNode.firstChild);  
   }
   var textv = '<div style="position: absolute; margin: 5px; width: 10px; height: 10px;z-index: 10;"><a href="#" onclick="lixeiraremove(\''+divname+'\')"><img src="img/close_red.gif"></a></div>';
   $('#'+divname).prepend(textv);
}

function finalizar() {
   if (document.getElementById("modelodocelular").value == "") {
      alert('Selecione o modelo de seu celular!');
      goto1();
   }
   else {
      if (document.getElementById("layoutdacapinha").value == "") {
         alert('Selecione o layout de sua capinha!');
         goto2();
      }
      else {
         //alert('Selecione o filtro de suas fotos!');
         selecionarfiltro(0);
         document.getElementById("ircheckout2").style.display = "none";
         document.getElementById("ircheckout1").style.display = "block";
         goto4();
      }
   } 
}

function comprar() {
   window.parent.parent.window.location = '/app/save.product.php?idcsession='+document.getElementById("idsession").value+'&m='+document.getElementById("modelodocelular").value+'&l='+document.getElementById("layoutdacapinha").value+'&f='+document.getElementById("filtrocapinha").value;
}

function selecionarmodelo(modelo) {
   var smodelo = document.getElementById("modelodocelular").value=modelo.value;

   //Para onde vai
   if (document.getElementById("layoutdacapinha").value == "") {
      goto2();
   }
   else {
      goto3();
      var slayout = document.getElementById("layoutdacapinha").value;
      MontaCapa(smodelo,slayout);
   }

   VoltarEdicao();
}


function selecionalayout(layout) {
   var slayout = document.getElementById("layoutdacapinha").value=layout.value;
   if (document.getElementById("modelodocelular").value == "") {
      goto1();   
   }
   else {
      goto3();
      var smodelo = document.getElementById("modelodocelular").value;
      MontaCapa(smodelo,slayout);
   }

   VoltarEdicao();
}

function mostramascarasup() {
   document.getElementById("mascarasuperior").style.display="block";
}


function escondemascarasup() {
   document.getElementById("mascarasuperior").style.display="none";
}