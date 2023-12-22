<?php

declare(strict_types=1);

namespace Modules\Media\Models;

// use Modules\Tag\Models\Traits\HasTagTrait; //usiamo spatie tags

/**
 * Modules\Media\Models\Video.
 *
 * @property int                             $id
 * @property string                          $title
 * @property string                          $original_name
 * @property string                          $disk
 * @property string                          $path
 * @property \Illuminate\Support\Carbon|null $converted_for_downloading_at
 * @property \Illuminate\Support\Carbon|null $converted_for_streaming_at
 * @property int|null                        $adult
 * @property string|null                     $backdrop_path
 * @property string|null                     $original_language
 * @property string|null                     $original_title
 * @property string|null                     $overview
 * @property string|null                     $popularity
 * @property string|null                     $poster_path
 * @property string|null                     $release_date
 * @property int|null                        $video
 * @property string|null                     $vote_average
 * @property int|null                        $vote_count
 * @property string|null                     $created_by
 * @property string|null                     $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null                     $url
 * @property string|null                     $guid
 * @property string|null                     $status
 * @property mixed|null                      $info
 *
 * @method static \Modules\Media\Database\Factories\VideoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video    newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video    query()
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereBackdropPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereConvertedForDownloadingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereConvertedForStreamingAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereGuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereOriginalLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereOriginalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    wherePosterPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereVoteAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video    whereVoteCount($value)
 *
 * @mixin \Eloquent
 */
class Video extends BaseModel {
    // use HasTagTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id', 'adult', 'backdrop_path', 'original_language', 'original_name',
        'overview', 'popularity', 'poster_path', 'release_date', 'title', 'video',
        'vote_average', 'vote_count',
        'url', 'status', 'info',
    ];

    protected $dates = [
        'converted_for_downloading_at',
        'converted_for_streaming_at',
    ];

    protected $guarded = [];
}

/*
    "adult" => false
    "backdrop_path" => "/tutaKitJJIaqZPyMz7rxrhb4Yxm.jpg"
    "genre_ids" => array:4 [▶]
    "id" => 438695
    "original_language" => "en"
    "original_title" => "Sing 2"
    "overview" => "Buster and his new cast now have their sights set on debuting a new show at the Crystal Tower Theater in glamorous Redshore City. But with no connections, he an ▶"
    "popularity" => 8721.933
    "poster_path" => "https://image.tmdb.org/t/p/w500/aWeKITRFbbwY8txG5uCj4rMCfSP.jpg"
    "release_date" => "2021-12-01"
    "title" => "Sing 2"
    "video" => false
    "vote_average" => 7.5
    "vote_count" => 244
    "url" => "https://www.youtube.com/watch?v=wo2myV-7la4"
 */
