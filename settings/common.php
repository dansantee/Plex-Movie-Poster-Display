<?php
//For feedback, suggestions, or issues please visit https://www.mattsshack.com/plex-movie-poster-display/
include_once('../assets/plexmovieposter/loginCheck.php');
include_once '../config.php';
include_once '../assets/plexmovieposter/CommonLib.php';
// include_once '../assets/plexmovieposter/tools.php';
include_once '../assets/plexmovieposter/CacheLib.php';
include_once '../assets/plexmovieposter/setData.php';

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
    <script> ShowHideSideBar(); </script>
</head>

<body>
    <div id="plex" class="application">
        <div class="background-container">
            <div class="settings-core"></div>
        </div>
        <?php NavBar() ;?>
        <div id="content" class="scroll-container dark-scrollbar">
            <div class="FullPage-container-17Y0cs">
                <?php sidebarInfo(basename(__FILE__)) ;?>
                <div class="Page-page-aq7i_X Scroller-scroller-3GqQcZ Scroller-vertical-VScFLT  ">
                    
                    <div id="MainPage" class="SettingsPage-content-1vKVEr PageContent-pageContent-16mK6G">
                        <h2 class="SettingsPageHeader-header-1ugtIL">
                            Common Configuration
                        </h2>
                        <?php AdvancedBar() ;?>
                        <form id="server-settings-form" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                            <!-- SEGMENT BLOCK START -->
                                <div class="form-group">
                                    <!-- Poster Transition/Refresh Speed: &nbsp;
                                    <input type="text" id="pmpImageSpeed" name="pmpImageSpeed" class="form-control fieldInfo-xsmall form-inline" value="<?php echo $pmpImageSpeed; ?>" required>
                                     &nbsp; Seconds -->

                                    <!-- <p class="help-block">
                                            Seconds
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <!-- Bottom Scrolling Text: &nbsp;
                                    <select id="pmpBottomScroll" name="pmpBottomScroll">
                                        <option value="Disabled" <?php if ($pmpBottomScroll == 'Disabled') { echo "selected"; } ?>>
                                            Disabled
                                        </option>
                                        <option value="Enabled" <?php if ($pmpBottomScroll == 'Enabled') { echo "selected"; } ?>>
                                            Enabled
                                        </option>
                                    </select> -->

                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    Cache Images: &nbsp;
                                    <label class="switch">
                                    <input type="checkbox" name="cacheEnabled" id="cacheEnabled" value="1" <?php if ($cacheEnabled) echo " checked"?>>
                                    <span class="slider round"></span>
                                    </label>
                                    <!-- <p class="help-block">
                                    </p> -->
                                </div>

                                <div class="form-group">
                                    <hr>
                                    <h3>Cache Configuration</h3>
                                    <?php CacheConfig_Display(); ?>
                                </div>
                            <!-- SEGMENT BLOCK END -->

                            <!-- GHOST BLOCK START -->
                                <?php ghostData(basename(__FILE__)) ;?>
                            <!-- GHOST BLOCK END -->

                            <!-- SUBMIT BLOCK START -->
                                <?php submitForm(FALSE); ?>
                            <!-- SUBMIT BLOCK END -->
                        </form>
                        <?php FooterInfo() ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php safariJSSide(); ?>
</body>
</html>
