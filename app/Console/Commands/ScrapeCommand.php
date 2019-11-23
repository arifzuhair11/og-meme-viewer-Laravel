<?php

namespace App\Console\Commands;

use App\Memes;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\CssSelector;
use Symfony\Component\DomCrawler\Crawler;


class ScrapeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meme-scraper:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $client = new Client();
      for ($page=1; $page <= 92 ; $page++) {
        $res = $client->request('GET', 'https://interview.agsmartit.com/index.php?page='.$page);
        $html = ''.$res->getBody();
        $crawler = new Crawler($html);
        $crawler->filter('div.col-xs-6')->each(function (Crawler $node, $i){

          $meme = new Memes();

            $meme->name = $node->filter('div.meme-name')->text();
            $meme->url = $node->filter('img')->attr('src');

          $meme->save();

        }); // ends crawler

      } // ends for loop
      printf("Crawler is finished");

    }
}
