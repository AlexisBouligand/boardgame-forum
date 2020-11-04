<?php

//Ask for the name if the input
//Allow to select a tag among a list
//No return
function display_selection_tag_list($select_name ="tag")
{
    global $bdd;

    $req = $bdd->prepare("SELECT id, tag_name FROM tag;");
    if($req->execute())
    {
        echo "<select name=$select_name>";

        //We offer the possibility not to chose a tag
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
