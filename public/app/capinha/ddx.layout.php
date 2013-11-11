
<?php
switch ($ql) {
    //Layout 1 foto
    case 0: ?>

<!-- LAYOUT 1 -->
    	<div id="divmask" style="padding: 0px; height: <?php echo $mh; ?>px; width: 340px; margin-left: 10px; background-size: 340px; background-image: url(http://case4you.com.br/app/img/<?php echo $mimage; ?>); background-repeat: no-repeat no-repeat;">
    		<div id="divl1" ondrop="drop(event, '1')" ondragover="allowDrop(event)" style="width: 100%; height: 100%; overflow: hidden;text-align: center;
	align: middle; border: solid 1px #6aa11a;">
                <div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl1')"><img src="img/close_red.gif"></a></div>
            </div>
  	</div>
<!-- FIM LAYOUT 1 -->

    <?php break;
    case 1: ?>

<!-- LAYOUT 2 -->
        <div id="divmask" style="padding: 0px; height: <?php echo $mh; ?>px; width: 340px; margin-left: 10px; background-size: 340px; background-image: url(http://case4you.com.br/app/img/<?php echo $mimage; ?>); background-repeat: no-repeat no-repeat;">
                <div id="divl2a" ondrop="dropl2(event, '1')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw2; ?>px; height: <?php echo $mh2; ?>px; overflow: hidden;text-align: center;
        align: middle;">
                    <div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl2a')"><img src="img/close_red.gif"></a></div>
                </div>

        		<div id="divl2b" ondrop="dropl2(event, '2')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw2; ?>px; height: <?php echo $mh2; ?>px; overflow: hidden;text-align: center;
        align: middle;">
                    <div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl2b')"><img src="img/close_red.gif"></a></div>
                </div>
        </div>
<!-- FIM LAYOUT 2 -->

    <?php break;
    case 2: ?>

<!-- LAYOUT 3 -->
        <div id="divmask" style="padding: 0px; height: <?php echo $mh; ?>px; width: 340px; margin-left: 10px; background-size: 340px; background-image: url(http://case4you.com.br/app/img/<?php echo $mimage; ?>); background-repeat: no-repeat no-repeat;">


                <div id="divl15b1" ondrop="dropl15b(event, '1')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b1')"><img src="img/close_red.gif"></a></div></div>

		        <div id="divl15b2" ondrop="dropl15b(event, '2')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b2')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15a1" ondrop="dropl15a(event, '5')" ondragover="allowDrop(event)" style="float: right; border: solid 1px #6aa11a; width: <?php echo $mw15a; ?>px; height: <?php echo $mh15a; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15a1')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b3" ondrop="dropl15b(event, '3')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b3')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b4" ondrop="dropl15b(event, '4')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b4')"><img src="img/close_red.gif"></a></div></div>



		        <div id="divl15a2" ondrop="dropl15a(event, '6')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15a; ?>px; height: <?php echo $mh15a; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15a2')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b5" ondrop="dropl15b(event, '8')" ondragover="allowDrop(event)" style="float: right; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b5')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b6" ondrop="dropl15b(event, '7')" ondragover="allowDrop(event)" style="float: right; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b6')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b7" ondrop="dropl15b(event, '10')" ondragover="allowDrop(event)" style="float: right; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b7')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b8" ondrop="dropl15b(event, '9')" ondragover="allowDrop(event)" style="float: right; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b8')"><img src="img/close_red.gif"></a></div></div>



                <div id="divl15b9" ondrop="dropl15b(event, '11')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b9')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b10" ondrop="dropl15b(event, '12')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b10')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15a3" ondrop="dropl15a(event, '15')" ondragover="allowDrop(event)" style="float: right; border: solid 1px #6aa11a; width: <?php echo $mw15a; ?>px; height: <?php echo $mh15a; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15a3')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b11" ondrop="dropl15b(event, '13')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b11')"><img src="img/close_red.gif"></a></div></div>

                <div id="divl15b12" ondrop="dropl15b(event, '14')" ondragover="allowDrop(event)" style="float: left; border: solid 1px #6aa11a; width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"><div style="position: absolute; width: 10px; height: 10px;z-index: 10; margin: 5px;"><a href="#" onclick="lixeiraremove('divl15b12')"><img src="img/close_red.gif"></a></div></div>
        </div>
<!-- FIM LAYOUT 3 -->

    <?php break;
} ?>

<!-- invisible iframes -->
<div style="display: none;">
    <iframe id="invfr1"  name="invfr1"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr2"  name="invfr2"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr3"  name="invfr3"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr4"  name="invfr4"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr5"  name="invfr5"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr6"  name="invfr6"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr7"  name="invfr7"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr8"  name="invfr8"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr9"  name="invfr9"  src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr10" name="invfr10" src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr11" name="invfr11" src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr12" name="invfr12" src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr13" name="invfr13" src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr14" name="invfr14" src="http://case4you.com.br/case4you/2/blank.html"></iframe>
    <iframe id="invfr15" name="invfr15" src="http://case4you.com.br/case4you/2/blank.html"></iframe>
</div>




