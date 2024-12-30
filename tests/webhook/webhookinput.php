<?php
	include_once '../../assets/plexmovieposter/PlexLib.php';
	include_once '../../assets/plexmovieposter/CacheLib.php';
	include_once '../../assets/plexmovieposter/tools.php';

	$plex_webhook_data_raw = file_get_contents('php://input');

	plex_webhook_decode();

	$PlexWebHookOutput = fopen("Plex_WebHook_Output.txt", "w") or die("Unable to open file!");

	fwrite($PlexWebHookOutput, "Json:\n");
	fwrite($PlexWebHookOutput, $plex_webhook_data_json["event"]);

	fwrite($PlexWebHookOutput, "\n\nRAW:\n");
	// fwrite($PlexWebHookOutput, $plex_webhook_data_raw);

	fwrite($PlexWebHookOutput, "\n\nSample Data:\n");
	fwrite($PlexWebHookOutput, "Media Title: $pwhd_Metadata_title \n");

	fclose($PlexWebHookOutput);
?>
