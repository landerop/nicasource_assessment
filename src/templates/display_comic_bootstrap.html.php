<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="/src/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="/src/assets/img/favicon.png" />
    <title>Paper Bootstrap Wizard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS Files -->
    <link href="/src/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/src/assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/src/assets/css/demo.css" rel="stylesheet" />
    <link href="/src/assets/nicasource.css" media="all" rel="stylesheet" type="text/css" />

    <!-- Fonts and Icons -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="/src/assets/css/themify-icons.css" rel="stylesheet">
</head>

<body>
<div class="image-container set-full-height" style="background-image: url('/src/assets/img/paper-1.jpeg')">
    <!--   Creative Tim Branding   -->
    <a href="http://creative-tim.com">
        <div class="logo-container">
            <div class="logo">
                <img src="/src/assets/img/new_logo.png">
            </div>
            <div class="brand">
                Creative Tim
            </div>
        </div>
    </a>

    <!--  Made With Paper Kit  -->
    <a href="http://demos.creative-tim.com/paper-kit?ref=paper-bootstrap-wizard" class="made-with-pk">
        <div class="brand">PK</div>
        <div class="made-with">Made with <strong>Paper Kit</strong></div>
    </a>

    <!--   Big container   -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">

                <!--      Wizard container        -->
                <div class="wizard-container">

                    <div class="card wizard-card" data-color="blue" id="wizardProfile">
                        <div id="comic">
                            <div id="comic-title"><?php echo $this->comicInfo->title?></div>
                            <div id="comic-image">
                                <img src="<?php echo $this->comicInfo->img?>" alt="<?php echo $this->comicInfo->alt?>">
                            </div>
                            <div id="comic-alt"><?php echo $this->comicInfo->alt?></div>
                        </div>

                        <div class="wizard-footer">
                            <?php echo $this->getPaginator(); ?>
                        </div>

                    </div>
                </div> <!-- wizard container -->
            </div>
        </div><!-- end row -->
    </div> <!--  big container -->

    <div class="footer">
        <div class="container text-center">
            Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/paper-bootstrap-wizard">here.</a>
        </div>
    </div>
</div>

</body>

<!--   Core JS Files   -->
<script src="/src/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="/src/assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
<script src="/src/assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>
