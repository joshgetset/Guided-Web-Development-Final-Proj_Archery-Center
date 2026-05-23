<?php

namespace Database\Seeders;

use App\Models\ArcheryClass;
use App\Models\ClassSession;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ArcheryClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            [
                'slug' => 'beginner-lessons',
                'badge' => 'Beginner',
                'name' => 'Beginner Lessons',
                'short_description' => 'Learn proper stance, release, and aiming with patient coaching.',
                'full_description' => 'Step onto the range with expert instructors and premium equipment. This session covers safety, stance, nocking, drawing, anchoring, aiming, and release—with hands-on corrections after every end. Perfect for first-timers and weekend warriors who want a confident foundation.',
                'prerequisites' => 'No prior experience required. Wear closed-toe shoes and comfortable athletic clothing. Minimum age 10 (minors must be accompanied by a guardian).',
                'price_label' => '₱1,200 / session',
                'price_cents' => 120000,
                'image_url' => null,
                'gallery' => [],
                'duration_minutes' => 90,
                'cta_text' => 'View Class',
                'sort_order' => 1,
            ],
            [
                'slug' => 'advanced-training',
                'badge' => 'Advanced',
                'name' => 'Advanced Training',
                'short_description' => 'Sharpen speed, power, and precision with pro-level drills.',
                'full_description' => 'Push your bow skills with precision drills, strength work, and competition-ready coaching. Sessions include timed ends, form video review, tuning guidance, and mental-game strategies for rising archers preparing for events.',
                'prerequisites' => 'Comfortable shooting 18m recurve or compound at 60+ cm grouping. Bring your own bow if you have one (rentals available). Completion of Beginner Lessons or coach approval required.',
                'price_label' => '₱2,800 / session',
                'price_cents' => 280000,
                'image_url' => null,
                'gallery' => [],
                'duration_minutes' => 120,
                'cta_text' => 'View Class',
                'sort_order' => 2,
            ],
            [
                'slug' => 'group-events',
                'badge' => 'Events',
                'name' => 'Group Events',
                'short_description' => 'Plan team outings, birthdays, and private archery experiences.',
                'full_description' => 'Bring friends, family, or teammates for a guided archery session that blends coaching, challenge, and fun. Includes dedicated lanes, team drills, friendly scoring games, and a post-session photo moment—ideal for birthdays, corporate outings, and celebrations.',
                'prerequisites' => 'Minimum group size of 6 participants. All skill levels welcome. Notify us of any mobility needs at least 48 hours before the event.',
                'price_label' => '₱4,500 / group',
                'price_cents' => 450000,
                'image_url' => null,
                'gallery' => [],
                'duration_minutes' => 150,
                'cta_text' => 'Book Event',
                'sort_order' => 3,
            ],
            [
                'slug' => 'range-rental',
                'badge' => 'Rental',
                'name' => 'Range Rental',
                'short_description' => 'Reserve lanes with premium bows and targets for practice.',
                'full_description' => 'Reserve a lane with premium bows, targets, and safety equipment for self-guided practice. Staff remain on-site for equipment checks and lane safety. Great for archers who want flexible practice time without a full coaching package.',
                'prerequisites' => 'Basic archery safety knowledge required. First-time renters must complete a 15-minute safety briefing on arrival. Closed-toe shoes mandatory.',
                'price_label' => '₱900 / hour',
                'price_cents' => 90000,
                'image_url' => null,
                'gallery' => [],
                'duration_minutes' => 60,
                'cta_text' => 'Rent Equipment',
                'sort_order' => 4,
            ],
        ];

        foreach ($classes as $data) {
            $class = ArcheryClass::updateOrCreate(
                ['slug' => $data['slug']],
                $data,
            );

            $this->seedSessions($class);
        }
    }

    private function seedSessions(ArcheryClass $class): void
    {
        ClassSession::where('archery_class_id', $class->id)->delete();

        $base = Carbon::now()->next(Carbon::SATURDAY)->setTime(9, 0);

        foreach ([0, 7, 14] as $weekOffset) {
            ClassSession::create([
                'archery_class_id' => $class->id,
                'starts_at' => $base->copy()->addWeeks($weekOffset),
                'spots_available' => $class->slug === 'group-events' ? 4 : 8,
            ]);
        }
    }
}
