<?php

if(!empty($_POST)){
    var_dump($_POST);
} else {
    ?>

<form method="post" action="" id="frm">
    <input name="sections[0][name]" />
    <input name="sections[0][content]" />
    <input name="sections[0][id]" />
    <input name="sections[1][name]" />
    <input name="sections[1][content]" />
    <input name="sections[1][id]" />
    <input name="sections[23452133412][name]" />
    <input name="sections[23452133412][content]" />
    <input name="sections[23452133412][id]" />
    <input type="submit" value="ciei"/>
</form>
    <a href="#" onclick="add(Array('name', 'content', 'id'))">aggiungi</a>
<?php
}
?>