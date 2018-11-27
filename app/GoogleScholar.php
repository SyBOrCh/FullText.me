<?php

namespace App;

use Zttp\Zttp;

class GoogleScholar
{
    public $author;
    public $title;
    public $date;
    public $doi;
    
    protected $hasResults = false;

    protected $regex = '/<h3\sclass="gs_rt".*>.*<a.*href="(.+?)"\s/';

    public function __construct($author = '', $title = '', $date = '')
    {
        $this->author = $author;
        $this->title = $title;
        $this->date = $date;
    }

    protected function url()
    {
        return "https://scholar.google.com/scholar?as_q=&as_epq=&as_oq=&as_eq=&as_occt=any&as_sauthors={$this->author}&as_publication={$this->title}&as_ylo={$this->date}&as_yhi={$this->date}";
    }

    public function search()
    {
        $response = Zttp::get($this->url())->body();
        
        $this->match($response);

        return $this;
    }

    public function hasResults()
    {
        return !empty($this->doi);
    }

    protected function match($response)
    {
        preg_match($this->regex, $response, $url);

        if (empty($url)) {
          return;
        }

        $doiRegex = '/(10[.][0-9]{4,}(?:[.][0-9]+)*\/(?:(?!["&\'<>])\S)+)/';
        preg_match($doiRegex, $url[1], $doi);

        if (empty($doi)) {
          return;
        }
        
        $this->doi = $doi[1];

        return true;
    }
}
