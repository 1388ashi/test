<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Modules\Post\Database\Factories\PostFactory;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'quantity',
        'price',
        'discount',
        'discount_type',
        'created_at',
        'updated_at',
        'status',
    ];
    // public function category(): BelongsTo{
    //     return $this->belongsTo(Category::class);
    // }
    //start media-library
    protected $with = ['media'];

    protected $hidden = ['media'];

    protected $appends = ['image'];

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('post_images')->singleFile();
    }

    protected function image(): Attribute
    {
        $media = $this->getFirstMedia('product_images');

        return Attribute::make(
            get: fn () => [
                'id' => $media?->id,
                'url' => $media?->getFullUrl(),
                'name' => $media?->file_name
            ],
        );
    }
    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addImage(UploadedFile $file): bool|\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        return $this->addMedia($file)->toMediaCollection('post_images');
    }
    public function uploadFiles(Request $request): void{

        $this->uploadImage($request);
    }
    public function uploadImage(Request $request): void
    {
        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $this->addImage($request->file('image'));
            }
        } catch (FileDoesNotExist $e) {
            Log::error('post upload file (FileDoesNotExist): ' . $e->getMessage());
        }catch (FileIsTooBig $e) {
            Log::error('post upload file (FileIsTooBig): ' . $e->getMessage());
        }
    }
    //End media-library
}
