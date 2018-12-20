<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/src/assets/nicasource.css" media="all" rel="stylesheet" type="text/css" />
    <title>XKCD Assessment - NicaSource</title>
</head>
<body>
    <div id="main">
        <div id="comic">
            <div id="comic-title"><?php echo $this->comicInfo->title?></div>
            <div id="comic-image">
                <img src="<?php echo $this->comicInfo->img?>" alt="<?php echo $this->comicInfo->alt?>">
            </div>
            <div id="comic-alt"><?php echo $this->comicInfo->alt?></div>
        </div>
        <div id="paginate">
            <?php echo $this->getPaginator(); ?>
        </div>
    </div>
</body>
</html>