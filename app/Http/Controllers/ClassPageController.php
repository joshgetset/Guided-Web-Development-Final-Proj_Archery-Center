<?php

namespace App\Http\Controllers;

use App\Models\ArcheryClass;
use App\Support\SiteImage;
use Illuminate\View\View;

class ClassPageController extends Controller
{
    public function index(): View
    {
        $classes = ArcheryClass::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn (ArcheryClass $class) => self::formatClassCard($class));

        return view('class', [
            'classesJson' => $classes->values()->toJson(),
        ]);
    }

    public static function formatClassCard(ArcheryClass $class): array
    {
        $gallery = SiteImage::classGallery($class->slug);
        $image = SiteImage::classCardImage($class->slug) ?? ($gallery[0] ?? null);
        $enhancements = self::classEnhancements($class);

        return [
            'id' => $class->id,
            'slug' => $class->slug,
            'badge' => $class->badge,
            'name' => $class->name,
            'short_description' => $class->short_description,
            'full_description' => $class->full_description,
            'prerequisites' => $class->prerequisites,
            'price_label' => $class->price_label,
            'duration_minutes' => $class->duration_minutes,
            'cta_text' => $class->cta_text,
            'image_url' => $image,
            'gallery' => $gallery,
            'is_emoji_card' => $image === null,
            'instructor_name' => $enhancements['instructor_name'],
            'benefits' => $enhancements['benefits'],
        ];
    }

    private static function classEnhancements(ArcheryClass $class): array
    {
        return match ($class->slug) {
            'beginner-lessons' => [
                'instructor_name' => 'Coach Riley',
                'benefits' => [
                    'Safety-first coaching for a confident first session',
                    'Fast progress through hands-on feedback and posture drills',
                    'Perfect for brand-new archers and returners alike',
                ],
            ],
            'advanced-training' => [
                'instructor_name' => 'Coach Alex',
                'benefits' => [
                    'Precision drills and form review for sharper accuracy',
                    'Mental-game coaching to help you perform under pressure',
                    'Ideal for archers preparing for tournaments or personal bests',
                ],
            ],
            'group-events' => [
                'instructor_name' => 'Coach Sam',
                'benefits' => [
                    'Team-focused activities that make every booking feel special',
                    'Structured group coaching for fun, safe, and memorable events',
                    'Great for birthdays, corporate outings, and celebrations',
                ],
            ],
            'range-rental' => [
                'instructor_name' => 'Range Staff Support',
                'benefits' => [
                    'Flexible practice time with premium bows and targets',
                    'On-site equipment checks so you can focus on your shot',
                    'Perfect for solo shooters who want control over their session',
                ],
            ],
            default => [
                'instructor_name' => 'Lead coach',
                'benefits' => [
                    'Personalized instruction for every skill level',
                    'Clear goals, efficient practice, and supportive coaching',
                ],
            ],
        };
    }
}
