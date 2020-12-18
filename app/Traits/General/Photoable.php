<?php

namespace App\Traits\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tenants\Setting\Photo;
use Intervention\Image\Image;

trait Photoable
{
    protected  $storage_path;
    protected  $directory_name;

    /**
     * SaveImage constructor.
     */
    public function __construct()
    {
        $this->directory_name = strtolower(class_basename(get_class($this))) . 's';
        $this->storage_path = 'app/public/' . $this->directory_name;
    }

    public function photos()
    {

        return $this->morphMany(Photo::class, 'photoable');
    }

    public function createStorageDirectory()
    {
        $path = storage_path($this->storage_path) . '/' . $this->id;

        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }
        return $path;
    }

    public function saveImage($image, $name)
    {
        $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];

        if ($extension === 'jpeg') {
            $extension = 'jpg';
        };

        $imageName = $name . '.' . $extension;

        $imagePath = $this->createStorageDirectory() . '/';

        Image::make($image)->resize(800, 600)->save($imagePath . $imageName);

        return ['name' => $name, 'url' => $this->imageUrl($imageName)];
    }

    public function imageUrl($name)
    {
        return asset('storage/' . $this->directory_name . '/' . $this->id . '/' . $name);
    }

    public function addPhoto($data)
    {
        $photo = new Photo();

        foreach ($data as $key => $value) {
            $photo[$key] = $value;
        }
        $this->photos()->save($photo);
    }
    public function createAvatar()
    {
        $name = $this->gender === 'male' ? 'avatar.png' : 'avatar_f.png';
        $this->addPhoto([
            'name' => 'profile.png',
            'url' => Storage::url('images/' . $name),
            'type' => 'profile',
            'catigory' => 'avatar',
            'description' => 'default profile avatar',
        ]);
    }

    /**
     *  Clean string
     *  Replaces all spaces with underscore.
     *  Removes special chars.
     * @param string $string [the string to be cleaned]
     * @return string|string[]|null [type]  [replaced string ]
     */
    public function clean($string)
    {
        $string = str_replace(' ', '_', $string); // Replaces all spaces with underscore.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }


}