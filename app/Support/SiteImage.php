<?php

namespace App\Support;

class SiteImage
{
    public const HOMEPAGE = 'homepage_image';

    public const CLASS_IMAGE = 'class_image';

    public const INSTRUCTOR = 'instructor_image';

    public const ABOUT_US = 'about_us_image';

    /** @var list<string> */
    private const EXTENSIONS = ['svg', 'jpg', 'jpeg', 'png', 'webp'];

    public static function url(string $folder, ?string $filename): ?string
    {
        if ($filename === null || $filename === '') {
            return null;
        }

        $candidates = str_contains($filename, '.')
            ? [$filename]
            : array_map(fn (string $ext) => "{$filename}.{$ext}", self::EXTENSIONS);

        foreach ($candidates as $candidate) {
            $relative = "images/{$folder}/{$candidate}";
            if (is_file(public_path($relative))) {
                return asset($relative);
            }
        }

        return null;
    }

    /**
     * @param  array<string>  $filenames
     * @return list<string>
     */
    public static function gallery(string $folder, array $filenames): array
    {
        return array_values(array_filter(
            array_map(fn (string $filename) => self::url($folder, $filename), $filenames),
        ));
    }

    public static function classCardImage(string $slug): ?string
    {
        $gallery = self::classGallery($slug);

        return $gallery[0] ?? null;
    }

    /**
     * @return list<string>
     */
    public static function classGallery(string $slug): array
    {
        // Explicitly casting to (array) satisfies Intelephense's type checker
        /** @var array<string> $filenames */
        $filenames = (array) config("images.class_image.{$slug}", []);

        return self::gallery(self::CLASS_IMAGE, $filenames);
    }

    /**
     * @return list<string>
     */
    public static function homepageHeroImages(): array
    {
        // Typecast ensure it is read as an array
        $filenames = (array) config('images.homepage_hero', ['1', '2', '3', '4']);

        return self::gallery(self::HOMEPAGE, $filenames);
    }

    /**
     * @return list<string>
     */
    public static function aboutHeroImages(): array
    {
        // Typecast ensure it is read as an array
        $filenames = (array) config('images.about_hero', ['aboutus_1', 'aboutus_2', 'aboutus_3', 'aboutus_4']);

        return self::gallery(self::ABOUT_US, $filenames);
    }

    public static function instructorImage(string $filename): ?string
    {
        return self::url(self::INSTRUCTOR, $filename);
    }
}