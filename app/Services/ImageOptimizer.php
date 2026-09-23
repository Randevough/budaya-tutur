<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ImageOptimizer
{
    /**
     * Target dimensions for responsive shared-hosting editorial assets.
     */
    public const MAX_COVER_WIDTH = 1280;
    public const MAX_COVER_HEIGHT = 720;
    public const THUMBNAIL_WIDTH = 480;
    public const THUMBNAIL_HEIGHT = 270;
    public const WEBP_QUALITY = 82;

    /**
     * Optimize an uploaded image and create a lightweight thumbnail.
     *
     * @param string $relativeStoragePath e.g. 'covers/sample.jpg'
     * @return string Normalized relative storage path
     */
    public static function optimizeCoverImage(string $relativeStoragePath): string
    {
        $fullPath = storage_path('app/public/' . ltrim($relativeStoragePath, '/'));

        if (! file_exists($fullPath) || ! extension_loaded('gd')) {
            return $relativeStoragePath;
        }

        try {
            $imageInfo = @getimagesize($fullPath);
            if (! $imageInfo) {
                return $relativeStoragePath;
            }

            [$origWidth, $origHeight, $imageType] = $imageInfo;

            $sourceImage = match ($imageType) {
                IMAGETYPE_JPEG => @imagecreatefromjpeg($fullPath),
                IMAGETYPE_PNG => @imagecreatefrompng($fullPath),
                IMAGETYPE_WEBP => @imagecreatefromwebp($fullPath),
                default => null,
            };

            if (! $sourceImage) {
                return $relativeStoragePath;
            }

            // Ensure destination thumbnail directory exists
            $thumbDir = storage_path('app/public/covers/thumbnails');
            if (! is_dir($thumbDir)) {
                @mkdir($thumbDir, 0755, true);
            }

            $fileNameOnly = pathinfo($relativeStoragePath, PATHINFO_FILENAME);
            $thumbFullPath = $thumbDir . '/' . $fileNameOnly . '.webp';

            // 1. Generate 480x270 thumbnail for grid listing cards
            $thumbImage = imagescale($sourceImage, self::THUMBNAIL_WIDTH, self::THUMBNAIL_HEIGHT, IMG_BICUBIC);
            if ($thumbImage) {
                imagewebp($thumbImage, $thumbFullPath, self::WEBP_QUALITY);
                imagedestroy($thumbImage);
            }

            // 2. Downscale full cover if it exceeds MAX_COVER_WIDTH (e.g. 4000px raw camera uploads)
            if ($origWidth > self::MAX_COVER_WIDTH) {
                $targetHeight = (int) round(($origHeight / $origWidth) * self::MAX_COVER_WIDTH);
                $resizedCover = imagescale($sourceImage, self::MAX_COVER_WIDTH, $targetHeight, IMG_BICUBIC);
                if ($resizedCover) {
                    // Overwrite or convert to webp if supported
                    if ($imageType === IMAGETYPE_JPEG) {
                        imagejpeg($resizedCover, $fullPath, 85);
                    } elseif ($imageType === IMAGETYPE_PNG) {
                        imagepng($resizedCover, $fullPath, 8);
                    } elseif ($imageType === IMAGETYPE_WEBP) {
                        imagewebp($resizedCover, $fullPath, self::WEBP_QUALITY);
                    }
                    imagedestroy($resizedCover);
                }
            }

            imagedestroy($sourceImage);
        } catch (\Throwable $e) {
            Log::warning('Image optimization failed gracefully: ' . $e->getMessage(), [
                'path' => $relativeStoragePath,
            ]);
        }

        return $relativeStoragePath;
    }
}
