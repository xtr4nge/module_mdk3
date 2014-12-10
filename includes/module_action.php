<? 
/*
    Copyright (C) 2013-2014 xtr4nge [_AT_] gmail.com

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
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

include "options_config.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_GET["service"], "../msg.php", $regex_extra);
    regex_standard($_GET["action"], "../msg.php", $regex_extra);
    regex_standard($_GET["page"], "../msg.php", $regex_extra);
    regex_standard($_GET["install"], "../msg.php", $regex_extra);
}

$service = $_GET['service'];
$action = $_GET['action'];
$page = $_GET['page'];
$install = $_GET['install'];

if($service != "") {
    
    //$exec = "/bin/sed -i 's/ss_mode.*/ss_mode = \\\"".$service."\\\";/g' options_config.php";
    //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output);

    /*
    // START MONITOR MODE (mon0)
    $iface_mon0 = exec("/sbin/ifconfig |grep mon0");
    if ($iface_mon0 == "") {
        $exec = "/usr/bin/sudo /usr/sbin/airmon-ng start $io_action_extra";
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"", $output); //DEPRECATED
        //exec("/usr/share/FruityWifi/bin/danger \"" . $exec . "\"");
    }
    */    
    
    if ($action == "start") {
        
        // START MONITOR MODE (mon0)
        start_monitor_mode($io_in_iface_extra);
        
        // COPY LOG
        $exec = "$bin_cp $mod_logs logs/".gmdate("Ymd-H-i-s").".log";
        //exec("$bin_danger \"$exec\"", $dump); //DEPRECATED
	exec_fruitywifi($exec);
	
        // CLEAN LOGS
        $exec = "$bin_echo '' > $mod_logs";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
	exec_fruitywifi($exec);
	
        // START MODULE
        
        //if ($service == "mode_b") {
        if ($ss_mode == "mode_b") {
            
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
        
        //} else if ($service == "mode_a") {
        } else if ($ss_mode == "mode_a") {
            
            $mode = "a";
            $tmp = array_keys($mode_a);
            for ($i=0; $i< count($tmp); $i++) {
                 if ($mode_a[$tmp[$i]][0] == "1") {
                        $options .= " -" . $tmp[$i] . " " . $mode_a[$tmp[$i]][2];
                }
            }

        //} else if ($service == "mode_d") {
        } else if ($ss_mode == "mode_d") {
            
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
        
        $exec = "$bin_mdk3 mon0 $mode $options >> $mod_logs &";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
	exec_fruitywifi($exec);
	
    } else if($action == "stop") {
        // STOP MODULE
        $exec = "$bin_killall mdk3";
        //exec("$bin_danger \"$exec\"" ); //DEPRECATED
	exec_fruitywifi($exec);
    }

}

if ($install == "install_mdk3") {

    $exec = "$bin_chmod 755 install.sh";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);

    $exec = "$bin_sudo ./install.sh > $log_path/install.txt &";
    //exec("$bin_danger \"$exec\"" ); //DEPRECATED
    exec_fruitywifi($exec);

    header('Location: ../../install.php?module=mdk3');
    exit;
}

if ($page == "status") {
    header('Location: ../../../action.php');
} else {
    header('Location: ../../action.php?page=mdk3');
}
//header('Location: ../../action.php?page=mdk3');

?>
