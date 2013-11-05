<? 
/*
	Copyright (C) 2013  xtr4nge [_AT_] gmail.com

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/ 
?>
<?
//include "../login_check.php";
include "../_info_.php";
include "/usr/share/FruityWifi/www/config/config.php";
include "/usr/share/FruityWifi/www/functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_GET["service"], "../msg.php", $regex_extra);
    regex_standard($_GET["action"], "../msg.php", $regex_extra);
    regex_standard($_GET["page"], "../msg.php", $regex_extra);
    regex_standard($iface_wifi, "../msg.php", $regex_extra);
}

$service = $_GET['service'];
$action = $_GET['action'];
$page = $_GET['page'];

if($service != "") {
    
    //$exec = "/bin/sed -i 's/ss_mode.*/ss_mode = \\\"".$service."\\\";/g' options_config.php";
    //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output);

    /*
    // START MONITOR MODE (mon0)
    $iface_mon0 = exec("/sbin/ifconfig |grep mon0");
    if ($iface_mon0 == "") {
        $exec = "/usr/bin/sudo /usr/sbin/airmon-ng start $iface_wifi_extra";
        exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output);
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"");
    }
    */    
    
    if ($action == "start") {
        
        // START MONITOR MODE (mon0)
        start_monitor_mode($iface_wifi_extra);
        
        // COPY LOG
        $exec = "cp $mod_logs logs/".gmdate("Ymd-H-i-s").".log";
        exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $dump);
        // CLEAN LOGS
        $exec = "echo '' > $mod_logs";
        exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"" );
        // START MODULE
        
        if ($service == "mode_b") {
            
            $mode = "b";
            $tmp = array_keys($mode_b);
            for ($i=0; $i< count($tmp); $i++) {
                 if ($mode_b[$tmp[$i]][0] == "1") {
                    if ($tmp[$i] == "f" or $tmp[$i] == "v") {
                        $options .= " -" . $tmp[$i] . " $mod_path/includes/templates/" . $mode_b[$tmp[$i]][2];
                    } else {
                        $options .= " -" . $tmp[$i] . " " . $mode_b[$tmp[$i]][2];                
                    }
                }
            }
        
        } else if ($service == "mode_a") {
            
            $mode = "a";
            $tmp = array_keys($mode_a);
            for ($i=0; $i< count($tmp); $i++) {
                 if ($mode_a[$tmp[$i]][0] == "1") {
                        $options .= " -" . $tmp[$i] . " " . $mode_a[$tmp[$i]][2];
                }
            }

        } else if ($service == "mode_d") {
            
            $mode = "d";
            $tmp = array_keys($mode_d);
            for ($i=0; $i< count($tmp); $i++) {
                 if ($mode_d[$tmp[$i]][0] == "1") {
                    if ($tmp[$i] == "w" or $tmp[$i] == "b") {
                        $options .= " -" . $tmp[$i] . " $mod_path/includes/templates/" . $mode_d[$tmp[$i]][2];
                    } else {
                        $options .= " -" . $tmp[$i] . " " . $mode_d[$tmp[$i]][2];                
                    }
                }
            }

        }

        
        $exec = "/usr/bin/mdk3 mon0 $mode $options >> $mod_logs &";
        exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"" );
    } else if($action == "stop") {
        // STOP MODULE
        $exec = "killall mdk3";
        exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"" );
    }

}

//header('Location: ../index.php?tab=0');
header('Location: ../../action.php?page=mdk3');

/*
if ($page == "list") {
    header('Location: ../page_modules.php');    
} else if ($page == "module") {
    //header('Location: ../modules/dnsspoof/index.php');
    header('Location: ../modules/action.php?page=urlsnarf');
} else {
    header('Location: ../page_status.php');
}
*/
?>