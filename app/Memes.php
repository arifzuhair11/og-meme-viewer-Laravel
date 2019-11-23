<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memes extends Model
{
    const MEMES_PER_PAGE = 9;

    protected $table = 'memes';
    protected $fillable = ['name', 'url', 'requestedCount'];

    public function incrementViewCount()
    {
      $this->requestedCount = $this->requestedCount+1;
      $this->save();
    }

    public static function whichPage($id)
    {
        $index = 0;
        $memes = Memes::orderBy('id', 'asc')->get();
        foreach ($memes as $meme) {
          if($meme->id == $id){
            break;
          }
          $index++;
        }
        $page = (int)($index / Memes::MEMES_PER_PAGE) + 1;
        return $page;
    }

    public static function byPage($page)
    {
      $id_limit = (int)($page * Memes::MEMES_PER_PAGE);
      $id_start = (int)($id_limit - Memes::MEMES_PER_PAGE) + 1;
      $collect = Memes::where('id', '>=', $id_start)
                    ->where('id', '<=', $id_limit)
                    ->get();
      return $collect;
    }
}
