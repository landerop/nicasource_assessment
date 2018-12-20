<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XKCD Assessment - NicaSource</title>
</head>
<body>

<div id="title"><?php echo $this->comicInfo->title;?></div>
<div id="comic">
    <img src="<?php echo $this->comicInfo->img?>" alt="<?php echo $this->comicInfo->alt?>">
    <p><?php echo $this->comicInfo->alt?></p>
</div>
</body>
</html>