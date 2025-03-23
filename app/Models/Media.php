<?php
// Based on: https://gist.github.com/danielme85/5f899b36e29e7192762f8b406fc3997f
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
  protected $table = 'media';

  /**
   * Save file based on form data and store attributes to this model.
   *
   * @param Request $request
   * @return bool
   */
  function saveImage(Request $request)
  {
    $file = $request->file('file');
    $this->original_filename = $file->getClientOriginalName();
    $this->size = $file->getSize();
    $this->path = $file->store('media/img/original', ['disk' => 'public']);
    $this->filename = basename($this->path);
    $this->type = 'image';
    $this->mime_type = Storage::mimeType($this->path);

    if ($this->path && $this->filename) {
      if ($this->save()) {
        return true;
      }
    }
    return false;
  }


  /**
   * Send image to be optimized by TinyPNG, store result and set model attributes.
   *
   * @return bool
   */
  function optimizeImage()
  {
    \Tinify\setKey(env('TINY_KEY'));
    $file = Storage::get($this->path);
    if ($file) {
      //optimize original size
      try {
        $newfile = \Tinify\fromBuffer($file);
        $resized = $newfile->resize(array(
          "method" => "cover",
          "width" => 300,
          "height" => 300
        ));
        $comp = $resized->toBuffer();
        if ($comp && $this->filename) {
          $savepath = "media/img/optimized/$this->filename";
          if (Storage::put($savepath, $comp)) {
            $this->optimized_size = Storage::size($savepath);
            $this->optimized_path = $savepath;
          }
        }
      } catch (\Tinify\AccountException $e) {
        Log::alert($e->getMessage());
        return false;
      }
      //optimize to smaller
      // try {
      //   $newfile = \Tinify\fromBuffer($file);
      //   $resized = $newfile->resize(array(
      //     "method" => "scale",
      //     "width" => 400
      //   ));
      //   $comp = $resized->toBuffer();
      //   if ($comp && $this->filename) {
      //     $savepath = "media/img/optimized/small/$this->filename";
      //     if (Storage::put($savepath, $comp)) {
      //       $this->optimized_small_size = Storage::size($savepath);
      //       $this->optimized_small_path = $savepath;
      //       if ($this->save()) {
      //         return true;
      //       }
      //     }
      //   }
      // } catch (\Tinify\AccountException $e) {
      //   Log::alert($e->getMessage());
      //   return false;
      // }
      if ($this->save()) {
        return true;
      }
    }
    return false;
  }

  /**
   * Get image, default to original if optimized not there
   * @return string
   */
  public function getImagePath()
  {
    return $this->optimized_path ?? $this->path;
  }

  /**
   * Get small image, default to original if optimized not there
   * @return string
   */
  public function getSmallImagePath()
  {
    return $this->optimized_small_path ?? $this->optimized_path ?? $this->path;
  }

  /**
   * File size mutator
   * @return string
   */
  public function getSizeAttribute()
  {
    return $this->bytesToHuman($this->size);
  }

  /**
   * File size mutator
   * @return string
   */
  public function getOptimizedSizeAttribute()
  {
    return $this->bytesToHuman($this->optimized_size);
  }

  /**
   * File size mutator
   * @return string
   */
  public function getOptimizedSmallSizeAttribute()
  {
    return $this->bytesToHuman($this->optimized_small_size);
  }

  /**
   * @param $bytes
   * @return string
   */
  private function bytesToHuman($bytes)
  {
    $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
    for ($i = 0; $bytes > 1024; $i++) {
      $bytes /= 1024;
    }
    return round($bytes, 2) . ' ' . $units[$i];
  }
}
