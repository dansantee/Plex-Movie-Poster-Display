<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include '../assets/plexmovieposter/CommonLib.php';
include '../assets/plexmovieposter/setData.php';
include '../config.php';

//Save Configuration
if (!empty($_POST['saveConfig'])) {
    setData(basename(__FILE__));
}

?>

<!doctype html>
<html lang="en">
<head>
    <?php HeaderInfo(basename(__FILE__)); ?>
    <script> ShowHideAdvanced(); </script>
</head>

<body class="bg-light">
    <div id="plex" class="application">
        <div class="background-container">
            <div class="FullPage-container-17Y0cs">
                <div>
                    <div style="position: absolute; width: 100%; height: 100%;">
                        <div class=" CrossFadeImage-crossFade-10Sndv" style="position: absolute; animation-duration: 600ms; background-image: url(&quot;/../assets/images/Plex/backgrounds/preset-dark.png&quot;); width: 100%; height: 100%; background-size: cover; background-position: center center; background-repeat: no-repeat;"></div>
                    </div>
                    <div style="position: absolute; width: 100%; height: 100%; background: url(&quot;/../assets/images/Plex/backgrounds/noise.png&quot;); z-index: 2;"></div>
                </div>
            </div>
        </div>
        <?php NavBar() ;?>
        <div id="content" class="scroll-container dark-scrollbar">
            <div class="FullPage-container-17Y0cs">
                <div class="Measure-container-3yONEe">
                    <?php sidebarInfo(basename(__FILE__)) ;?>
                </div>
                <div class="Page-page-aq7i_X Scroller-scroller-3GqQcZ Scroller-vertical-VScFLT  ">
                    <div id="MainPage" class="SettingsPage-content-1vKVEr PageContent-pageContent-16mK6G">
                        <h2 class="SettingsPageHeader-header-1ugtIL">
                            Client Configuration
                        </h2>
                        <div>
                        <div class="server-settings-container show-advanced">
                            <div class="filter-bar">
                                <div class="filter-bar-right">
                                    <input class="toggle-advanced-btn btn btn-sm btn-default advanced-settingButton" type="button" value="SHOW ADVANCED"></input>
                                </div>
                            </div>
                        </div>
                            <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                                <!-- SEGMENT BLOCK START -->
                                    <div class="form-group">
                                        Plex Client IP:&nbsp;

                                        <input type="text" style="display: inline;" class="fieldInfo-ipaddress form-control" id="plexClient" name="plexClient" maxlength="15"
                                            placeholder="Plex Client IP" value="<?php echo $plexClient; ?>" required>

                                        <!-- <p class="help-block">
                                        </p> -->

                                        <div class="invalid-feedback" style="width: 100%;">
                                            A Plex client IP address is required.
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        Plex Client Name:&nbsp;

                                        <input type="text" style="display: inline;" class="fieldInfo-xlarge form-control" id="plexClientName" name="plexClientName"
                                            placeholder="Plex Client Name" value="<?php echo $plexClientName; ?>">

                                        <!-- <p class="help-block">
                                        </p> -->
                                    </div>
                                <!-- SEGMENT BLOCK END -->

                                <!-- GHOST BLOCK START -->
                                    <?php ghostData(basename(__FILE__)) ;?>
                                <!-- GHOST BLOCK END -->

                                <div class="form-footer">
                                    <!-- <button name="saveConfig" class="submit-btn btn btn-lg btn-primary btn-loading disabled" type="submit" value="saveConfig"> -->
                                    <button name="saveConfig" class="submit-btn btn btn-lg btn-primary btn-loading " type="submit" value="saveConfig">
                                        <div class="loading loading-sm"></div>
                                        <span class="btn-label">SAVE CHANGES</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
