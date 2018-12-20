<?php
/**
 * Created by Luis Landero.
 * Date: 12-19-18
 * Time: 08:28 PM
 */

require_once 'vendor/autoload.php';

class ComicReader
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient = null;

    public $comicInfo;

    public function __construct()
    {
        if(is_null($this->httpClient)) {
            $this->httpClient = new \GuzzleHttp\Client();
        }
    }

    private function getTodayWebComic()
    {
        $webcomic = $this->httpClient->request('GET', 'https://xkcd.com/info.0.json');
        return $webcomic->getBody();
    }

    public function displayComic()
    {
        $comicInfo = $this->getTodayWebComic();
        $this->comicInfo = json_decode($comicInfo);
        include_once 'src/templates/display_comic.html.php';
    }
}