<?php
/**
 * Created by Luis Landero
 */

class ComicReaderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ComicReader
     */
    private $sut;
    public function setUp()
    {
        $this->sut = new ComicReader();
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function tearDown()
    {
        $this->sut = null;
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testCreate()
    {
        $this->assertNotNull($this->sut);
        $this->assertInstanceOf('ComicReader', $this->sut);
    }

    public function testGetPaginator()
    {
        $this->getComicFakeResponse();

        $paginatorHtml = $this->sut->getPaginator();
        $this->assertEquals($this->getFakePaginatorHtml(), $paginatorHtml);
    }

    public function testDisplayComic()
    {
        $_SERVER['REQUEST_URI'] = '/comic/320';
        $this->sut->displayComic();
        $this->expectOutputString($this->getDisplayComicHtmlOutput());
    }

    private function getComicFakeResponse()
    {
        $comic = new stdClass();
        $comic->year = 2018;
        $comic->month = 12;
        $comic->day = 12;
        $comic->num = 320;

        $this->sut->comicInfo = $comic;
        $this->sut->currentComicId = 320;
    }

    private function getFakePaginatorHtml()
    {
        return <<<OET
<div id="paginate-prev"><a href="/comic/319/?prev">Prev</a></div><div id="paginate-next"><a href="/comic/321/?next">Next</a></div>
OET;
    }

    private function getDisplayComicHtmlOutput()
    {
        return <<<OET
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
            <div id="comic-title">28-Hour Day</div>
            <div id="comic-image">
                <img src="https://imgs.xkcd.com/comics/28_hour_day.png" alt="Small print: this schedule will eventually drive one stark raving mad.">
            </div>
            <div id="comic-alt">Small print: this schedule will eventually drive one stark raving mad.</div>
        </div>
        <div id="paginate">
            <div id="paginate-prev"><a href="/comic/319/?prev">Prev</a></div><div id="paginate-next"><a href="/comic/321/?next">Next</a></div>        </div>
    </div>
</body>
</html>
OET;
    }
}