

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
   var divnamefechar = '';
   var addcontrole = '';

   switch (divname) {
      case 'divl1':
         divnamefechar = 'dvfechar1';
         addcontrole = '<div id="dvcontroles" style="position: absolute; width: 100px; height: 75px;z-index: 100; margin-top: 10px; margin-left: 230px;"><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverup(\'divl1\')"><img border="0" src="/app/img/seta_cim.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="zoommais(\'divl1\')"><img border="0" src="/app/img/seta_mai.png"></a></div><div class="controleico"><a href="#" onclick="moveresq(\'divl1\')"><img border="0" src="/app/img/seta_esq.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverdir(\'divl1\')"><img border="0" src="/app/img/seta_dir.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverbaixo(\'divl1\')"><img border="0" src="/app/img/seta_bai.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="zoommenos(\'divl1\')"><img border="0" src="/app/img/seta_men.png"></a></div></div>';
         break;

      case 'divl2a':
         divnamefechar = 'dvfechar1';
         addcontrole = '<div id="dvcontroles1" style="position: absolute; width: 100px; height: 75px;z-index: 100; margin-top: 10px; margin-left: 230px;"><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverup(\'divl2a\')"><img border="0" src="/app/img/seta_cim.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="zoommais(\'divl2a\')"><img border="0" src="/app/img/seta_mai.png"></a></div><div class="controleico"><a href="#" onclick="moveresq(\'divl2a\')"><img border="0" src="/app/img/seta_esq.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverdir(\'divl2a\')"><img border="0" src="/app/img/seta_dir.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverbaixo(\'divl2a\')"><img border="0" src="/app/img/seta_bai.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="zoommenos(\'divl2a\')"><img border="0" src="/app/img/seta_men.png"></a></div></div>';
         break;

      case 'divl2b':
         divnamefechar = 'dvfechar2';
         addcontrole = '<div id="dvcontroles2" style="position: absolute; width: 100px; height: 75px;z-index: 100; margin-top: 10px; margin-left: 230px;"><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverup(\'divl2b\')"><img border="0" src="/app/img/seta_cim.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="zoommais(\'divl2b\')"><img border="0" src="/app/img/seta_mai.png"></a></div><div class="controleico"><a href="#" onclick="moveresq(\'divl2b\')"><img border="0" src="/app/img/seta_esq.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverdir(\'divl2b\')"><img border="0" src="/app/img/seta_dir.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="moverbaixo(\'divl2b\')"><img border="0" src="/app/img/seta_bai.png"></a></div><div class="controleico">&nbsp;</div><div class="controleico"><a href="#" onclick="zoommenos(\'divl2b\')"><img border="0" src="/app/img/seta_men.png"></a></div></div>';
         break;

      case 'divl15b1':
         divnamefechar = 'dvfechar1';
         break;

      case 'divl15b2':
         divnamefechar = 'dvfechar2';
         break;

      case 'divl15a1':
         divnamefechar = 'dvfechar3';
         break;

      case 'divl15b3':
         divnamefechar = 'dvfechar4';
         break;

      case 'divl15b4':
         divnamefechar = 'dvfechar5';
         break;

      case 'divl15a2':
         divnamefechar = 'dvfechar6';
         break;

      case 'divl15b5':
         divnamefechar = 'dvfechar7';
         break;

      case 'divl15b6':
         divnamefechar = 'dvfechar8';
         break;

      case 'divl15b7':
         divnamefechar = 'dvfechar9';
         break;

      case 'divl15b8':
         divnamefechar = 'dvfechar10';
         break;

      case 'divl15b9':
         divnamefechar = 'dvfechar11';
         break;

      case 'divl15b10':
         divnamefechar = 'dvfechar12';
         break;

      case 'divl15a3':
         divnamefechar = 'dvfechar13';
         break;

      case 'divl15b11':
         divnamefechar = 'dvfechar14';
         break;

      case 'divl15b12':
         divnamefechar = 'dvfechar15';
         break;
   }


   var textv = '<div id="'+divnamefechar+'" style="position: absolute; width: 10px; height: 10px;z-index: 100; margin: 5px;"><a href="#" onclick="lixeiraremove(\''+divname+'\')"><img src="img/close_red.gif"></a></div>';
   $('#'+divname).prepend(textv);
   $('#'+divname).prepend(addcontrole);
   
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
   escondecontroles();
}


function escondemascarasup() {
   document.getElementById("mascarasuperior").style.display="none";
   mostracontroles();
}

function mostracontroles() {
   document.getElementById("dvcontroles").style.display="block";
   document.getElementById("dvcontroles1").style.display="block";
   document.getElementById("dvcontroles2").style.display="block";
   document.getElementById("dvfechar1").style.display="block";
   document.getElementById("dvfechar2").style.display="block";
   document.getElementById("dvfechar3").style.display="block";
   document.getElementById("dvfechar4").style.display="block";
   document.getElementById("dvfechar5").style.display="block";
   document.getElementById("dvfechar6").style.display="block";
   document.getElementById("dvfechar7").style.display="block";
   document.getElementById("dvfechar8").style.display="block";
   document.getElementById("dvfechar9").style.display="block";
   document.getElementById("dvfechar10").style.display="block";
   document.getElementById("dvfechar11").style.display="block";
   document.getElementById("dvfechar12").style.display="block";
   document.getElementById("dvfechar13").style.display="block";
   document.getElementById("dvfechar14").style.display="block";
   document.getElementById("dvfechar15").style.display="block";
}

function escondecontroles() {
   document.getElementById("dvcontroles").style.display="none";
   document.getElementById("dvcontroles1").style.display="none";
   document.getElementById("dvcontroles2").style.display="none";
   document.getElementById("dvfechar1").style.display="none";
   document.getElementById("dvfechar2").style.display="none";
   document.getElementById("dvfechar3").style.display="none";
   document.getElementById("dvfechar4").style.display="none";
   document.getElementById("dvfechar5").style.display="none";
   document.getElementById("dvfechar6").style.display="none";
   document.getElementById("dvfechar7").style.display="none";
   document.getElementById("dvfechar8").style.display="none";
   document.getElementById("dvfechar9").style.display="none";
   document.getElementById("dvfechar10").style.display="none";
   document.getElementById("dvfechar11").style.display="none";
   document.getElementById("dvfechar12").style.display="none";
   document.getElementById("dvfechar13").style.display="none";
   document.getElementById("dvfechar14").style.display="none";
   document.getElementById("dvfechar15").style.display="none";  
}


function zoommais(dvposicao) {
   var eldvposicao=document.getElementById(dvposicao); 

   var eldvposicaoChildren = eldvposicao.childNodes; 
   for(var i = 0; i < eldvposicaoChildren.length; i++) 
   { 
      if (eldvposicaoChildren.item(i).id != null && 
      eldvposicaoChildren.item(i).id != "" &&
      eldvposicaoChildren.item(i).id != "dvcontroles" &&
      eldvposicaoChildren.item(i).id != "dvcontroles1" &&
      eldvposicaoChildren.item(i).id != "dvcontroles2" &&
      eldvposicaoChildren.item(i).id != "dvfechar1" &&
      eldvposicaoChildren.item(i).id != "dvfechar2" &&
      eldvposicaoChildren.item(i).id != "dvfechar3" &&
      eldvposicaoChildren.item(i).id != "dvfechar4" &&
      eldvposicaoChildren.item(i).id != "dvfechar5" &&
      eldvposicaoChildren.item(i).id != "dvfechar6" &&
      eldvposicaoChildren.item(i).id != "dvfechar7" &&
      eldvposicaoChildren.item(i).id != "dvfechar8" &&
      eldvposicaoChildren.item(i).id != "dvfechar9" &&
      eldvposicaoChildren.item(i).id != "dvfechar10" &&
      eldvposicaoChildren.item(i).id != "dvfechar11" &&
      eldvposicaoChildren.item(i).id != "dvfechar12" &&
      eldvposicaoChildren.item(i).id != "dvfechar13" &&
      eldvposicaoChildren.item(i).id != "dvfechar14" &&
      eldvposicaoChildren.item(i).id != "dvfechar15" ) {

         var elimagem=document.getElementById(eldvposicaoChildren.item(i).id); 
         var imwidth=elimagem.width;
         nimwidth=imwidth*1.05;
         elimagem.width=nimwidth;

         var imheight=elimagem.height;
         nimheight=imheight*1.05;
         elimagem.height=nimheight;

      }
      
   }
}


function zoommenos(dvposicao) {
   var eldvposicao=document.getElementById(dvposicao); 

   var eldvposicaoChildren = eldvposicao.childNodes; 
   for(var i = 0; i < eldvposicaoChildren.length; i++) 
   { 
      if (eldvposicaoChildren.item(i).id != null && 
      eldvposicaoChildren.item(i).id != "" &&
      eldvposicaoChildren.item(i).id != "dvcontroles" &&
      eldvposicaoChildren.item(i).id != "dvcontroles1" &&
      eldvposicaoChildren.item(i).id != "dvcontroles2" &&
      eldvposicaoChildren.item(i).id != "dvfechar1" &&
      eldvposicaoChildren.item(i).id != "dvfechar2" &&
      eldvposicaoChildren.item(i).id != "dvfechar3" &&
      eldvposicaoChildren.item(i).id != "dvfechar4" &&
      eldvposicaoChildren.item(i).id != "dvfechar5" &&
      eldvposicaoChildren.item(i).id != "dvfechar6" &&
      eldvposicaoChildren.item(i).id != "dvfechar7" &&
      eldvposicaoChildren.item(i).id != "dvfechar8" &&
      eldvposicaoChildren.item(i).id != "dvfechar9" &&
      eldvposicaoChildren.item(i).id != "dvfechar10" &&
      eldvposicaoChildren.item(i).id != "dvfechar11" &&
      eldvposicaoChildren.item(i).id != "dvfechar12" &&
      eldvposicaoChildren.item(i).id != "dvfechar13" &&
      eldvposicaoChildren.item(i).id != "dvfechar14" &&
      eldvposicaoChildren.item(i).id != "dvfechar15" ) {

         var elimagem=document.getElementById(eldvposicaoChildren.item(i).id); 
         var imwidth=elimagem.width;
         nimwidth=imwidth*0.95;
         elimagem.width=nimwidth;

         var imheight=elimagem.height;
         nimheight=imheight*0.95;
         elimagem.height=nimheight;

      }
      
   }
}




function moverup(dvposicao) {
   var eldvposicao=document.getElementById(dvposicao); 

   var eldvposicaoChildren = eldvposicao.childNodes; 
   for(var i = 0; i < eldvposicaoChildren.length; i++) 
   { 
      if (eldvposicaoChildren.item(i).id != null && 
      eldvposicaoChildren.item(i).id != "" &&
      eldvposicaoChildren.item(i).id != "dvcontroles" &&
      eldvposicaoChildren.item(i).id != "dvcontroles1" &&
      eldvposicaoChildren.item(i).id != "dvcontroles2" &&
      eldvposicaoChildren.item(i).id != "dvfechar1" &&
      eldvposicaoChildren.item(i).id != "dvfechar2" &&
      eldvposicaoChildren.item(i).id != "dvfechar3" &&
      eldvposicaoChildren.item(i).id != "dvfechar4" &&
      eldvposicaoChildren.item(i).id != "dvfechar5" &&
      eldvposicaoChildren.item(i).id != "dvfechar6" &&
      eldvposicaoChildren.item(i).id != "dvfechar7" &&
      eldvposicaoChildren.item(i).id != "dvfechar8" &&
      eldvposicaoChildren.item(i).id != "dvfechar9" &&
      eldvposicaoChildren.item(i).id != "dvfechar10" &&
      eldvposicaoChildren.item(i).id != "dvfechar11" &&
      eldvposicaoChildren.item(i).id != "dvfechar12" &&
      eldvposicaoChildren.item(i).id != "dvfechar13" &&
      eldvposicaoChildren.item(i).id != "dvfechar14" &&
      eldvposicaoChildren.item(i).id != "dvfechar15" ) {

         var elimagem=document.getElementById(eldvposicaoChildren.item(i).id); 
         var imtop=elimagem.style.marginTop;
         if (imtop == "") { 
            imtop = 0; 
         }
         else {
            imtop = imtop.replace("px","");   
         }         
         var nimtop=parseFloat(0);
         nimtop=parseFloat(imtop)+parseFloat(-5);
         elimagem.style.marginTop=nimtop;
      }
      
   }
}


function moverbaixo(dvposicao) {
   var eldvposicao=document.getElementById(dvposicao); 

   var eldvposicaoChildren = eldvposicao.childNodes; 
   for(var i = 0; i < eldvposicaoChildren.length; i++) 
   { 
      if (eldvposicaoChildren.item(i).id != null && 
      eldvposicaoChildren.item(i).id != "" &&
      eldvposicaoChildren.item(i).id != "dvcontroles" &&
      eldvposicaoChildren.item(i).id != "dvcontroles1" &&
      eldvposicaoChildren.item(i).id != "dvcontroles2" &&
      eldvposicaoChildren.item(i).id != "dvfechar1" &&
      eldvposicaoChildren.item(i).id != "dvfechar2" &&
      eldvposicaoChildren.item(i).id != "dvfechar3" &&
      eldvposicaoChildren.item(i).id != "dvfechar4" &&
      eldvposicaoChildren.item(i).id != "dvfechar5" &&
      eldvposicaoChildren.item(i).id != "dvfechar6" &&
      eldvposicaoChildren.item(i).id != "dvfechar7" &&
      eldvposicaoChildren.item(i).id != "dvfechar8" &&
      eldvposicaoChildren.item(i).id != "dvfechar9" &&
      eldvposicaoChildren.item(i).id != "dvfechar10" &&
      eldvposicaoChildren.item(i).id != "dvfechar11" &&
      eldvposicaoChildren.item(i).id != "dvfechar12" &&
      eldvposicaoChildren.item(i).id != "dvfechar13" &&
      eldvposicaoChildren.item(i).id != "dvfechar14" &&
      eldvposicaoChildren.item(i).id != "dvfechar15" ) {

         var elimagem=document.getElementById(eldvposicaoChildren.item(i).id); 
         var imtop=elimagem.style.marginTop;
         if (imtop == "") { 
            imtop = 0; 
         }
         else {
            imtop = imtop.replace("px","");   
         }         
         var nimtop=parseFloat(0);
         nimtop=parseFloat(imtop)+parseFloat(5);
         elimagem.style.marginTop=nimtop;
      }
      
   }
}




function moveresq(dvposicao) {
   var eldvposicao=document.getElementById(dvposicao); 

   var eldvposicaoChildren = eldvposicao.childNodes; 
   for(var i = 0; i < eldvposicaoChildren.length; i++) 
   { 
      if (eldvposicaoChildren.item(i).id != null && 
      eldvposicaoChildren.item(i).id != "" &&
      eldvposicaoChildren.item(i).id != "dvcontroles" &&
      eldvposicaoChildren.item(i).id != "dvcontroles1" &&
      eldvposicaoChildren.item(i).id != "dvcontroles2" &&
      eldvposicaoChildren.item(i).id != "dvfechar1" &&
      eldvposicaoChildren.item(i).id != "dvfechar2" &&
      eldvposicaoChildren.item(i).id != "dvfechar3" &&
      eldvposicaoChildren.item(i).id != "dvfechar4" &&
      eldvposicaoChildren.item(i).id != "dvfechar5" &&
      eldvposicaoChildren.item(i).id != "dvfechar6" &&
      eldvposicaoChildren.item(i).id != "dvfechar7" &&
      eldvposicaoChildren.item(i).id != "dvfechar8" &&
      eldvposicaoChildren.item(i).id != "dvfechar9" &&
      eldvposicaoChildren.item(i).id != "dvfechar10" &&
      eldvposicaoChildren.item(i).id != "dvfechar11" &&
      eldvposicaoChildren.item(i).id != "dvfechar12" &&
      eldvposicaoChildren.item(i).id != "dvfechar13" &&
      eldvposicaoChildren.item(i).id != "dvfechar14" &&
      eldvposicaoChildren.item(i).id != "dvfechar15" ) {

         var elimagem=document.getElementById(eldvposicaoChildren.item(i).id); 
         var imleft=elimagem.style.marginLeft;
         if (imleft == "") { 
            imleft = 0; 
         }
         else {
            imleft = imleft.replace("px","");   
         }         
         var nimleft=parseFloat(0);
         nimleft=parseFloat(imleft)+parseFloat(-5);
         elimagem.style.marginLeft=nimleft;
      }
      
   }
}





function moverdir(dvposicao) {
   var eldvposicao=document.getElementById(dvposicao); 

   var eldvposicaoChildren = eldvposicao.childNodes; 
   for(var i = 0; i < eldvposicaoChildren.length; i++) 
   { 
      if (eldvposicaoChildren.item(i).id != null && 
      eldvposicaoChildren.item(i).id != "" &&
      eldvposicaoChildren.item(i).id != "dvcontroles" &&
      eldvposicaoChildren.item(i).id != "dvcontroles1" &&
      eldvposicaoChildren.item(i).id != "dvcontroles2" &&
      eldvposicaoChildren.item(i).id != "dvfechar1" &&
      eldvposicaoChildren.item(i).id != "dvfechar2" &&
      eldvposicaoChildren.item(i).id != "dvfechar3" &&
      eldvposicaoChildren.item(i).id != "dvfechar4" &&
      eldvposicaoChildren.item(i).id != "dvfechar5" &&
      eldvposicaoChildren.item(i).id != "dvfechar6" &&
      eldvposicaoChildren.item(i).id != "dvfechar7" &&
      eldvposicaoChildren.item(i).id != "dvfechar8" &&
      eldvposicaoChildren.item(i).id != "dvfechar9" &&
      eldvposicaoChildren.item(i).id != "dvfechar10" &&
      eldvposicaoChildren.item(i).id != "dvfechar11" &&
      eldvposicaoChildren.item(i).id != "dvfechar12" &&
      eldvposicaoChildren.item(i).id != "dvfechar13" &&
      eldvposicaoChildren.item(i).id != "dvfechar14" &&
      eldvposicaoChildren.item(i).id != "dvfechar15" ) {

         var elimagem=document.getElementById(eldvposicaoChildren.item(i).id); 
         var imleft=elimagem.style.marginLeft;
         if (imleft == "") { 
            imleft = 0; 
         }
         else {
            imleft = imleft.replace("px","");   
         }         
         var nimleft=parseFloat(0);
         nimleft=parseFloat(imleft)+parseFloat(5);
         elimagem.style.marginLeft=nimleft;
      }
      
   }
}







