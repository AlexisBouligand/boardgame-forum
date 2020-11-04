<?php

//Allow to select a tag
//No return
function display_selection_tag_list()
{
    global $bdd;

    $req = $bdd->prepare("SELECT id, tag_name FROM tag;");
    if($req->execute())
    {
        echo "<select name=\"tag\">";

        //We offer the possibility to don't chose a tag
        echo "<option value=\"none\">None</option>";

        // While there remains at least one tag, we display it
        while($ligne = $req->fetch()) {
            if ($ligne["id"] == $tag) {
                echo "<option value=\"$ligne[id]\" selected>$ligne[tag_name]</option>";
            } else {
                echo "<option value=\"$ligne[id]\">$ligne[tag_name]</option>";
            }
        }
        echo  "</select>";
    }
    else{
        echo "You can not select any tag. Sad.";
    }

}
?>
