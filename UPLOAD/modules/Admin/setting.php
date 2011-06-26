<?php
// -------------------------------------------------------------------------//
// Nuked-KlaN - PHP Portal                                                  //
// http://www.nuked-klan.org                                                //
// -------------------------------------------------------------------------//
// This program is free software. you can redistribute it and/or modify     //
// it under the terms of the GNU General Public License as published by     //
// the Free Software Foundation; either version 2 of the License.           //
// -------------------------------------------------------------------------//
defined('INDEX_CHECK') or die ('You can\'t run this file alone.');

global $user, $language;

translate('modules/Admin/lang/' . $language . '.lang.php');
include('modules/Admin/design.php');

$visiteur = ($user) ? $user[1] : 0;

if ($visiteur == 9)
{
    function select_theme($mod)
    {
        $handle = opendir('themes/');
        while (false !== ($f = readdir($handle)))
        {
            if ($f != '.' && $f != '..' && $f != 'CVS' && $f != 'index.html' && !preg_match('`[.]`', $f))
            {
                if ($mod == $f) $checked = 'selected="selected"';
                else $checked = '';

                if (is_file('themes/' . $f . '/theme.php')) echo '<option value="' . $f . '" ' . $checked . '>' . $f . '</option>';
            }
        }
        closedir($handle);
    }

    function select_langue($mod)
    {
        if ($rep = opendir('lang/'))
        {
            while (false !== ($f = readdir($rep)))
            {
                if ($f != '..' && $f != '.' && $f != 'index.html')
                {
                    list ($langfile, ,) = explode ('.', $f);

                    if ($mod == $langfile) $checked = "selected=\"selected\"";
                    else $checked = "";

                    echo "<option value=\"" . $langfile . "\" " . $checked . ">" . $langfile . "</option>\n";
                }
            }
            closedir($rep);
        }
    }

    function select_mod($mod)
    {
        global $nuked;

        $sql = mysql_query('SELECT nom FROM ' . MODULES_TABLE . ' ORDER BY nom');
        while (list($nom) = mysql_fetch_array($sql))
        {
            if ($mod == $nom) $checked = 'selected="selected"';
            else $checked = '';

            if (is_file('modules/' . $nom . '/index.php')) echo '<option value="' . $nom . '" ' . $checked . '>' . $nom . '</option>',"\n";
        }
    }
	
	function select_timeformat($tft)
	{
		global $nuked;
			
			$timeformatTable = array(
				"%A, %B %d, %Y - %H:%M:%S",
				"%A, %d %B, %Y - %H:%M:%S",
				"%A, %Y, %d %B  - %H:%M:%S",
				"%A, %B %d, %Y  - %I:%M:%S %P",
				"%A, %d %B, %Y  - %I:%M:%S %P",
				"%A, %Y, %d %B  - %I:%M:%S %P",
				"%A, %d. %B %Y  - %I:%M:%S %P",
				"%a %Y-%m-%d %H:%M:%S",
				"%a %m/%d/%Y %H:%M:%S",
				"%a %d/%m/%Y %H:%M:%S",
				"%a %Y/%m/%d %H:%M:%S",
				"%B %d, %Y - %H:%M:%S",
				"%d %B, %Y - %H:%M:%S",
				"%Y, %B %d  - %H:%M:%S",
				"%a %m/%d/%Y %I:%M:%S %P",
				"%a %d/%m/%Y %I:%M:%S %P",
				"%a %Y/%m/%d %I:%M:%S %P",
				"%B %d, %Y - %I:%M:%S %P",
				"%d %B, %Y - %I:%M:%S %P",
				"%Y, %B %d  - %I:%M:%S %P",
				"%d. %B %Y  - %I:%M:%S %P",
				"%Y-%m-%d %H:%M:%S",
				"%m/%d/%Y - %H:%M:%S",
				"%d/%m/%Y - %H:%M:%S",
				"%Y/%m/%d - %H:%M:%S",
				"%d.%m.%Y - %H:%M:%S",
				"%m/%d/%Y - %I:%M:%S %P",
				"%d/%m/%Y - %I:%M:%S %P",
				"%Y/%m/%d - %I:%M:%S %P",
				"%b %d %Y - %H:%M:%S",
				"%d %b %Y - %H:%M:%S",
				"%Y %b %d - %H:%M:%S",
				"%b %d %Y - %I:%M:%S %P",
				"%d %b %Y - %I:%M:%S %P",
				"%Y %b %d - %I:%M:%S %P",
			);
			foreach($timeformatTable as $key) 
			{
				if ($tft == $key) $checked = 'selected="selected"';
				else $checked = '';
				$day = time();
				$day += $nuked['datezone'] * 3600;
				if(idate('I', $day) == 1){
				$day -= 3600;
				}
				$echo = strftime($key, $day);
				echo "<option value=\"" . $key . "\" " . $checked . ">" . $echo . "</option>\n";
			}
	}
	
	function select_timezone($tze)
	{
		global $nuked;
			
			$timezoneTable = array(
				"-12" => "(GMT -12:00 heures) Eniwetok, Kwajalein",
				"-11" => "(GMT -11:00 heures) Midway Island, Samoa",
				"-10" => "(GMT -10:00 heures) Hawaii",
				"-9.5" => "(GMT - 9:30 heures) Polyn�sie fran�aise",
				"-9" => "(GMT -9:00 heures) Alaska",
				"-8" => "(GMT -8:00 heures) Pacific Time (US &amp; Canada)",
				"-7" => "(GMT -7:00 heures) Mountain Time (US &amp; Canada)",
				"-6" => "(GMT -6:00 heures) Central Time (US &amp; Canada), Mexico City",
				"-5" => "(GMT -5:00 heures) Eastern Time (US &amp; Canada), Bogota, Lima",
				"-4.5" => "(GMT - 4:30 heures) Bolivarian Time",
				"-4" => "(GMT -4:00 heures) Atlantic Time (Canada), Caracas, La Paz",
				"-3.5" => "(GMT -3:30 heures) Newfoundland",
				"-3" => "(GMT -3:00 heures) Br�sil, Buenos Aires, Falkland Is",
				"-2" => "(GMT -2:00 heures) Mid-Atlantic, Ascention Is., St Helena",
				"-1" => "(GMT -1:00 heures) Les A�ores, �les du Cap-Vert",
				"0" => "(GMT) Casablanca, Dublin, Londres, Lisbonne, Monrovia",
				"1" => "(GMT +1:00 heures) Bruxelles, Copenhagen, Madrid, Paris",
				"2" => "(GMT +2:00 heures) Kaliningrad, Afrique du Sud",
				"3" => "(GMT +3:00 heures) Baghdad, Riyadh, Moscow, Nairobi",
				"3.5" => "(GMT +3:30 heures) T�h�ran",
				"4" => "(GMT +4:00 heures) Abu Dhabi, Muscat, Baku, Tbilisi",
				"4.5" => "(GMT +4:30 heures) Kaboul",
				"5" => "(GMT +5:00 heures) Ekaterinburg, Islamabad, Karachi, Tashkent",
				"5.5" => "(GMT +5:30 heures) Bombay, Calcutta, Madras, New Delhi",
				"5.45" => "(GMT + 5:45 heures) Kathmandu",
				"6" => "(GMT +6:00 heures) Almaty, Dhaka, Colombo",
				"6.5" => "(GMT + 6:30 heures) Yangon, Naypyidaw, Bantam",
				"7" => "(GMT +7:00 heures) Bangkok, Hanoi, Jakarta",
				"8" => "(GMT +8:00 heures) Hong Kong, Perth, Singapour, Taipei",
				"8.45" => "(GMT + 8:45 heures) Caiguna, Eucla",
				"9" => "(GMT +9:00 heures) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",
				"9.5" => "(GMT +9:30 heures) Adelaide, Darwin",
				"10" => "(GMT +10:00 heures) Melbourne, Papouasie-Nouvelle-Guin�e, Sydney",
				"10.5" => "(GMT + 10:30 heures) �les Lord Howe",
				"11" => "(GMT +11:00 heures) Magadan, Nouvelle Cal�donie, �les Salomon",
				"11.5" => "(GMT + 11:30 heures) Burnt Pine, Kingston",
				"12" => "(GMT +12:00 heures) Auckland, Fiji, �les Marshall",
				"12.75" => "(GMT + 12:45 heures) �les Chatham",
				"13" => "(GMT + 13:00 heures) Kamchatka, Anadyr",
				"14" => "(GMT + 14:00 heures) �le Christmas",
			);
			foreach($timezoneTable as $cle=>$valeur) 
			{
				if ($tze == $cle) $checked = 'selected="selected"';
				else $checked = '';
				echo "<option value=\"" . $cle . "\" " . $checked . ">" . $valeur . "</option>\n";
			}
	}

    function edit_config()
    {
        global $nuked, $language;

        admintop();
    
        echo '<div class="content-box">',"\n" //<!-- Start Content Box -->
        . '<div class="content-box-header"><h3>' . _PREFGEN . '</h3>',"\n";
        ?>
        <script type="text/javascript">
        <!--
        // Interdire les caract�res sp�ciaux (pour le nom des cookies)
        function special_caract(evt) {
            var keyCode = evt.which ? evt.which : evt.keyCode;
            if (keyCode==9) return true;
            var interdit = '���������������������� &\?!:\.;,\t#~"^�@%\$�?���%\*()[]{}-_=+<>|\\/`\'';
            if (interdit.indexOf(String.fromCharCode(keyCode)) >= 0) {
                alert('<?php echo _SPECCNOTALLOW; ?>');
                return false;
            }
        }
        -->
        </script>
        <?php

        echo "<div style=\"text-align:right;\"><a href=\"help/" . $language . "/preference.php\"  rel=\"modal\">\n"
        . "<img style=\"border: 0;\" src=\"help/help.gif\" alt=\"\" title=\"" . _HELP . "\" /></a></div>\n"
        . "</div>\n"
        . "<div class=\"tab-content\" id=\"tab2\"><br/>\n"
        ."<div style=\"width:80%; margin:auto;\">\n"
        . "<div class=\"notification attention png_bg\">\n"
        . "<div>" . _INFOSETTING . "</div></div></div><br/>\n"
        . "<form method=\"post\" action=\"index.php?file=Admin&amp;page=setting&amp;op=save_config\">\n"
        . "<div style=\"width:96%\"><table style=\"margin-left: 2%;margin-right: auto;text-align: left;\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\">\n"
        . "<tr><td colspan=\"2\"><big><b>" . _GENERAL . "</b></big></td></tr>\n"
        . "<tr><td>" . _SITENAME . " :</td><td><input type=\"text\" name=\"name\" size=\"40\" value=\"" . $nuked['name'] . "\" /></td></tr>\n"
        . "<tr><td>" . _SLOGAN . " : </td><td><input type=\"text\" name=\"slogan\" size=\"40\" value=\"" . $nuked['slogan'] . "\" /></td></tr>\n"
        . "<tr><td>" . _TAGPRE . " :</td><td><input type=\"text\" name=\"tag_pre\" size=\"10\" value=\"" . $nuked['tag_pre'] . "\" />&nbsp;" . _TAGSUF . " :<input type=\"text\" name=\"tag_suf\" size=\"10\" value=\"" . $nuked['tag_suf'] . "\" /></td></tr>\n"
        . "<tr><td>" . _SITEURL . " :</td><td><input type=\"text\" name=\"url\" size=\"40\" value=\"" . $nuked['url'] . "\" /></td></tr>\n"
        . "<tr><td>" . _DATEFORMAT . " :</td><td><select name=\"dateformat\">\n";

        select_timeformat($nuked['dateformat']);
		
		echo "</select></td></td></tr>\n";
        echo "<tr><td>" . _DATEZONE . " :</td><td><select name=\"datezone\">\n";

        select_timezone($nuked['datezone']);
		$time = time();
		$date = nkDate($time);
        echo "</select><br /><span>" . _DATEADJUST ."&nbsp;" . $date . " </span></td><tr><td>" . _ADMINMAIL . " :</td><td><input type=\"text\" name=\"mail\" size=\"40\" value=\"" . $nuked['mail'] . "\" /></td></tr>\n"
        . "<tr><td>" . _FOOTMESS . " :</td><td><textarea class=\"editor\" name=\"footmessage\" cols=\"50\" rows=\"6\">" . $nuked['footmessage'] . "</textarea></td></tr>\n"    
        . "<tr><td>" . _SITESTATUS . " :</td><td><select name=\"nk_status\">\n";

        if ($nuked['nk_status'] == "open")
        {
            $checked11 = "selected=\"selected\"";
            $checked12 = "";
        }
        else if ($nuked['nk_status'] == "closed")
        {
            $checked12 = "selected=\"selected\"";
            $checked11 = "";
        }
        if ($nuked['screen'] == "on") $screen = "checked=\"checked\"";
        else $screen = "";

        echo "<option value=\"open\" " . $checked11 . ">" . _OPENED . "</option>\n"
        . "<option value=\"closed\" " . $checked12 . ">" . _CLOSED . "</option>\n"
        . "</select></td></tr><tr><td>" . _SITEINDEX . " :</td><td><select name=\"index_site\">\n";

        select_mod($nuked['index_site']);

        echo "</select></td></tr><tr><td>" . _THEMEDEF . " :</td><td><select name=\"theme\">\n";

        select_theme($nuked['theme']);

        echo "</select></td></tr><tr><td>" . _LANGDEF . " :</td><td><select name=\"langue\">\n";

        select_langue($nuked['langue']);

        echo "</select></td></tr>\n";

        if ($nuked['inscription'] == "on")
    {
            $checked1 = "selected=\"selected\"";
            $checked2 = "";
            $checked3 = "";
    }
        else if ($nuked['inscription'] == "off")
    {
            $checked2 = "selected=\"selected\"";
            $checked1 = "";
            $checked3 = "";
    }
        else if ($nuked['inscription'] == "mail")
    {
            $checked3 = "selected=\"selected\"";
            $checked1 = "";
            $checked2 = "";
    }


        if ($nuked['inscription_avert'] == "on") $checked4 = "checked=\"checked\"";
        else $checked4 = "";


        if ($nuked['validation'] == "auto")
    {
            $checked5 = "selected=\"selected\"";
            $checked6 = "";
            $checked7 = "";
    }
        else if ($nuked['validation'] == "admin")
    {
            $checked6 = "selected=\"selected\"";
            $checked5 = "";
            $checked7 = "";
    }
        else if ($nuked['validation'] == "mail")
    {
            $checked7 = "selected=\"selected\"";
            $checked5 = "";
            $checked6 = "";
    }


    if ($nuked['avatar_upload'] == "on") $checked8 = "checked=\"checked\"";
        else $checked8 = "";

    if ($nuked['avatar_url'] == "on") $checked9 = "checked=\"checked\"";
        else $checked9 = "";

    if ($nuked['user_delete'] == "on") $checked10 = "checked=\"checked\"";
        else $checked10 = "";

    $nuked['level_analys']==-1?$level_analys=_OFFMODULE:$level_analys=$nuked['level_analys'];
    echo "<tr><td>" . _SCREENHOT . " :</td><td><input class=\"checkbox\" type=\"checkbox\" name=\"screen\" value=\"on\" " . $screen . " /></td></tr>\n"
    . "<tr><td>" . _REGISTRATION . " :</td><td><select name=\"inscription\">\n"
    . "<option value=\"on\" " . $checked1 . ">" . _OPEN . "</option>\n"
    . "<option value=\"off\" " . $checked2 . ">" . _CLOSE . "</option>\n"
    . "<option value=\"mail\" " . $checked3 . ">" . _BYMAIL . "</option></select></td></tr>\n"
    . "<tr><td>" . _VALIDATION . " :</td><td><select name=\"validation\">\n"
    . "<option value=\"auto\" " . $checked5 . ">" . _AUTO . "</option>\n"
    . "<option value=\"admin\" " . $checked6 . ">" . _ADMINISTRATOR . "</option>\n"
    . "<option value=\"mail\" " . $checked7 . ">" . _BYMAIL . "</option></select></td></tr>\n"
    . "<tr><td>" . _USERDELETE . " :</td><td><input class=\"checkbox\" type=\"checkbox\" name=\"user_delete\" value=\"on\" " . $checked10 . " /></td></tr>\n"
    . "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><big><b>" . _SITEMEMBERS . "</b></big></td></tr>\n"
    . "<tr><td>" . _NUMBERMEMBER . " :</td><td><input type=\"text\" name=\"max_members\" size=\"2\" value=\"" . $nuked['max_members'] . "\" /></td></tr>\n"
    . "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><big><b>" . _AVATARS . "</b></big></td></tr>\n"
    . "<tr><td>" . _AVATARUPLOAD . " :</td><td><input class=\"checkbox\" type=\"checkbox\" name=\"avatar_upload\" value=\"on\" " . $checked8 . " /></td></tr>\n"
    . "<tr><td>" . _AVATARURL . " :</td><td><input class=\"checkbox\" type=\"checkbox\" name=\"avatar_url\" value=\"on\" " . $checked9 . " /></td></tr>\n"
    . "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><big><b>" . _REGISTRATION . "</b></big></td></tr>"
    . "<tr><td>" . _REGISTERMAIL . " :</td><td><input class=\"checkbox\" type=\"checkbox\" name=\"inscription_avert\" value=\"on\" " . $checked4 . " /></td></tr>\n"
    . "<tr><td>" . _REGISTERDISC . " :</td><td><textarea class=\"editor\" name=\"inscription_charte\" cols=\"50\" rows=\"6\">" . $nuked['inscription_charte'] . "</textarea></td></tr>\n"
    . "<tr><td>" . _REGISTERTXT . " :</td><td><textarea class=\"editor\" name=\"inscription_mail\" cols=\"50\" rows=\"6\">" . $nuked['inscription_mail'] . "</textarea></td></tr>\n"
    . "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><big><b>" . _STATS . "</b></big></td></tr>\n"
    . "<tr><td>" . _VISITTIME . " :</td><td><input type=\"text\" name=\"visit_delay\" size=\"2\" value=\"" . $nuked['visit_delay'] . "\" /></td></tr>\n"
    . "<tr><td>" . _LEVELANALYS . " :</td><td><select name=\"level_analys\"><option value=\"" . $nuked['level_analys'] . "\">" . $level_analys . "</option>\n"
    . "<option value='-1'>" . _OFFMODULE . "</option>\n"
    . "<option>0</option>\n"
    . "<option>1</option>\n"
    . "<option>2</option>\n"
    . "<option>3</option>\n"
    . "<option>4</option>\n"
    . "<option>5</option>\n"
    . "<option>6</option>\n"
    . "<option>7</option>\n"
    . "<option>8</option>\n"
    . "<option>9</option></select></td></tr>\n"
    . "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><big><b>" . _OPTIONCONNEX . "</b></big></td></tr>\n"
    . "<tr><td>" . _COOKIENAME . " :</td><td><input type=\"text\" name=\"cookiename\" size=\"20\" value=\"" . $nuked['cookiename'] . "\" onkeypress=\"return special_caract(event);\" /></td></tr>\n"
    . "<tr><td>" . _CONNEXMIN . " :</td><td><input type=\"text\" name=\"sess_inactivemins\" size=\"2\" value=\"" . $nuked['sess_inactivemins'] . "\" /></td></tr>\n"
    . "<tr><td>" . _CONNEXDAY . " :</td><td><input type=\"text\" name=\"sess_days_limit\" size=\"3\" value=\"" . $nuked['sess_days_limit'] . "\" /></td></tr>\n"
    . "<tr><td>" . _CONNEXSEC . " :</td><td><input type=\"text\" name=\"nbc_timeout\" size=\"3\" value=\"" . $nuked['nbc_timeout'] . "\" /></td></tr>\n"
    . "<tr><td colspan=\"2\">&nbsp;</td></tr><tr><td colspan=\"2\" align=\"center\"><big><b>" . _METATAG . "</b></big></td></tr>\n"
    . "<tr><td>" . _METAWORDS . " :</td><td><input type=\"text\" name=\"keyword\" size=\"40\" value=\"" . $nuked['keyword'] . "\" /></td></tr>\n"
    . "<tr><td>" . _METADESC . " :</td><td><textarea name=\"description\" cols=\"50\" rows=\"6\">" . $nuked['description'] . "</textarea></td></tr>\n"
    . "</table><div style=\"text-align: center;\"><br /><input type=\"submit\" name=\"ok\" value=\"" . _MODIF . "\" /></div>\n"
    . "<div style=\"text-align: center;\"><br />[ <a href=\"index.php?file=Admin\"><b>" . _BACK . "</b></a> ]</div></form><br />\n";
    echo "</div></div></div>\n";
        adminfoot();
    }

    function save_config()
    {
        global $nuked, $user;
        
        if ($_REQUEST['inscription_avert'] != "on") $_REQUEST['inscription_avert'] = "off";
        if ($_REQUEST['avatar_upload'] != "on") $_REQUEST['avatar_upload'] = "off";
        if ($_REQUEST['avatar_url'] != "on") $_REQUEST['avatar_url'] = "off";
        if ($_REQUEST['user_delete'] != "on") $_REQUEST['user_delete'] = "off";
        if ($_REQUEST['screen'] != "on") $_REQUEST['screen'] = "off";
        if (substr($_REQUEST['url'], -1) == "/") $_REQUEST['url'] = substr($_REQUEST['url'], 0, -1);
        $_REQUEST['cookiename'] = str_replace(' ','',$_REQUEST['cookiename']);
        
        $_REQUEST['inscription_charte'] = html_entity_decode($_REQUEST['inscription_charte']);
        $_REQUEST['inscription_mail'] = html_entity_decode($_REQUEST['inscription_mail']);
        $_REQUEST['footmessage'] = html_entity_decode($_REQUEST['footmessage']);

        if($_REQUEST['theme'] !== $nuked['theme'])
            mysql_query('UPDATE ' . USER_TABLE . ' SET user_theme = ""');
        
        $sql = mysql_query("SELECT name, value  FROM " . CONFIG_TABLE);
        while (list($config_name, $config_value) = mysql_fetch_array($sql))
        {
            $default_config[$config_name] = $config_value;
            $new[$config_name] = (isset($_REQUEST[$config_name])) ? $_REQUEST[$config_name] : $default_config[$config_name];
            $new_value = mysql_real_escape_string(stripslashes($new[$config_name]));
            $upd = mysql_query("UPDATE " . CONFIG_TABLE . " SET value = '" . $new_value . "' WHERE name = '" . $config_name . "'");
        }
        // Action
        $texteaction = "". _ACTIONSETTING ."";
        $acdate = time();
        $sqlaction = mysql_query("INSERT INTO ". $nuked['prefix'] ."_action  (`date`, `pseudo`, `action`)  VALUES ('".$acdate."', '".$user[0]."', '".$texteaction."')");
        //Fin action
        admintop();
        echo "<div class=\"notification success png_bg\">\n"
        . "<div>\n"
        . "" . _CONFIGSAVE . "\n"
        . "</div>\n"
        . "</div>\n";
        echo "<script>\n"
            ."setTimeout('screen()','3000');\n"
            ."function screen() { \n"
            ."screenon('index.php', 'index.php?file=Admin');\n"
            ."}\n"
            ."</script>\n";
        adminfoot();
    }

    switch ($_REQUEST['op'])
    {
        case "save_config":
            save_config($_POST);
            break;

        default:
            edit_config();
            break;
    }

}
else if ($visiteur > 1)
{
    admintop();
    echo "<div class=\"notification error png_bg\">\n"
    . "<div>\n"
    . "<br /><br /><div style=\"text-align: center;\">" . _NOENTRANCE . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a></div><br /><br />"
    . "</div>\n"
    . "</div>\n";
    adminfoot();
}
else
{
    admintop();
    echo "<div class=\"notification error png_bg\">\n"
    . "<div>\n"
    . "<br /><br /><div style=\"text-align: center;\">" . _ZONEADMIN . "<br /><br /><a href=\"javascript:history.back()\"><b>" . _BACK . "</b></a></div><br /><br />"
    . "</div>\n"
    . "</div>\n";
    adminfoot();
}
?>
