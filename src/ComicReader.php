<?php
/**
 * Created by Luis Landero.
 */

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
        if (is_null($this->httpClient)) {
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
        if (is_numeric($serverRequest[2])) {
            $comicInfo = $this->getWebComicById($serverRequest[2]);
            if (!$comicInfo) {
                //this conditional is to see if the href clicked was the previous or next, e.g:
                // comic 405 url should return comic 403 if you click previous
                // comic 403 url should return comic 405 if you click next
                if (isset($_GET['prev'])) {
                    header('Location: /comic/'.($serverRequest[2]-1).'/?prev');
                } else {
                    header('Location: /comic/'.($serverRequest[2]+1).'/?next');
                }
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
    public function renderFooter()
    {
        //Since the comic response doesn't provide any info about the last comic, we call this simple routine
        $isLast = $this->isLastWebComic();

        $fillPrevious = 'btn-default';
        if($isLast) {
            $fillPrevious = 'btn-warning btn-fill';
        }

        $fillNext = 'btn-default';
        if($this->currentComicId == 1) {
            $fillNext = 'btn-warning btn-fill';
        }

        $paginatorString = '';
        if ($this->currentComicId > 1) {
            $paginatorString .= '<div class="pull-left"><a href="/comic/'.($this->currentComicId - 1).'/?prev" class="btn btn-next '.$fillPrevious.' btn-wd">Previous</a></div>';
        }
        if (!$isLast) {
            $paginatorString .= '<div class="pull-right"> <a href="/comic/' . ($this->currentComicId + 1) . '/?next" class="btn btn-previous '.$fillNext.' btn-wd">Next</a>  </div>';
        }
        $paginatorString .= '<div class="clearfix"></div>';

        return $paginatorString;
    }

    /**
     * it checks if a comic is the lastone, based on a simple condition that tries to bring next day's webcomic and the day
     * after, based on the current webcomic
     * @return bool
     */
    private function isLastWebComic()
    {
        return (!$this->getWebComicById($this->comicInfo->num + 1)  &&
        !$this->getWebComicById($this->comicInfo->num + 2));
    }
}