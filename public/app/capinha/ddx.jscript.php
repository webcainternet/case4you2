<script>
function allowDrop(ev)
{
	ev.preventDefault();
}

function drag(ev)
{
	ev.dataTransfer.setData("Text",ev.target.id);
    escondemascarasup();
}

function saveposition3(posicao, imagemurl)
{
    document.getElementById("invfr"+posicao).src="https://case4you.com.br/app/save.posicao.php?idcsession=<?php echo $idcsession; ?>&modelo=<?php echo $gmodelo; ?>&layout=<?php echo $glayout; ?>&posicao="+posicao+"&imagem="+imagemurl;
}

function saveposition2(posicao, imagemurl, nheight, nwidth, nleft, ntop)
{
    document.getElementById("invfr"+posicao).src="https://case4you.com.br/app/save.posicao2.php?idcsession=<?php echo $idcsession; ?>&modelo=<?php echo $gmodelo; ?>&layout=<?php echo $glayout; ?>&posicao="+posicao+"&imagem="+imagemurl+"&nheight="+nheight+"&nwidth="+nwidth+"&nleft="+nleft+"&ntop="+ntop;
}

function saveposition(idsession, posicao, imagemurl, nheight, nwidth, nleft, ntop)
{
    document.getElementById("invfr"+posicao).src="https://case4you.com.br/app/save.posicao2.php?idcsession="+idsession+"&modelo=<?php echo $gmodelo; ?>&layout=<?php echo $glayout; ?>&posicao="+posicao+"&imagem="+imagemurl+"&nheight="+nheight+"&nwidth="+nwidth+"&nleft="+nleft+"&ntop="+ntop;
}

function drop(ev, posicao)
{
    ev.preventDefault();
    var data=ev.dataTransfer.getData("Text");

    var eldvsubChildren = data.childNodes;
    for(var i = 0; i < eldvsubChildren.length; i++) 
    { 
        if (eldvsubChildren.item(i).id != null && 
            eldvsubChildren.item(i).id != "" &&
            eldvsubChildren.item(i).id != "dvcontroles" &&
            eldvsubChildren.item(i).id != "dvcontroles1" &&
            eldvsubChildren.item(i).id != "dvcontroles2" &&
            eldvsubChildren.item(i).id != "dvfechar1" &&
            eldvsubChildren.item(i).id != "dvfechar2" &&
            eldvsubChildren.item(i).id != "dvfechar3" &&
            eldvsubChildren.item(i).id != "dvfechar4" &&
            eldvsubChildren.item(i).id != "dvfechar5" &&
            eldvsubChildren.item(i).id != "dvfechar6" &&
            eldvsubChildren.item(i).id != "dvfechar7" &&
            eldvsubChildren.item(i).id != "dvfechar8" &&
            eldvsubChildren.item(i).id != "dvfechar9" &&
            eldvsubChildren.item(i).id != "dvfechar10" &&
            eldvsubChildren.item(i).id != "dvfechar11" &&
            eldvsubChildren.item(i).id != "dvfechar12" &&
            eldvsubChildren.item(i).id != "dvfechar13" &&
            eldvsubChildren.item(i).id != "dvfechar14" &&
            eldvsubChildren.item(i).id != "dvfechar15" ) {

            alert(eldvsubChildren.item(i).id);
            //$('#'+eldvsubChildren.item(i).id).remove();
            //$('#preview').prepend(imgvoltar);
        }
    }



    
	//ev.target.appendChild(document.getElementById(data));
	//document.getElementById(data).style.opacity='0.75';
	//document.getElementById(data).style.filter='alpha(opacity=75)';

	iwidth=document.getElementById(data).width;
	iheight=document.getElementById(data).height;

	// --- Variaveis ---
    pheight=<?php echo $mh; ?>;
    pwidth=<?php echo $mw; ?>;
	//pheight=527;
	//pwidth=340;
	// -----------------

	idiff=iheight/iwidth;
	iprop=pheight/pwidth;
	if (idiff<iprop) {
		document.getElementById(data).height=pheight;
		nheight = pheight;
		nwidth=pheight/iheight*iwidth;
		document.getElementById(data).width=nwidth;

		ntop=0;
		nleft=(pwidth-nwidth)/2;
		document.getElementById(data).style.marginLeft=nleft+'px';
	} else {
	        document.getElementById(data).width=pwidth;
		nwidth=pwidth;
		nheight=pwidth/iwidth*iheight;
		document.getElementById(data).height=nheight;

		nleft=0;
		ntop=(pheight-nheight)/2;
		document.getElementById(data).style.marginTop=ntop+'px';
	}
	document.getElementById(data).style.maxHeight='5000%';
	document.getElementById(data).style.maxWidth='5000%';

	document.getElementById("div"+data).style.display='none';
	ev.target.appendChild(document.getElementById(data));

    imagemurl = document.getElementById(data).src;
    //saveposition(posicao, imagemurl);
    idtsession = document.getElementById("idsession").value;
	saveposition(idtsession, posicao, imagemurl, nheight, nwidth, nleft, ntop);

    $('#div'+data).remove();
}

function dropl2(ev, posicao)
{
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        //ev.target.appendChild(document.getElementById(data));
        //document.getElementById(data).style.opacity='0.75';
        //document.getElementById(data).style.filter='alpha(opacity=75)';

        iwidth=document.getElementById(data).width;
        iheight=document.getElementById(data).height;

        // --- Variaveis ---
        pheight=<?php echo $mh2; ?>;
        pwidth=<?php echo $mw2; ?>;
        // -----------------

        idiff=iheight/iwidth;
        iprop=pheight/pwidth;
        if (idiff<iprop) {
                document.getElementById(data).height=pheight;
		nheight = pheight;
                nwidth=pheight/iheight*iwidth;
                document.getElementById(data).width=nwidth;

		ntop = 0;
                nleft=(pwidth-nwidth)/2;
                document.getElementById(data).style.marginLeft=nleft+'px';
        } else {
                document.getElementById(data).width=pwidth;
		nwidth = pwidth;
                nheight=pwidth/iwidth*iheight;
                document.getElementById(data).height=nheight;

		nleft = 0;
                ntop=(pheight-nheight)/2;
                document.getElementById(data).style.marginTop=ntop+'px';
        }
        document.getElementById(data).style.maxHeight='5000%';
        document.getElementById(data).style.maxWidth='5000%';

        document.getElementById("div"+data).style.display='none';
        ev.target.appendChild(document.getElementById(data));

        imagemurl = document.getElementById(data).src;
    //saveposition(posicao, imagemurl);
        idtsession = document.getElementById("idsession").value;
        saveposition(idtsession, posicao, imagemurl, nheight, nwidth, nleft, ntop);
}

function dropl15a(ev, posicao)
{
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        //ev.target.appendChild(document.getElementById(data));
        //document.getElementById(data).style.opacity='0.75';
        //document.getElementById(data).style.filter='alpha(opacity=75)';

        iwidth=document.getElementById(data).width;
        iheight=document.getElementById(data).height;

        // --- Variaveis ---
        pheight=<?php echo $mh15a; ?>;
        pwidth=<?php echo $mw15a; ?>;
        // -----------------

        idiff=iheight/iwidth;
        iprop=pheight/pwidth;
        if (idiff<iprop) {
                document.getElementById(data).height=pheight;
		nheight = pheight;
                nwidth=pheight/iheight*iwidth;
                document.getElementById(data).width=nwidth;

		ntop = 0;
                nleft=(pwidth-nwidth)/2;
                document.getElementById(data).style.marginLeft=nleft+'px';
        } else {
                document.getElementById(data).width=pwidth;
		nwidth = pwidth;
                nheight=pwidth/iwidth*iheight;
                document.getElementById(data).height=nheight;

		nleft = 0;
                ntop=(pheight-nheight)/2;
                document.getElementById(data).style.marginTop=ntop+'px';
        }
        document.getElementById(data).style.maxHeight='5000%';
        document.getElementById(data).style.maxWidth='5000%';

        document.getElementById("div"+data).style.display='none';
        ev.target.appendChild(document.getElementById(data));

        imagemurl = document.getElementById(data).src;
    //saveposition(posicao, imagemurl);
        idtsession = document.getElementById("idsession").value;
        saveposition(idtsession, posicao, imagemurl, nheight, nwidth, nleft, ntop);
}

function droplixeira(ev)
{
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        //ev.target.appendChild(document.getElementById(data));
        //document.getElementById(data).style.opacity='0.75';
        //document.getElementById(data).style.filter='alpha(opacity=75)';

	document.getElementById(data).style.display='none';

        iwidth=document.getElementById(data).width;
        iheight=document.getElementById(data).height;

        // --- Variaveis ---
        pheight=55;
        pwidth=55;
        // -----------------

        idiff=iheight/iwidth;
        iprop=pheight/pwidth;
        if (idiff<iprop) {
                document.getElementById(data).height=pheight;
                nwidth=pheight/iheight*iwidth;
                document.getElementById(data).width=nwidth;

                nleft=(pwidth-nwidth)/2;
                document.getElementById(data).style.marginLeft=nleft+'px';
        } else {
                document.getElementById(data).width=pwidth;
                nheight=pwidth/iwidth*iheight;
                document.getElementById(data).height=nheight;

                ntop=(pheight-nheight)/2;
                document.getElementById(data).style.marginTop=ntop+'px';
        }
        document.getElementById(data).style.maxHeight='5000%';
        document.getElementById(data).style.maxWidth='5000%';

        document.getElementById("div"+data).style.display='none';
        ev.target.appendChild(document.getElementById(data));
}

function dropl15b(ev, posicao)
{
        ev.preventDefault();
        var data=ev.dataTransfer.getData("Text");
        //ev.target.appendChild(document.getElementById(data));
        //document.getElementById(data).style.opacity='0.75';
        //document.getElementById(data).style.filter='alpha(opacity=75)';

        iwidth=document.getElementById(data).width;
        iheight=document.getElementById(data).height;

        // --- Variaveis ---
        pheight=<?php echo $mh15b; ?>;
        pwidth=<?php echo $mw15b; ?>;
        // -----------------

        idiff=iheight/iwidth;
        iprop=pheight/pwidth;
        if (idiff<iprop) {
                document.getElementById(data).height=pheight;
		nheight = pheight;
                nwidth=pheight/iheight*iwidth;
                document.getElementById(data).width=nwidth;

		ntop = 0;
                nleft=(pwidth-nwidth)/2;
                document.getElementById(data).style.marginLeft=nleft+'px';
        } else {
                document.getElementById(data).width=pwidth;
		nwidth = pwidth;
                nheight=pwidth/iwidth*iheight;
                document.getElementById(data).height=nheight;

		nleft = 0;
                ntop=(pheight-nheight)/2;
                document.getElementById(data).style.marginTop=ntop+'px';
        }
        document.getElementById(data).style.maxHeight='5000%';
        document.getElementById(data).style.maxWidth='5000%';

        document.getElementById("div"+data).style.display='none';
        ev.target.appendChild(document.getElementById(data));

        imagemurl = document.getElementById(data).src;
    //saveposition(posicao, imagemurl);
        idtsession = document.getElementById("idsession").value;
        saveposition(idtsession, posicao, imagemurl, nheight, nwidth, nleft, ntop);
}

</script>
