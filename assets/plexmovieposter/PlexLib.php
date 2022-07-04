<?php

//  NEED TO SUPPORT "movie" and "show" as well as "clients"

function plex_metadata_base($mediaType = "episode", $mediaLogMode = "") {
    // Global Variables - Input
    global $PLEXMetadata;

    switch ($mediaType) {
        case "episode":
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "season":
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "series":
            $media_logClass = "PLEX_getTVMetadata";
            break;
        case "movie":
            $media_logClass = "PLEX_getMovieMetadata";
            break;
        case "track":
            $media_logClass = "PLEX_getMusicMetadata";
            break;
        default:
            $media_logClass = "PLEX_getMediaMetadata";
            break;
    }

    $PLEXMetadata['LogClass'] = $media_logClass;

    switch ($mediaLogMode) {
        case "START":
            pmp_Logging("$media_logClass", "\n--- Media START Point ---");
            pmp_Logging("$media_logClass", "\tmediaURL @ $mediaType - " . $PLEXMetadata['rootMediaURL']);
            break;
        case "END":
            pmp_Logging("$media_logClass", "---  Media END Point  ---");
            break;
        default:
            pmp_Logging("$media_logClass", "---  Media TBD Point  ---");
            break;
    }

}

function plex_metadata_title($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    global $mediaTitle, $mediaTitle_MetadataID;

    $media_MetadataID_STR = "";

    // Title
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'title';
            break;
        case "season":
            $media_metadata_name = 'parentTitle';
            break;
        case "series":
            $media_metadata_name = 'grandparentTitle';
            break;
        case "movie":
            $media_metadata_name = 'title';
            break;
        case "track":
            $media_metadata_name = 'title'; // Track Title (future - title, parentTitle (Album), grandparentTitle (Artist))
            break;
        default:
            $media_metadata_name = 'title';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaTitle = $subElement[$media_metadata_name];

    if (empty($mediaTitle)) {
        $mediaTitle = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaTitle);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaTitle_MetadataID = $media_MetadataID;
    $PLEXMetadata['title'] = $mediaTitle;
    pmp_Logging("$media_logClass", "\tmediaTitle @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaTitle");
}

function plex_metadata_summary($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    global $mediaSummary, $mediaSummary_MetadataID;

    $media_MetadataID_STR = "";

    // Summary
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'summary';
            break;
        case "season":
            $media_metadata_name = 'summary';
            break;
        case "series":
            $media_metadata_name = 'summary';
            break;
        case "movie":
            $media_metadata_name = 'summary';
            break;
        case "track":
            $media_metadata_name = 'summary';
            break;
        default:
            $media_metadata_name = 'summary';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaSummary = $subElement[$media_metadata_name];

    if (empty($mediaSummary)) {
        $mediaSummary = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaSummary);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaSummary_MetadataID = $media_MetadataID;
    $PLEXMetadata['summary'] = $mediaSummary;
    pmp_Logging("$media_logClass", "\tmediaSummary @ $mediaType ($media_metadata_name) $media_MetadataID_STR - \n $mediaSummary");
}

function plex_metadata_time($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    // global $mediaViewOffset, $mediaSummary_MetadataID;

    $media_MetadataID_STR = "";

    // Summary
    switch ($mediaType) {
        case "episode":
            $media_metadata_name_A = 'viewOffset';
            $media_metadata_name_B = 'lastViewedAt';
            break;
        case "season":
            $media_metadata_name_A = 'viewOffset';
            $media_metadata_name_B = 'lastViewedAt';
            break;
        case "series":
            $media_metadata_name_A = 'viewOffset';
            $media_metadata_name_B = 'lastViewedAt';
            break;
        case "movie":
            $media_metadata_name_A = 'viewOffset';
            $media_metadata_name_B = 'lastViewedAt';
            break;
        case "track":
            $media_metadata_name_A = 'viewOffset';
            $media_metadata_name_B = 'lastViewedAt';
            break;
        default:
            $media_metadata_name_A = 'viewOffset';
            $media_metadata_name_B = 'lastViewedAt';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaViewOffset = $subElement[$media_metadata_name_A];
    $mediaLastViewedAt = $subElement[$media_metadata_name_B];

    if (empty($mediaViewOffset)) {
        $mediaViewOffset = "N/A";
    }

    $PLEXMetadata['viewOffset'] = $mediaViewOffset;
    pmp_Logging("$media_logClass", "\mediaViewOffset @ $mediaType ($media_metadata_name_A) $media_MetadataID_STR - $mediaViewOffset");
    
    if (empty($mediaLastViewedAt)) {
        $mediaLastViewedAt = "N/A";
    }

    $PLEXMetadata['lastViewedAt'] = $mediaLastViewedAt;
    pmp_Logging("$media_logClass", "\mediaLastViewedAt @ $mediaType ($media_metadata_name_B) $media_MetadataID_STR - $mediaLastViewedAt");
}

function plex_metadata_tagline($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    global $mediaTagline, $mediaTagline_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: TV Shows do not contain tagline

    // Tagline
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'tagline';
            break;
        case "season":
            $media_metadata_name = 'tagline';
            break;
        case "series":
            $media_metadata_name = 'tagline';
            break;
        case "movie":
            $media_metadata_name = 'tagline';
            break;
        case "track":
            $media_metadata_name = 'tagline';
            break;
        default:
            $media_metadata_name = 'tagline';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaTagline = $subElement[$media_metadata_name];

    if (empty($mediaTagline)) {
        $mediaTagline = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaTagline);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaTagline_MetadataID = $media_MetadataID;
    $PLEXMetadata['tagline'] = $mediaTagline;
    pmp_Logging("$media_logClass", "\tmediaTagline @ $mediaType ($media_metadata_name) $media_MetadataID_STR - \n $mediaTagline");
}

function plex_metadata_art($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    global $mediaArt, $mediaArt_MetadataID;

    $media_MetadataID_STR = "";

    // Art
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'art';
            break;
        case "season":
            $media_metadata_name = 'art';
            break;
        case "series":
            $media_metadata_name = 'art';
            break;
        case "movie":
            $media_metadata_name = 'art';
            break;
        case "track":
            $media_metadata_name = 'art';
            break;
        default:
            $media_metadata_name = 'art';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaArt = $subElement[$media_metadata_name];

    if (empty($mediaArt)) {
        $mediaArt = "N/A";
    }

    $media_MetadataID_TMP = preg_split("#/#", $mediaArt);
    $media_MetadataID = $media_MetadataID_TMP[3];
    $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    $mediaArt_MetadataID = $media_MetadataID;
    $PLEXMetadata['art'] = $mediaArt;
    pmp_Logging("$media_logClass", "\tmediaArt @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaArt");
}

function plex_metadata_contentRating($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    global $mediaContentRating, $mediaContentRating_MetadataID;

    $media_MetadataID_STR = "";

    // Notes:

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'contentRating';
            break;
        case "season":
            $media_metadata_name = 'contentRating';
            break;
        case "series":
            $media_metadata_name = 'contentRating';
            break;
        case "movie":
            $media_metadata_name = 'contentRating';
            break;
        case "track":
            $media_metadata_name = 'contentRating';
            break;
        default:
            $media_metadata_name = 'contentRating';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaContentRating = $subElement[$media_metadata_name];

    if (empty ($mediaContentRating)) {
        $mediaContentRating = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaContentRating);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaContentRating_MetadataID = $media_MetadataID;
    $PLEXMetadata['contentRating'] = $mediaContentRating;
    pmp_Logging("$media_logClass", "\tmediaContentRating @ $mediaType ($media_metadata_name) - \"$mediaContentRating\"");
}

function plex_metadata_decision($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying, $clients;
    global $mediaDecision, $mediaDecision_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: decision -> directplay/transcode
    // DirectPlay/Transcode (Only for Playing)
    // Requires clients because the decision is not part of the main metadata of the media.

    // decision
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'decision';
            break;
        case "season":
            $media_metadata_name = 'decision';
            break;
        case "series":
            $media_metadata_name = 'decision';
            break;
        case "movie":
            $media_metadata_name = 'decision';
            break;
        case "track":
            $media_metadata_name = 'decision';
            break;
        default:
            $media_metadata_name = 'decision';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    if ($isPlayingMode == TRUE) {
        $rootElement = $PLEXMetadata['rootXMLData'];
        $rootElement = $clients;
        $subElement = $rootElement->Media->Part;
        $mediaDecision = $subElement[$media_metadata_name];

        if (empty($mediaDecision)) {
            $mediaDecision = "N/A";
        }
    }
    else {
        $mediaDecision = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaDecision);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaDecision_MetadataID = $media_MetadataID;
    $PLEXMetadata['decision'] = $mediaDecision;
    pmp_Logging("$media_logClass", "\tmediaDecision @ $mediaType -- isPlaying -- ($media_metadata_name) - \"$mediaDecision\"");
}

function plex_metadata_audioCodec($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying;
    global $mediaAudioCodec, $mediaAudioCodec_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: audioCodec
    //

    // Audio Codec
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'audioCodec';
            break;
        case "season":
            $media_metadata_name = 'audioCodec';
            break;
        case "series":
            $media_metadata_name = 'audioCodec';
            break;
        case "movie":
            $media_metadata_name = 'audioCodec';
            break;
        case "track":
            $media_metadata_name = 'audioCodec';
            break;
        default:
            $media_metadata_name = 'audioCodec';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];


    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement->Media;
    $mediaAudioCodec = $subElement[$media_metadata_name];

    if (empty($mediaAudioCodec)) {
        $mediaAudioCodec = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaAudioCodec);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaAudioCodec_MetadataID = $media_MetadataID;
    $PLEXMetadata['audioCodec'] = $mediaAudioCodec;
    pmp_Logging("$media_logClass", "\tmediaAudioCodec @ $mediaType ($media_metadata_name) - \"$mediaAudioCodec\"");
}

function plex_metadata_audioChannelLayout($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying;
    global $mediaAudioChannelLayout, $mediaAudioChannelLayout_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: audioChannelLayout
    //

    // Audio Codec
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'audioChannelLayout';
            break;
        case "season":
            $media_metadata_name = 'audioChannelLayout';
            break;
        case "series":
            $media_metadata_name = 'audioChannelLayout';
            break;
        case "movie":
            $media_metadata_name = 'audioChannelLayout';
            break;
        case "track":
            $media_metadata_name = 'audioChannelLayout';
            break;
        default:
            $media_metadata_name = 'audioChannelLayout';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement->Media->Part->Stream[1];
    $mediaAudioChannelLayout = $subElement[$media_metadata_name];

    if (empty($mediaAudioChannelLayout)) {
        $mediaAudioChannelLayout = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaAudioChannelLayout);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaAudioChannelLayout_MetadataID = $media_MetadataID;
    $PLEXMetadata['audioChannelLayout'] = $mediaAudioChannelLayout;
    pmp_Logging("$media_logClass", "\tmediaAudioChannelLayout @ $mediaType ($media_metadata_name) - \"$mediaAudioChannelLayout\"");
}

function plex_metadata_videoCodec($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying;
    global $mediaVideoCodec, $mediaVideoCodec_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: videoCodec
    //

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'videoCodec';
            break;
        case "season":
            $media_metadata_name = 'videoCodec';
            break;
        case "series":
            $media_metadata_name = 'videoCodec';
            break;
        case "movie":
            $media_metadata_name = 'videoCodec';
            break;
        case "track":
            $media_metadata_name = 'videoCodec';
            break;
        default:
            $media_metadata_name = 'videoCodec';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement->Media;
    $mediaVideoCodec = $subElement[$media_metadata_name];

    if (empty($mediaVideoCodec)) {
        $mediaVideoCodec = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaVideoCodec);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaVideoCodec_MetadataID = $media_MetadataID;
    $PLEXMetadata['videoCodec'] = $mediaVideoCodec;
    pmp_Logging("$media_logClass", "\tmediaVideoCodec @ $mediaType ($media_metadata_name) - \"$mediaVideoCodec\"");
}

function plex_metadata_videoResolution($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying;
    global $mediaVideoResolution, $mediaVideoResolution_MetadataID;

    $media_MetadataID_STR = "";

    // Notes: videoResolution
    //

    // videoResolution
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'videoResolution';
            break;
        case "season":
            $media_metadata_name = 'videoResolution';
            break;
        case "series":
            $media_metadata_name = 'videoResolution';
            break;
        case "movie":
            $media_metadata_name = 'videoResolution';
            break;
        case "track":
            $media_metadata_name = 'videoResolution';
            break;
        default:
            $media_metadata_name = 'videoResolution';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement->Media;
    $mediaVideoResolution = $subElement[$media_metadata_name];

    if (empty($mediaVideoResolution)) {
        $mediaVideoResolution = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaVideoResolution);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaVideoResolution_MetadataID = $media_MetadataID;
    $PLEXMetadata['videoResolution'] = $mediaVideoResolution;
    pmp_Logging("$media_logClass", "\tmediaVideoResolution @ $mediaType ($media_metadata_name) - \"$mediaVideoResolution\"");
}

function plex_metadata_audioDisplay($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying, $clients;
    global $mediaAudioDisplay, $mediaAudioDisplay_MetadataID;

    $media_MetadataID_STR = "";

    // Notes:
    //

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'displayTitle';
            break;
        case "season":
            $media_metadata_name = 'displayTitle';
            break;
        case "series":
            $media_metadata_name = 'displayTitle';
            break;
        case "movie":
            $media_metadata_name = 'displayTitle';
            break;
        case "track":
            $media_metadata_name = 'displayTitle';
            break;
        default:
            $media_metadata_name = 'displayTitle';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    if ($isPlayingMode == TRUE) {
        $rootElement = $PLEXMetadata['rootXMLData'];
        $rootElement = $clients;
        $subElement = $rootElement->Media->Part->Stream[1];
        $mediaAudioDisplay = $subElement[$media_metadata_name];

        if (empty($mediaAudioDisplay)) {
            $mediaAudioDisplay = "N/A";
        }
    }
    else {
        $mediaAudioDisplay = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaAudioDisplay);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaAudioDisplay_MetadataID = $media_MetadataID;
    $PLEXMetadata['audioDisplay'] = $mediaAudioDisplay;
    pmp_Logging("$media_logClass", "\tmediaAudioDisplay @ $mediaType -- isPlaying -- ($media_metadata_name) - \"$mediaAudioDisplay\"");
}

function plex_metadata_videoDisplay($mediaType = "episode", $isPlayingMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $isPlaying, $clients;
    global $mediaVideoDisplay, $mediaVideoDisplay_MetadataID;

    $media_MetadataID_STR = "";

    // Notes:
    //

    // contentRating
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'displayTitle';
            break;
        case "season":
            $media_metadata_name = 'displayTitle';
            break;
        case "series":
            $media_metadata_name = 'displayTitle';
            break;
        case "movie":
            $media_metadata_name = 'displayTitle';
            break;
        case "track":
            $media_metadata_name = 'displayTitle';
            break;
        default:
            $media_metadata_name = 'displayTitle';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    if ($isPlayingMode == TRUE) {
        $rootElement = $PLEXMetadata['rootXMLData'];
        $rootElement = $clients;
        $subElement = $rootElement->Media->Part->Stream[0];
        $mediaVideoDisplay = $subElement[$media_metadata_name];

        if (empty($mediaVideoDisplay)) {
            $mediaVideoDisplay = "N/A";
        }
    }
    else {
        $mediaVideoDisplay = "N/A";
    }

    // $media_MetadataID_TMP = preg_split("#/#", $mediaVideoDisplay);
    // $media_MetadataID = $media_MetadataID_TMP[3];
    // $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    // $mediaVideoDisplay_MetadataID = $media_MetadataID;
    $PLEXMetadata['videoDisplay'] = $mediaVideoDisplay;
    pmp_Logging("$media_logClass", "\tmediaVideoDisplay @ $mediaType -- isPlaying -- ($media_metadata_name) - \"$mediaVideoDisplay\"");
}

function plex_metadata_thumb($mediaType = "episode", $ComingSoonMode = FALSE) {
    // Global Variables - Input
    global $PLEXMetadata;
    global $comingSoonShowSelection;
    global $mediaThumb, $mediaThumb_MetadataID;

    $media_MetadataID_STR = "";

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;

    // Thumb
    switch ($mediaType) {
        case "episode":
            $media_metadata_name = 'thumb';

            $mediaThumb = $subElement[$media_metadata_name];

            if ($mediaThumb == '') {
                $media_metadata_name = 'parentThumb';
                $mediaThumb = $subElement[$media_metadata_name];
            }

            if ($mediaThumb == '') {
                $media_metadata_name = 'grandparentThumb';
                $mediaThumb = $subElement[$media_metadata_name];
            }
            break;
        case "season":
            if ($ComingSoonMode == TRUE) {
                switch ($comingSoonShowSelection) {
                    case "all":
                        $media_metadata_name = 'thumb';
                        break;
                    case "unwatched":
                        $media_metadata_name = 'thumb';
                        break;
                    // case "newest":
                        // break;
                    // case "recentlyAdded":
                        // break;
                    default:
                        $media_metadata_name = 'parentThumb';
                        $mediaThumb = $subElement[$media_metadata_name];

                        if ($mediaThumb == '') {
                            $media_metadata_name = 'grandparentThumb';
                            $mediaThumb = $subElement[$media_metadata_name];
                        }
                }
            }
            else {
                $media_metadata_name = 'parentThumb';
                $mediaThumb = $subElement[$media_metadata_name];

                if ($mediaThumb == '') {
                    $media_metadata_name = 'grandparentThumb';
                    $mediaThumb = $subElement[$media_metadata_name];
                }
            }
            break;
        case "series":
            if ($ComingSoonMode == TRUE) {
                switch ($comingSoonShowSelection) {
                    case "all":
                        $media_metadata_name = 'thumb';
                        break;
                    case "unwatched":
                        $media_metadata_name = 'thumb';
                        break;
                    // case "newest":
                        // break;
                    // case "recentlyAdded":
                        // break;
                    default:
                        $media_metadata_name = 'grandparentThumb';
                }
            }
            else {
                $media_metadata_name = 'grandparentThumb';
            }
            break;
        case "movie":
            $media_metadata_name = 'thumb';
            break;
        case "track":
            $media_metadata_name = 'thumb'; // Track Thumb (Poster) (future - thumb, parentThumb (Album), grandparentThumb (Artist))
            $mediaThumb = $subElement[$media_metadata_name];

            if ($mediaThumb == '') {
                $media_metadata_name = 'parentThumb';
                $mediaThumb = $subElement[$media_metadata_name];
            }

            if ($mediaThumb == '') {
                $media_metadata_name = 'grandparentThumb';
                $mediaThumb = $subElement[$media_metadata_name];
            }
            break;
        default:
            $media_metadata_name = 'thumb';
            break;
    }

    $media_logClass = $PLEXMetadata['LogClass'];

    $rootElement = $PLEXMetadata['rootXMLData'];
    $subElement = $rootElement;
    $mediaThumb = $subElement[$media_metadata_name];

    if (empty($mediaThumb)) {
        $mediaThumb = "N/A";
    }

    $media_MetadataID_TMP = preg_split("#/#", $mediaThumb);
    $media_MetadataID = $media_MetadataID_TMP[3];
    $media_MetadataID_STR = "(metadata ID: $media_MetadataID)";

    $mediaThumb_MetadataID = $media_MetadataID;
    $PLEXMetadata['thumb'] = $mediaThumb;
    pmp_Logging("$media_logClass", "\tmediaTagline @ $mediaType ($media_metadata_name) $media_MetadataID_STR - $mediaThumb");
}

function plex_metadata_template($mediaType = "episode") {
    // Global Variables - Input
    global $PLEXMetadata;
    global $mediaTitle;

    // Template
    // switch ($mediaType) {
    //     case "episode":

    //         break;
    //     case "season":

    //         break;
    //     case "series":

    //         break;
    //     case "movie":

    //         break;
    //     default:

    // }

    // $rootElement = $PLEXMetadata['rootXMLData'];
    // $subElement = $rootElement;
    // $mediaThumb = $subElement[$media_metadata_name];
}

function plex_random_media($mediaAttempt = 0) {
    global $URLScheme, $plexServer, $comingSoonShowSelection, $plexToken;
    global $plexServerMovieSection, $plexServerMovieSections, $plexServerMovieSection_ID ;
    global $useSection, $xmlMedia, $viewGroup;

    pmp_Logging("PLEX_getMediaMetadata", "\n"); // New Line
    pmp_Logging("PLEX_getMediaMetadata", "plex_random_media (attempt): $mediaAttempt");

    $plexServerMovieSections = explode(",", $plexServerMovieSection);

    $ValidateSections = implode(",", $plexServerMovieSections);
    pmp_Logging("PLEX_getMediaMetadata", "Library (Array Scan/ReScan): $ValidateSections");

    $useSection = rand(0, count($plexServerMovieSections) - 1);
    $plexServerMovieSection_ID = $plexServerMovieSections[$useSection];
    pmp_Logging("PLEX_getMediaMetadata", "Library (ID): $plexServerMovieSection_ID");

    $MoviesURL = $URLScheme . '://' . $plexServer . ':32400/library/sections/' . $plexServerMovieSections[$useSection] . '/' . $comingSoonShowSelection . '?X-Plex-Token=' . $plexToken . '';
    pmp_Logging("PLEX_getMediaMetadata", "$comingSoonShowSelection URL: $MoviesURL");

    $getMovies = file_get_contents($MoviesURL);
    $xmlMedia = simplexml_load_string($getMovies) or die("feed not loading");

    $viewGroup = $xmlMedia['viewGroup'];
    pmp_Logging("PLEX_getMediaMetadata", "xml viewGroup: $viewGroup");

}

function plex_variable_presets($mode = "comingSoon") {
    // $topSelection_test = ${$mode . "Top"};
    // pmp_Logging("PLEX_getMediaMetadata", "GenVar: $topSelection_test");
    // $autoScaleTop = $comingSoonTopAutoScale;
    // $topColor = $comingSoonTopFontColor;
    // $topSize = $comingSoonTopFontSize;
    // $topFontEnabled = $comingSoonTopFontEnabled;
    // $topFontID = $comingSoonTopFontID;

    // $bottomSelection = $comingSoonBottom;
    // $autoScaleBottom = $comingSoonBottomAutoScale;
    // $bottomColor = $comingSoonBottomFontColor;
    // $bottomSize = $comingSoonBottomFontSize;
    // $bottomFontEnabled = $comingSoonBottomFontEnabled;
    // $bottomFontID = $comingSoonBottomFontID;

    // $mediaArt_Status = $comingSoonBackgroundArt;
    // $mediaArt_ShowTVThumb = $comingSoonShowTVThumb;
}

function plex_getMedia_thumb() {
    // Media Thumb (Poster)
    global $PLEXMetadata;
    global $URLScheme, $plexServer, $plexToken, $cachePath, $cacheEnabled; // Input Variables
    global $mediaThumb, $mediaThumb_MetadataID; // Input Variables
    global $mediaThumb_Display; // Output Variables

    $mediaThumb_Display = "";

    // Check if the cache option is enabled, and if so set the name of the saved file and store in the designated cache path.
    if ($cacheEnabled) {
        $mediaThumb = $PLEXMetadata['thumb'];
        pmp_Logging("PLEX_getMediaFile", "\nmediaThumb (RAW inCache) - $mediaThumb");
        pmp_Logging("PLEX_getMediaFile", "\nmediaThumb (inCache - readMediaType) - " . $PLEXMetadata['readMediaType']);

        $mediaThumb_ID = explode("/", $mediaThumb);
        $mediaThumb_ID = trim($mediaThumb_ID[count($mediaThumb_ID) - 1], '/');

        if ($mediaThumb_ID != "") {
            if (!isset($mediaThumb_MetadataID) || trim($mediaThumb_MetadataID) === '') {
                $mediaThumb_CacheFileName = $mediaThumb_ID . ".jpeg";
            } else {
                $mediaThumb_CacheFileName = $mediaThumb_ID . "_" . $mediaThumb_MetadataID . ".jpeg";
            }

            $mediaThumb_CacheFullName = join('/', array(trim($cachePath, '/'), trim($mediaThumb_CacheFileName, '/')));
            pmp_Logging("PLEX_getMediaFile", "Cache File @ Output (mediaThumb) - $mediaThumb_CacheFullName");

            $mediaThumb_URL = "$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken";
            pmp_Logging("PLEX_getMediaFile", "Media Thumb ID: $mediaThumb_ID ($cachePath) - $mediaThumb_URL");
        }
        else {
            pmp_Logging("PLEX_getMediaFile", "Unable to find Media Thumb information.");
        }

        // There's nothing else to do here, just save it
        if (!file_exists($mediaThumb_CacheFullName)) {
            file_put_contents("$mediaThumb_CacheFullName", fopen("$mediaThumb_URL", 'r'));
        }

        $mediaThumb_CacheURL = $mediaThumb_CacheFullName;

        $mediaThumb_Display = "url('data:image/jpeg;base64,".getCachePoster($mediaThumb_CacheURL)."')"; // Secure URL
        // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

        if ((strpos($mediaThumb_Display, "InvalidImage") !== FALSE) || ($mediaThumb_Display == "")) {
            $mediaThumb_Display = "url('$mediaThumb_CacheURL')"; // Unsecure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure) - $mediaThumb_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
            pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - Cache) - FailOver");

            if ($mediaThumb_Display == "") {
                pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - Cache) - BLANK");
            }
        }

    } else {
        $mediaThumb_Display = "url('data:image/jpeg;base64,".getPoster($mediaThumb)."')"; // Secure URL
        // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Secure) - $mediaThumb_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

        if ((strpos($mediaThumb_Display, "InvalidImage") !== FALSE) || ($mediaThumb_Display == "")) {
            $mediaThumb_Display = "url('$URLScheme://$plexServer:32400$mediaThumb?X-Plex-Token=$plexToken')"; // Unsecure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure) - $mediaThumb_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
            pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - No Cache) - FailOver");

            if ($mediaThumb_Display == "") {
                pmp_Logging("PLEX_getMediaFile", "mediaThumb (Display - Unsecure - No Cache) - BLANK");
            }
        }
    }
}

function plex_getMedia_art() {
    // Media Art (Background)
    global $URLScheme, $plexServer, $plexToken, $cacheArtPath, $cacheEnabled; // Input Variables
    global $mediaArt, $mediaArt_MetadataID; // Input Variables
    global $mediaArt_Display; // Output Variables

    $mediaArt_Display = "";

    // $mediaArt_ID, $mediaArt_CacheFileName, $mediaArt_CacheFullName, $mediaArt_URL, $mediaArt_CacheURL; // Internal Variables

    // Check if the cache option is enabled, and if so set the name of the saved file and store in the designated cache path.
    if ($cacheEnabled) {
        $mediaArt_ID = explode("/", $mediaArt);
        $mediaArt_ID = trim($mediaArt_ID[count($mediaArt_ID) - 1], '/');

        // If there is no mediaArt then the media art will be skipped, and background will revert to default.
        if (isset($mediaArt_ID) && trim($mediaArt_ID) != '') {
            if (!isset($mediaArt_MetadataID) || trim($mediaArt_MetadataID) === '') {
                $mediaArt_CacheFileName = $mediaArt_ID . ".jpeg";
            } else {
                $mediaArt_CacheFileName = $mediaArt_ID . "_" . $mediaArt_MetadataID . ".jpeg";
            }

            $mediaArt_CacheFullName = join('/', array(trim($cacheArtPath, '/'), trim($mediaArt_CacheFileName, '/')));
            pmp_Logging("PLEX_getMediaFile", "Cache File @ Output (mediaArt) - $mediaArt_CacheFullName");

            $mediaArt_URL = "$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken";
            pmp_Logging("PLEX_getMediaFile", "$mediaArt_ID ($cacheArtPath) - $mediaArt_URL");

            // There's nothing else to do here, just save it
            if (!file_exists($mediaArt_CacheFullName)) {
                file_put_contents("$mediaArt_CacheFullName", fopen("$mediaArt_URL", 'r'));
            }

            $mediaArt_CacheURL = $mediaArt_CacheFullName;

            $mediaArt_Display = "url('data:image/jpeg;base64,".getCachePoster($mediaArt_CacheURL)."')"; // Secure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

            if ((strpos($mediaArt_Display, "InvalidImage") !== FALSE) || ($mediaArt_Display == "")) {
                $mediaArt_Display = "url('$mediaArt_CacheURL')"; // Unsecure URL
                // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure) - $mediaArt_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
                pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - Cache) - FailOver");

                if ($mediaArt_Display == "") {
                    pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - Cache) - BLANK");
                }
            }
        }
    } else {
         $mediaArt_Display = "url('data:image/jpeg;base64,".getPoster($mediaArt)."')"; // Secure URL
         // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Secure) - $mediaArt_Display"); // DO NOT LOG SECURE URL - DATA UNUSABLE AND LOGS BECOME UNREADABLE

         if ((strpos($mediaArt_Display, "InvalidImage") !== FALSE) || ($mediaArt_Display == "")) {
            $mediaArt_Display = "url('$URLScheme://$plexServer:32400$mediaArt?X-Plex-Token=$plexToken')"; // Unsecure URL
            // pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure) - $mediaArt_Display"); // DO NOT LOG UNSECURE URL - DATA IS NOT ENCRYPTED
            pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - No Cache) - FailOver");

            if ($mediaArt_Display == "") {
                pmp_Logging("PLEX_getMediaFile", "mediaArt (Display - Unsecure - No Cache) - BLANK");
            }
        }
    }
}

function plex_webhook_decode() {
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables
    // global ; // Output Variables

    $plex_webhook_data_json = json_decode($plex_webhook_data_raw,true);

    plex_webhook_json_HEAD();

    plex_webhook_json_ACCOUNT();

    plex_webhook_json_SERVER();

    plex_webhook_json_PLAYER();

    plex_webhook_json_METADATA();

    pmp_Logging("PLEX_WebHookData", "$plex_webhook_data_raw");
}

function plex_webhook_json_HEAD() {
    // Head
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

    global $pwhd_event, $pwhd_user, $pwhd_owner; // Output Variables

    $pwhd_event = $plex_webhook_data_json["event"];
    $pwhd_user = $plex_webhook_data_json["user"];
    $pwhd_owner = $plex_webhook_data_json["owner"];
}

function plex_webhook_json_ACCOUNT() {
    // Account
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

    global $pwhd_Account_id, $pwhd_Account_thumb, $pwhd_Account_title; // Output Variables

    $pwhd_Account_id = $plex_webhook_data_json["Account"]["id"];
    $pwhd_Account_thumb = $plex_webhook_data_json["Account"]["thumb"];
    $pwhd_Account_title = $plex_webhook_data_json["Account"]["title"];
}

function plex_webhook_json_SERVER() {
     // Server
     global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

     global $pwhd_Server_title, $pwhd_Server_uuid; // Output Variables

     $pwhd_Server_title = $plex_webhook_data_json["Server"]["title"];
     $pwhd_Server_uuid = $plex_webhook_data_json["Server"]["uuid"];
}

function plex_webhook_json_PLAYER() {
    // Player
    global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

    global $pwhd_Player_local, $pwhd_Player_publicAddress, $pwhd_Player_title, $pwhd_Player_uuid; // Output Variables

    $pwhd_Player_local = $plex_webhook_data_json["Player"]["local"];
    $pwhd_Player_publicAddress = $plex_webhook_data_json["Player"]["publicAddress"];
    $pwhd_Player_title = $plex_webhook_data_json["Player"]["title"];
    $pwhd_Player_uuid = $plex_webhook_data_json["Player"]["uuid"];
}

function plex_webhook_json_METADATA() {
   // Metadata
   global $plex_webhook_data_raw, $plex_webhook_data_json; // Input Variables

   global $pwhd_Metadata_librarySectionType, $pwhd_Metadata_ratingKey, $pwhd_Metadata_key, $pwhd_Metadata_parentRatingKey, $pwhd_Metadata_grandparentRatingKey; // Output Variables

   $pwhd_Metadata_librarySectionType = $plex_webhook_data_json["Metadata"]["librarySectionType"];
   $pwhd_Metadata_ratingKey = $plex_webhook_data_json["Metadata"]["ratingKey"];
   $pwhd_Metadata_key = $plex_webhook_data_json["Metadata"]["key"];
   $pwhd_Metadata_parentRatingKey = $plex_webhook_data_json["Metadata"]["parentRatingKey"];
   $pwhd_Metadata_grandparentRatingKey = $plex_webhook_data_json["Metadata"]["grandparentRatingKey"];

   global $pwhd_Metadata_guid, $pwhd_Metadata_librarySectionID, $pwhd_Metadata_type, $pwhd_Metadata_title, $pwhd_Metadata_grandparentKey; // Output Variables

   $pwhd_Metadata_guid = $plex_webhook_data_json["Metadata"]["guid"];
   $pwhd_Metadata_librarySectionID = $plex_webhook_data_json["Metadata"]["librarySectionID"];
   $pwhd_Metadata_type = $plex_webhook_data_json["Metadata"]["type"];
   $pwhd_Metadata_title = $plex_webhook_data_json["Metadata"]["title"];
   $pwhd_Metadata_grandparentKey = $plex_webhook_data_json["Metadata"]["grandparentKey"];

   global $pwhd_Metadata_parentKey, $pwhd_Metadata_grandparentTitle, $pwhd_Metadata_parentTitle, $pwhd_Metadata_summary, $pwhd_Metadata_index; // Output Variables

   $pwhd_Metadata_parentKey = $plex_webhook_data_json["Metadata"]["parentKey"];
   $pwhd_Metadata_grandparentTitle = $plex_webhook_data_json["Metadata"]["grandparentTitle"];
   $pwhd_Metadata_parentTitle = $plex_webhook_data_json["Metadata"]["parentTitle"];
   $pwhd_Metadata_summary = $plex_webhook_data_json["Metadata"]["summary"];
   $pwhd_Metadata_index = $plex_webhook_data_json["Metadata"]["index"];

   global $pwhd_Metadata_parentIndex, $pwhd_Metadata_ratingCount, $pwhd_Metadata_thumb, $pwhd_Metadata_art, $pwhd_Metadata_parentThumb; // Output Variables

   $pwhd_Metadata_parentIndex = $plex_webhook_data_json["Metadata"]["parentIndex"];
   $pwhd_Metadata_ratingCount = $plex_webhook_data_json["Metadata"]["ratingCount"];
   $pwhd_Metadata_thumb = $plex_webhook_data_json["Metadata"]["thumb"];
   $pwhd_Metadata_art = $plex_webhook_data_json["Metadata"]["art"];
   $pwhd_Metadata_parentThumb = $plex_webhook_data_json["Metadata"]["parentThumb"];

   global $pwhd_Metadata_grandparentThumb, $pwhd_Metadata_grandparentArt, $pwhd_Metadata_addedAt, $pwhd_Metadata_updatedAt; // Output Variables

   $pwhd_Metadata_grandparentThumb = $plex_webhook_data_json["Metadata"]["grandparentThumb"];
   $pwhd_Metadata_grandparentArt = $plex_webhook_data_json["Metadata"]["grandparentArt"];
   $pwhd_Metadata_addedAt = $plex_webhook_data_json["Metadata"]["addedAt"];
   $pwhd_Metadata_updatedAt = $plex_webhook_data_json["Metadata"]["updatedAt"];
}

function plex_isPlaying_dataProcess() {
    // Global Variables - Input
    global $clients, $plexClient, $plexClientName;
    global $data;

    // Global Variables - Output
    global $PLEX_PlayerAddress, $PLEX_Client_ARR;
    global $PLEX_PlayerTitle, $PLEX_ClientName_ARR;
    global $PLEX_SubType;

    $PLEXMetadata_checkType = $clients['type']; // Clip (eg. B-Roll)
    pmp_Logging("PLEX_getMediaMetadata", "plex_isPlaying_dataProcess @ Type: $PLEXMetadata_checkType");

    $PLEXMetadata_checkSubtype = $clients['subtype']; // Trailer
    $PLEX_SubType = $PLEXMetadata_checkSubtype;
    pmp_Logging("PLEX_getMediaMetadata", "plex_isPlaying_dataProcess @ SubType: $PLEXMetadata_checkSubtype");
    
    switch ($PLEXMetadata_checkType) {
        case 'clip':
            break;
        case 'trailer':
            break;
        default:
            $PLEX_PlayerAddress = $clients->Player['address'];
            $PLEX_Client_ARR = preg_split("#,#", $plexClient); // Split defined client IP address(s) (coma delimited array)

            $PLEX_PlayerTitle = $clients->Player['title'];
            $PLEX_ClientName_ARR = preg_split("#,#", $plexClientName); // Split defined client name(s) (coma delimited array)

            pmp_Logging("PLEX_getMediaMetadata", "plex_isPlaying_dataProcess @ $PLEX_Client_ARR[0]");
            break;
    }
}

function plex_metadata_PROCESS() {
    // Global Variables - Input
    global $isPlaying;
    global $mediaType_Display, $elementType, $mediaType;
    global $isPlayingMode, $ComingSoonMode;

    // Global Variables - Output
    global $PLEXMetadata;

    $PLEXMetadata = []; // Variables - Future

    if ($isPlaying == TRUE) {
        $isPlayingMode = TRUE;
        $ComingSoonMode = FALSE;
    }
    else {
        $isPlayingMode = FALSE;
        $ComingSoonMode = TRUE;
    }

    plex_metadata_getMediaKeys();

    plex_metadata_base("$mediaType", "START");

    plex_metadata_title("$mediaType");
    plex_metadata_summary("$mediaType");
    plex_metadata_time("$mediaType");
    plex_metadata_tagline("$mediaType");
    plex_metadata_thumb("$mediaType", $ComingSoonMode); // COMING SOON MODE
    plex_metadata_art("$mediaType");
    plex_metadata_contentRating("$mediaType");
    plex_metadata_audioCodec("$mediaType");
    plex_metadata_audioChannelLayout("$mediaType");
    plex_metadata_videoCodec("$mediaType");
    plex_metadata_videoResolution("$mediaType");

    // if ($isPlaying == TRUE) {
        plex_metadata_decision("$mediaType", $isPlayingMode); // isPlaying Mode
        plex_metadata_audioDisplay("$mediaType", $isPlayingMode); // isPlaying Mode
        plex_metadata_videoDisplay("$mediaType", $isPlayingMode); // isPlaying Mode
    // }

    plex_metadata_base("$mediaType", "END");
}

function plex_metadata_getMediaKeys() {
    // Global Variables - Input
    global $PLEXMetadata;
    global $clients;
    global $URLScheme, $plexServer, $plexToken;

    $PLEXMetadata['rootMediaKey'] = $clients[key];
    pmp_Logging("PLEX_getMediaMetadata", "rootMediaKey @ ". $PLEXMetadata['rootMediaKey']);

    $UpdateKey = explode("/child", $PLEXMetadata['rootMediaKey']);
    $PLEXMetadata['rootMediaKey'] = $UpdateKey[0];
    pmp_Logging("PLEX_getMediaMetadata", "rootMediaKey (Updated) @ ". $PLEXMetadata['rootMediaKey']);

    $PLEXMetadata['rootMediaURL'] = "${URLScheme}://${plexServer}:32400". $PLEXMetadata['rootMediaKey'] . "?X-Plex-Token=${plexToken}";
    pmp_Logging("PLEX_getMediaMetadata", "rootMediaURL @ ". $PLEXMetadata['rootMediaURL']);

    $getXMLDataRAW = file_get_contents($PLEXMetadata['rootMediaURL']);
    $getXMLData = simplexml_load_string($getXMLDataRAW);

    if (empty($UpdateKey[1])) {
        $PLEXMetadata['readMediaType'] = "Video";
    }
    else {
        $PLEXMetadata['readMediaType'] = "Directory";
    }
    pmp_Logging("PLEX_getMediaMetadata", "readMediaType @ ". $PLEXMetadata['readMediaType']);

    if ($getXMLData->Video) {
        $PLEXMetadata['readMediaType'] = "Video";
        pmp_Logging("PLEX_getMediaMetadata", "readMediaType @ Type: Video");
    }

    if ($getXMLData->Directory) {
        $PLEXMetadata['readMediaType'] = "Directory";
        pmp_Logging("PLEX_getMediaMetadata", "readMediaType @ Type: Directory");
    }

    if ($getXMLData->Track) {
        $PLEXMetadata['readMediaType'] = "Track";
        pmp_Logging("PLEX_getMediaMetadata", "readMediaType @ Type: Track");
    }

    if ($PLEXMetadata['readMediaType'] == "") {
        pmp_Logging("PLEX_getMediaMetadata", "readMediaType @ ERROR - Read Media Type Blank");
    }
    else{
        $mediaCode = $PLEXMetadata['readMediaType'];
        pmp_Logging("PLEX_getMediaMetadata", "readMediaType @ Type (Cast): $mediaCode");
    }

    $PLEXMetadata['rootXMLData'] = $getXMLData->$mediaCode;
}

function plex_metadata_viewGroup() {
    // Global Variables - Input
    global $viewGroup, $mediaArt_ShowTVThumb;

    // Global Variables - Output
    global $mediaType_Display, $elementType, $mediaType;

    switch ($viewGroup) {
        case "movie":
            $mediaType_Display = "$viewGroup";
            $elementType = "Video";
            $mediaType = "movie";
            break;
        case "episode":
            $mediaType_Display = "$viewGroup";
            $elementType = "Video";
            $mediaType = $mediaArt_ShowTVThumb;
            break;
        case "show":
            $mediaType_Display = "$viewGroup";
            $elementType = "Directory";
            $mediaType = $mediaArt_ShowTVThumb;
            break;
        case "track":
            $mediaType_Display = "$viewGroup";
            $elementType = "Directory";
            $mediaType = "track";
            break;
        default:
            $mediaType_Display = "Unknown";
            $elementType = "Video";
            $mediaType = "movie";
            break;
    }
}

function plex_metadata_Settings() {
    // Prototype Object

    $PLEXMedia = [];
    $PLEXMedia['TestMedia'] = "value 1 2 3";

    pmp_Logging("PLEX_getMediaMetadata", "plex_metadata_Settings (TESTING): " . $PLEXMedia['TestMedia']);
}

function plex_server_Settings() {
    // Global Variables - Input
    global $plexServerSSL, $plexServerDirect, $plexToken;

    // Global Variables - Output
    global $URLScheme, $plexServer, $plexServerURL;

    // Setting SSL Prefix
    if ($plexServerSSL) {
        $URLScheme = "https";
        $plexServer = $plexServerDirect;
    }
    else {
        $URLScheme = "http";
    }

    $plexServerURL = "$URLScheme://$plexServer:32400/status/sessions?X-Plex-Token=$plexToken";
    pmp_Logging("getMediaURL", "Plex Session URL: $plexServerURL");
}

?>
