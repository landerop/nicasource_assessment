<?php
/**
 * Created by Luis Landero.
 */
Use Carbon\Carbon;

require_once 'src/Router.php';
require_once 'vendor/autoload.php';

class ComicReader extends Router
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient = null;

    public $comicInfo;

    public $currentComicId = 0;

    public $isTodayWebcomic = false;

    public function __construct()
    {
        if(is_null($this->httpClient)) {
            $this->httpClient = new \GuzzleHttp\Client();
        }
    }

    /**
     * It retrieves today's webcomic and it will return false if no webcomic available
     */
    private function getTodayWebComic()
    {
        $webComic = $this->httpClient->request('GET', 'https://xkcd.com/info.0.json');
        return $webComic->getBody();
    }

    /*
     * It retrieves webcomic based on the id
     */
    private function getWebComicById($webComicId)
    {
        try {
            $webComic = $this->httpClient->request('GET', 'https://xkcd.com/'.$webComicId.'/info.0.json');
            return $webComic->getBody();
        } catch (\GuzzleHttp\Exception\RequestException $exception) {
            if ($exception->getCode() == '404') {
                return false;
            }
        }
    }

    /**
     * it receives the request and renders the template
     */
    public function displayComic()
    {
        $serverRequest = $this->getRequest();

        if(is_numeric($serverRequest[2])) {
            $comicInfo = $this->getWebComicById($serverRequest[2]);
            if(!$comicInfo) {
                header('Location: /comic/'.($serverRequest[2]+1));
            }
        }
        else {
            $comicInfo = $this->getTodayWebComic();
        }


        $this->comicInfo = json_decode($comicInfo);

        $this->currentComicId = $this->comicInfo->num;

        include_once 'src/templates/display_comic.html.php';
    }

    /**
     * builds the paginator based on some conditions, called inside the template
     * @return string
     */
    public function getPaginator()
    {
        $isLast = false;
        $today = Carbon::now();
        $comicDate = Carbon::create($this->comicInfo->year, $this->comicInfo->month, $this->comicInfo->day);
        $comicDateDiffToday = $today->diffInDays($comicDate);

        //it checks if the given comic's date is less or iqual to 1 day, meaning it's the last
        if($comicDateDiffToday == 0 || $comicDateDiffToday == 1) {
            $isLast = true;
        }

        $paginatorString = '';
        if($this->currentComicId > 1) {
            $paginatorString .= '<div id="paginate-prev"><a href="/comic/'.($this->currentComicId - 1).'">Prev</a></div>';
        }
        if(!$isLast) {
            $paginatorString .= '<div id="paginate-next"><a href="/comic/' . ($this->currentComicId + 1) . '">Next</a></div>';
        }

        return $paginatorString;
    }
}