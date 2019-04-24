<?php
    //------------------------------------
    // Recognize Demo Module
    // created: December 2016
    // author: Steve Rucker
    //------------------------------------

    $configs = include('../config.php');
    define('DEMO_ENV', (getenv('STAGE') ? getenv('STAGE') : 'dev'));
?>
<html>
<html lang="en">

<head>
    <title>Kairos Recognize Demo</title>   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="css/recognize.css">
    <link rel="stylesheet" href="css/recognize-mediaqueries.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.css" type="text/css"  />
</head>
<body>
    <div class="main-container container exercise-view">
        <div class="example-instructions col-md-12"><a href="" class="reset-panels">RUN TEST</a></div>
        <div class="col-xs-6 col-sm-6 col-md-6 left-image-container">
            <div class="enrolled-images-container">
                <div class="user-instructions"></div>
                <ul class="enrolled-images">
                    <li class="enrolled-image">
                        <img src="/images/team/Brian_Brackeen.jpg" crossorigin="Anonymous" />
                        <div class="image-mask" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>84.226%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/subjects/brad1.jpg" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>28.583%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/team/Rajnesah_Belyeu.jpg" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>37.351%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/team/Ben_Virdee-Chapman.jpg" crossorigin="Anonymous" />
                        <div class="image-mask" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>85.821%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/subjects/george1.jpg" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>26.268%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/team/Cole_Calistra.jpg" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>29.426%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/team/Neil_Pitts.jpg" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>57.566%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/subjects/angelina2.jpg"" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>16.633%</div>
                    </li>
                    <li class="enrolled-image">
                        <img src="/images/subjects/halle1.jpg" crossorigin="Anonymous" />
                        <div class="image-mask-unrecognized" style="display: block;"></div>
                        <div class="image-info" style="display: block;">Confidence: <br>12.894%</div>
                    </li>
                </ul>
                <div class="image-left-template"></div>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 right-image-container">
            <div class="user-instructions"></div>
            <a href="" class="show-json">SHOW JSON</a>
            <div class="canvas-container"><canvas id="displayCanvas" /></div>
            <div class="image-right-template">
                <div class="header-bkg-right"></div>
                <div class="message-container">
                    <div class="message">RECOGNIZED</div>
                </div>
            </div>
            <div class="recognize-image-container"></div>
            <div class="right-image-example">
                <img src="/images/kairos_team.jpg" />
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 json-response-container">
            <a href="" class="hide-json">HIDE JSON</a>
            <button class="copy-json-button btn btn-primary" data-clipboard-action="copy" data-clipboard-target=".json-response">COPY</button>
            <div class="json-response"><pre></pre></div>
        </div>
        <div class="row options-panel col-md-12">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h4>Options</h4>
                <div class="form-group">
                    <label class="control-label" for="optionMinHeadScale">minHeadScale:</label><span class="prompt">Enter a value between .015 (1:64 scale) and .5 (1:2 scale)</span>
                    <input class="form-control" type="text" name="optionMinHeadScale" id="optionMinHeadScale" value=".015"><span class="option-error-minheadscale"></span>
                    <div class="minheadscale-slider"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="optionThreshold">Threshold:</label>
                    <a href="" data-featherlight="images/threshold_scores.png"><i class="glyphicon glyphicon-question-sign"></i></a>
                    <span class="prompt">Enter a value between .2 and .8</span>
                    <input class="form-control" type="text" name="optionThreshold" id="optionThreshold" value=".2"><span class="option-error-threshold"></span>
                    <div class="threshold-slider"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="optionMaxNumResults">Max Num Results:</label>
                    <span class="prompt max-num-prompt"></span>
                    <input class="form-control" type="text" name="optionMaxNumResults" id="optionMaxNumResults" value="1"><span class="option-error-maxnumresults"></span>
                    <div class="maxnumresults-slider"></div>
                </div>
                <div class="payload-display">Payload: <span></span></div>
            </div>
        </div>
        <div class="col-md-12 ui-buttons">
            <div class="upload col-xs-6 col-sm-6 col-md-6">
                <form method="post" enctype="multipart/form-data" id="mediaUploadForm-left" class="enroll-form"> 
                    <div class="upload-button btn btn-kairos">UPLOAD<input type="file" id="enrollImage" name="enrollImage"></div>
                </form>
                <div id="uploadErrorLeft"></div>
            </div>
            <div class="step-two-prompt"><span>STEP 2:</span> Upload an image to match it against images that you have enrolled.</div>
            <div class="upload col-xs-6 col-sm-6 col-md-6">
                <form method="post" enctype="multipart/form-data" id="mediaUploadForm-right" class="recognize-form"> 
                    <div class="upload-button btn btn-kairos">UPLOAD<input type="file" id="recognizeImage" name="recognizeImage"></div>
                </form>
                <div id="uploadErrorRight"></div>
            </div>
        </div>
    </div>  

    <script id="image-left-template" type="text/x-handlebars-template">
        <div class="header-bkg-left"></div>
        <div class="message-container">
            {{#if spinner}}
                <div class="processing-spinner"></div>
                <div class="spinner-message">{{message}}</div>
            {{else}}
                <div class="message">{{message}}</div>
            {{/if}}
        </div>
    </script>
    <script id="image-right-template" type="text/x-handlebars-template">
        <div class="header-bkg-right"></div>
        <div class="message-container">
            {{#if spinner}}
                <div class="processing-spinner"></div>
                <div class="spinner-message">{{message}}</div>
            {{else}}
                <div class="message">{{message}}</div>
            {{/if}}
        </div>
        {{#if response}}
            <div class="recognize-response"></div>
        {{/if}}
    </script>
          

    <!-- hosted libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="https://cdn.rawgit.com/noelboss/featherlight/1.7.1/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

    <!-- custom libraries -->
    <script src="../js/utils.js"></script>
    <script src="js/recognizeDemoApp.js"></script>
    <script src="js/recognizeUi.js"></script>
    <script src="js/jsonData.js"></script>
    <script src="../js/exif.js"></script>
    <script src="../js/transparentImageData.js"></script>

    <!-- initialize custom libraries if API credentials are valid -->
    <?php
        if (
            (defined("APP_ID") && APP_ID != "") &&
            (defined("APP_KEY") && APP_KEY != "") &&
            (defined("API_URL") && API_URL != "")
        ) {
    ?>
        <script>
            recognizeDemoApp.init({
                "uploadFileSizeImage":<?php echo $configs["uploadFileSizeImage"] ?>,
                "uploadFileTypesImage":<?php echo $configs["uploadFileTypesImage"] ?>,
                "apiCredentials":true
            });
        </script>
    <?php
        }
        else {
    ?>
        <script>
            recognizeDemoApp.init({
                "apiCredentials":false
            });
        </script>
    <?php  
        }
    ?>

</body>

</html>

