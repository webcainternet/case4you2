<?php
switch ($ql) {
    //Layout 1 foto
    case 0: ?>

<!-- LAYOUT 1 -->
        <div id="divmask" style="padding: 0px; height: <?php echo $mh; ?>px; width: 680px; background-size: 340px; background-image: url(http://case4you.com.br/case4you/0/img/<?php echo $mimage; ?>); background-repeat: no-repeat no-repeat;">
            <div id="divl1" ondrop="drop(event, '1')" ondragover="allowDrop(event)" style="width: 100%; height: 100%; overflow: hidden;text-align: center;
    align: middle; "></div>
    </div>
<!-- FIM LAYOUT 1 -->

    <?php break;
    case 1: ?>

<!-- LAYOUT 2 -->
        <div id="divmask" style="padding: 0px; height: <?php echo $mh; ?>px; width: 680px; background-size: 340px; background-image: url(http://case4you.com.br/case4you/0/img/<?php echo $mimage; ?>); background-repeat: no-repeat no-repeat;">
                <div id="divl2a" ondrop="dropl2(event, '1')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw2; ?>px; height: <?php echo $mh2; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

        <div id="divl2b" ondrop="dropl2(event, '2')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw2; ?>px; height: <?php echo $mh2; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>
        </div>
<!-- FIM LAYOUT 2 -->

    <?php break;
    case 2: 
        $mw15a = $mw15a - 2;
    ?>

<!-- LAYOUT 3 -->
        <div id="divmask" style="padding: 0px; height: <?php echo $mh; ?>px; width: 666px; background-size: 340px; background-image: url(http://case4you.com.br/case4you/0/img/<?php echo $mimage; ?>); background-repeat: no-repeat no-repeat;">


                <div id="divl15b1" ondrop="dropl15b(event, '1')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b2" ondrop="dropl15b(event, '2')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15a1" ondrop="dropl15a(event, '5')" ondragover="allowDrop(event)" style="float: right;  width: <?php echo $mw15a; ?>px; height: <?php echo $mh15a; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b3" ondrop="dropl15b(event, '3')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b4" ondrop="dropl15b(event, '4')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>



                <div id="divl15a2" ondrop="dropl15a(event, '6')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15a; ?>px; height: <?php echo $mh15a; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b5" ondrop="dropl15b(event, '8')" ondragover="allowDrop(event)" style="float: right;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b6" ondrop="dropl15b(event, '7')" ondragover="allowDrop(event)" style="float: right;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b7" ondrop="dropl15b(event, '10')" ondragover="allowDrop(event)" style="float: right;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b8" ondrop="dropl15b(event, '9')" ondragover="allowDrop(event)" style="float: right;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>



                <div id="divl15b9" ondrop="dropl15b(event, '11')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b10" ondrop="dropl15b(event, '12')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15a3" ondrop="dropl15a(event, '15')" ondragover="allowDrop(event)" style="float: right;  width: <?php echo $mw15a; ?>px; height: <?php echo $mh15a; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b11" ondrop="dropl15b(event, '13')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>

                <div id="divl15b12" ondrop="dropl15b(event, '14')" ondragover="allowDrop(event)" style="float: left;  width: <?php echo $mw15b; ?>px; height: <?php echo $mh15b; ?>px; overflow: hidden;text-align: center;
        align: middle;"></div>
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

