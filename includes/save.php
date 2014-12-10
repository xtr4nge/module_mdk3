<?
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
	regex_standard($_POST['type'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['tempname'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['action'], "../../../msg.php", $regex_extra);
	regex_standard($_GET['mod_action'], "../../../msg.php", $regex_extra);
	regex_standard($_GET['mod_service'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['new_rename'], "../../../msg.php", $regex_extra);
	regex_standard($_POST['new_rename_file'], "../../../msg.php", $regex_extra);
}

$type = $_POST['type'];
$tempname = $_POST['tempname'];
$action = $_POST['action'];
$mod_action = $_GET['mod_action'];
$mod_service = $_GET['mod_service'];
$newdata = html_entity_decode(trim($_POST["newdata"]));
$newdata = base64_encode($newdata);
$new_rename = $_POST["new_rename"];
$new_rename_file = $_POST["new_rename_file"];


// MODE Beacon Flood Mode [B]
if ($type == "mode_b") {

    $tmp = array_keys($mode_b);
    for ($i=0; $i< count($tmp); $i++) {
        //echo $tmp[$i]."<br>";
        
        $exec = "/bin/sed -i 's/mode_b\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\].*/mode_b\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\] = 0;/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
        //echo $exec."<br>";
        
    }

    $tmp = $_POST["options"];
    for ($i=0; $i< count($tmp); $i++) {
        //echo $tmp[$i]."<br>";
        
        $exec = "/bin/sed -i 's/mode_b\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\].*/mode_b\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\] = 1;/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
        //echo $exec."<br>";
        
    }
    
    $opt_f = $_POST["opt_f"];
    if ($opt_f != "") {
        $exec = "/bin/sed -i 's/mode_b\\[\\\"f\\\"\\]\\[2\\].*/mode_b\\[\\\"f\\\"\\]\\[2\\] = \\\"".$opt_f."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt_v = $_POST["opt_v"];
    if ($opt_v != "") {
        $exec = "/bin/sed -i 's/mode_b\\[\\\"v\\\"\\]\\[2\\].*/mode_b\\[\\\"v\\\"\\]\\[2\\] = \\\"".$opt_v."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt_n = $_POST["opt_n"];
    if ($opt_n != "") {
        $exec = "/bin/sed -i 's/mode_b\\[\\\"n\\\"\\]\\[2\\].*/mode_b\\[\\\"n\\\"\\]\\[2\\] = \\\"".$opt_n."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt_c = $_POST["opt_c"];
    if ($opt_c != "") {
        $exec = "/bin/sed -i 's/mode_b\\[\\\"c\\\"\\]\\[2\\].*/mode_b\\[\\\"c\\\"\\]\\[2\\] = \\\"".$opt_c."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt_s = $_POST["opt_s"];
    if ($opt_s != "") {
        $exec = "/bin/sed -i 's/mode_b\\[\\\"s\\\"\\]\\[2\\].*/mode_b\\[\\\"s\\\"\\]\\[2\\] = \\\"".$opt_s."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    header('Location: ../index.php?tab=1');
    exit;

}


// MODE Authentication DoS mode [A]
if ($type == "mode_a") {

    $mode = "a";

    // CLEAR CHECKBOX
    $tmp = array_keys($mode_a);
    for ($i=0; $i< count($tmp); $i++) {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\].*/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\] = 0;/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
        //echo $exec."<br>";
    }

    // SAVE CHECKBOX
    $tmp = $_POST["options"];
    for ($i=0; $i< count($tmp); $i++) {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\].*/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\] = 1;/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
        //echo $exec."<br>";
    }

    // SAVE VALUES
    $opt = "a";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "i";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "c";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "s";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    header('Location: ../index.php?tab=2');
    exit;

}


// MODE Deauthentication / Disassociation Amok Mode [D]
if ($type == "mode_d") {

    $mode = "d";

    // CLEAR CHECKBOX
    $tmp = array_keys($mode_d);
    for ($i=0; $i< count($tmp); $i++) {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\].*/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\] = 0;/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
        //echo $exec."<br>";
    }

    // SAVE CHECKBOX
    $tmp = $_POST["options"];
    for ($i=0; $i< count($tmp); $i++) {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\].*/mode_".$mode."\\[\\\"".$tmp[$i]."\\\"\\]\\[0\\] = 1;/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
        //echo $exec."<br>";
    }

    // SAVE VALUES
    $opt = "w";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "b";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "d";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "c";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    $opt = "s";
    $opt_value = $_POST["opt_".$opt];
    if ($opt != "") {
        $exec = "/bin/sed -i 's/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\].*/mode_".$mode."\\[\\\"".$opt."\\\"\\]\\[2\\] = \\\"".$opt_value."\\\";/g' options_config.php";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        exec_fruitywifi($exec);
    }

    header('Location: ../index.php?tab=3');
    exit;

}

// START SAVE LISTS
if ($type == "templates") {
	if ($action == "save") {
		
		if ($tempname != "0") {
			// SAVE TAMPLATE
			if ($newdata != "") { $newdata = ereg_replace(13,  "", $newdata);
				$template_path = "$mod_path/includes/templates";
        		$exec = "/bin/echo '$newdata' | base64 --decode > $template_path/$tempname";
        		//exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
                exec_fruitywifi($exec);
    		}
    	}
    	
	} else if ($action == "add_rename") {
	
		if ($new_rename == "0") {
			//CREATE NEW TEMPLATE
			if ($new_rename_file != "") {
				$template_path = "$mod_path/includes/templates";
				$exec = "/bin/touch $template_path/$new_rename_file";
				//exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
                exec_fruitywifi($exec);

				$tempname=$new_rename_file;
			}
		} else {
			//RENAME TEMPLATE
			$template_path = "$mod_path/includes/templates";
			$exec = "/bin/mv $template_path/$new_rename $template_path/$new_rename_file";
			//exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
            exec_fruitywifi($exec);

			$tempname=$new_rename_file;
		}
		
	} else if ($action == "delete") {
		if ($new_rename != "0") {
			//DELETE TEMPLATE
			$template_path = "$mod_path/includes/templates";
			$exec = "/bin/rm $template_path/$new_rename";
			//exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
            exec_fruitywifi($exec);
		}
	}
	header("Location: ../index.php?tab=4&tempname=$tempname");
	exit;
}

header('Location: ../index.php');

?>