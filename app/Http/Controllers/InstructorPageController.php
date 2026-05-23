<?php

namespace App\Http\Controllers;

use App\Support\SiteImage;
use Illuminate\View\View;

class InstructorPageController extends Controller
{
    public function index(): View
    {
        $instructors = [
            [
                'id' => 1,
                'first_name' => 'Riley',
                'last_name' => 'Hart',
                'title' => 'Senior Archery Coach',
                'rating' => 4.98,
                'experience_years' => 9,
                'specialty' => 'Precision shooting, tournament preparation',
                'short_bio' => 'From beginner guidance to championship-level refinement.',
                'full_bio' => 'Riley brings nine years of competitive archery experience and a passion for helping archers of all levels build confidence, rhythm, and consistency on the range.',
                'certifications' => ['USA Archery Coach Level 3', 'Certified Mental Performance Trainer', 'Youth Safety Specialist'],
                'achievements' => ['Top 10 nationwide ranked coach', 'Over 500 private lessons delivered', 'Featured speaker at the Urban Archery Summit'],
                'quote' => 'Great archery is built from control, focus, and small improvements made every session.',
                'image_url' => SiteImage::instructorImage('ins_1'),
            ],
            [
                'id' => 2,
                'first_name' => 'Alex',
                'last_name' => 'Wong',
                'title' => 'Performance Specialist',
                'rating' => 4.86,
                'experience_years' => 6,
                'specialty' => 'Mental focus, consistent scoring, advanced technique',
                'short_bio' => 'A coach who tunes the mind and body for every shot.',
                'full_bio' => 'Alex combines technical precision with mental training to help archers stay calm under pressure and consistently hit their target.',
                'certifications' => ['Performance Psychology Coach', 'Advanced Archery Technique Coach'],
                'achievements' => ['Coach of regional youth champions', 'Developed precision training curriculum', 'National coaching seminar leader'],
                'quote' => 'Your greatest advantage is how prepared you feel before you draw the bow.',
                'image_url' => SiteImage::instructorImage('ins_2'),
            ],
            [
                'id' => 3,
                'first_name' => 'Maya',
                'last_name' => 'Chen',
                'title' => 'Community Archery Coach',
                'rating' => 4.74,
                'experience_years' => 4,
                'specialty' => 'Beginner lessons, group sessions, safety coaching',
                'short_bio' => 'Friendly coaching designed to make every archer feel welcome.',
                'full_bio' => 'Maya specializes in beginner-friendly instruction, group workshops, and safety-first training so first-time archers can feel confident immediately.',
                'certifications' => ['Certified Range Safety Officer', 'Beginner Archery Instructor'],
                'achievements' => ['Led 200+ group classes', 'Created welcome program for new archers', 'Community outreach ambassador'],
                'quote' => 'Archery should feel empowering and exciting from day one.',
                'image_url' => SiteImage::instructorImage('ins_3'),
            ],
            [
                'id' => 4,
                'first_name' => 'Leo',
                'last_name' => 'Nguyen',
                'title' => 'Technique Coach',
                'rating' => 4.81,
                'experience_years' => 7,
                'specialty' => 'Form refinement, release consistency, bow setup',
                'short_bio' => 'A methodical coach who perfects your fundamentals.',
                'full_bio' => 'Leo focuses on technique and equipment alignment, helping archers improve form, release, and accuracy through repeatable drills.',
                'certifications' => ['Equipment Tuning Specialist', 'Advanced Form Instructor'],
                'achievements' => ['Trainer for elite club shooters', 'Published technique guides', 'Popular clinic instructor'],
                'quote' => 'Precision comes from practice and paying attention to the details.',
                'image_url' => SiteImage::instructorImage('ins_4'),
            ],
            [
                'id' => 5,
                'first_name' => 'Sofia',
                'last_name' => 'Martinez',
                'title' => 'Advanced Training Lead',
                'rating' => 4.92,
                'experience_years' => 8,
                'specialty' => 'Competition prep, pace strategy, scoring consistency',
                'short_bio' => 'Turning dedicated archers into confident competitors.',
                'full_bio' => 'Sofia helps archers develop competition-ready routines, build consistency across rounds, and manage pacing for stronger scores.',
                'certifications' => ['Competition Coach', 'High-Performance Archery Trainer'],
                'achievements' => ['Coached regional champions', 'Created high-performance training track', 'Recognized for elite competition prep'],
                'quote' => 'Consistency is the secret behind every great competition round.',
                'image_url' => SiteImage::instructorImage('ins_5'),
            ],
        ];

        return view('instructors', [
            'instructorsJson' => json_encode($instructors),
        ]);
    }
}
