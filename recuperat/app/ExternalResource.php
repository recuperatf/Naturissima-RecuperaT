<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalResource extends Model
{
    protected $guarded = ['id'];
    static public function findResourceByType($keyword, $title, $author, $subject) {
        $returnQuery = self::query();
        $keyword = strtolower($keyword);
        if ($keyword) {
            $returnQuery->whereRaw("LOWER(name) like '%$keyword%'")
                // ->orWhereHas('keywords', function($query)  use ($keyword) {
                //     $query->whereRaw("LOWER(keywords.name) like '%$keyword%'");
                // })
                ->orWhereRaw("LOWER(creator) like '%$keyword%'")
                ->orWhereRaw("LOWER(description) like '%$keyword%'");
        }
        if ($title) {
            $returnQuery = $returnQuery->whereRaw("LOWER(name) like '%$title%'");
        }
        if ($author) {
            $returnQuery = $returnQuery->whereRaw("LOWER(creator) like '%$author%'");
        }
        if ($subject) {
            $returnQuery = $returnQuery->whereRaw("LOWER(description) like '%$subject%'");
        }
        return $returnQuery->get();
    }
}
