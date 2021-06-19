<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\MediaInfo;

/**
 * @property integer $media_id
 * @property string $width
 * @property string $height
 * @property string $aspect_ratio
 * @property string $orientation
 * @property string $duration
 * @property string $created_at
 * @property string $updated_at
 * @property Media $medium
 */
class MediaProperty extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media_property';

    /**
     * @var array
     */
    protected $fillable = ['media_id', 'width', 'height', 'aspect_ratio', 'orientation', 'duration'];

    /**
     * @return BelongsTo
     */
    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id', 'media_id');
    }

    /**
     * Get file aditional data
     * @param $mediaFileFullPath string
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     */
    public static function getMediaMetaData($mediaFileFullPath)
    {
        $info = [];

        $mediaInfo = new MediaInfo();
        $mediaInfoContainer = $mediaInfo->getInfo($mediaFileFullPath);

        $videoInfo = $mediaInfoContainer->getVideos();
        $imagesInfo = $mediaInfoContainer->getImages();
        $audioInfo = $mediaInfoContainer->getAudios();

        if (($videoInfo && $audioInfo) || $videoInfo) {
            foreach ($videoInfo as $video) {
                $info['is_video'] = true;
                $info['is_image'] = false;
                $info['is_audio'] = false;
                $info['format'] = $video->get('format')->getShortName();
                $info['duration'] = $video->get('duration')->getMilliseconds();
                $info['height'] = $video->get('height')->getAbsoluteValue();
                $info['width'] = $video->get('width')->getAbsoluteValue();
            }
        } elseif ($audioInfo) {
            foreach ($audioInfo as $audio) {
                $info['is_video'] = false;
                $info['is_image'] = false;
                $info['is_audio'] = true;
                $info['format'] = $audio->get('format')->getShortName();
                $info['duration'] = $audio->get('duration')->getMilliseconds();
                $info['height'] = null;
                $info['width'] = null;
            }
        } elseif ($imagesInfo) {
            foreach ($imagesInfo as $image) {
                $info['is_video'] = false;
                $info['is_image'] = true;
                $info['is_audio'] = false;
                $info['format'] = $image->get('format')->getShortName();
                $info['duration'] = null;
                $info['height'] = $image->get('height')->getAbsoluteValue();
                $info['width'] = $image->get('width')->getAbsoluteValue();
            }
        }

        return $info;
    }
}
