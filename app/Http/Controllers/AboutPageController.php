<?php

namespace App\Http\Controllers;

use App\Support\SiteImage;
use Illuminate\View\View;

class AboutPageController extends Controller
{
    public function index(): View
    {
        $heroCopy = [
            [
                'badge' => 'Archery Adventures',
                'title' => 'Where focus meets community.',
                'description' => 'A modern urban range built for first-time archers, competitive shooters, and groups who want a welcoming place to grow.',
            ],
            [
                'badge' => 'Our promise',
                'title' => 'Safety, coaching, and confidence on every lane.',
                'description' => 'Certified instructors, premium equipment, and structured programs help every archer progress with clarity and support.',
            ],
            [
                'badge' => 'The experience',
                'title' => 'Archery that feels inspiring—not intimidating.',
                'description' => 'From beginner lessons to advanced training and private events, we make the range accessible, energetic, and fun.',
            ],
            [
                'badge' => 'Visit the range',
                'title' => 'Your next shot starts here.',
                'description' => 'Train with us in Sogod, Southern Leyte — a welcoming archery home for families, students, and competitors alike.',
            ],
        ];

        $heroImages = SiteImage::aboutHeroImages();
        $heroSlides = [];

        foreach ($heroCopy as $index => $copy) {
            $heroSlides[] = array_merge($copy, [
                'image' => $heroImages[$index] ?? null,
            ]);
        }

        return view('about', [
            'heroSlides' => $heroSlides,
            'team' => [
                'label' => 'Meet Our Team',
                'title' => 'The leadership guiding Archery Adventures.',
                'body' => 'Behind every great range is a dedicated team committed to safety, growth, and community. Meet the staff who shape our direction, operations, and member experience.',
                'members' => [
                    [
                        'index' => '01',
                        'name' => 'Michael Thompson',
                        'title' => 'Chief Executive Officer',
                        'description' => 'Leads company strategy, partnerships, and long-term growth while ensuring Archery Adventures stays true to its mission of accessible, welcoming archery for all.',
                        'image' => SiteImage::url(SiteImage::ABOUT_US, 'ceo'),
                    ],
                    [
                        'index' => '02',
                        'name' => 'Nina Patel',
                        'title' => 'Operations Manager',
                        'description' => 'Oversees daily range operations, scheduling, safety protocols, and member services so every visit runs smoothly from check-in to the final arrow.',
                        'image' => SiteImage::url(SiteImage::ABOUT_US, 'om'),
                    ],
                    [
                        'index' => '03',
                        'name' => 'Franklin Philips',
                        'title' => 'Director of Programs',
                        'description' => 'Designs class offerings, youth initiatives, and event experiences that help archers of every level learn, compete, and connect with the community.',
                        'image' => SiteImage::url(SiteImage::ABOUT_US, 'dp'),
                    ],
                ],
            ],
            'sections' => [
                [
                    'label' => 'Our Mission',
                    'title' => 'Make archery accessible, safe, and rewarding for everyone.',
                    'body' => 'We exist to remove barriers for new archers while giving experienced shooters a premium place to train. Every program is designed around clear instruction, modern equipment, and an environment where learners feel encouraged—not overwhelmed.',
                    'image' => SiteImage::url(SiteImage::ABOUT_US, 'mission'),
                    'reverse' => true,
                ],
                [
                    'label' => 'Our Vision',
                    'title' => 'Become the city\'s most trusted home for archery.',
                    'body' => 'We envision a thriving archery community where families, students, and competitors grow together. Our long-term goal is to expand programs, deepen youth outreach, and set the standard for urban ranges that blend professionalism with warmth.',
                    'image' => SiteImage::url(SiteImage::ABOUT_US, 'vision'),
                    'reverse' => false,
                ],
                [
                    'label' => 'Our Goals',
                    'title' => 'Grow skills, confidence, and community—one session at a time.',
                    'body' => 'We focus on measurable progress: stronger form, safer range habits, and more consistent scoring. We also invest in group events, school partnerships, and inclusive programming so archery remains open to all ages and backgrounds.',
                    'image' => SiteImage::url(SiteImage::ABOUT_US, 'goals'),
                    'reverse' => true,
                ],
                [
                    'label' => 'Our History',
                    'title' => 'Built on milestones that shaped who we are today.',
                    'body' => 'Archery Adventures opened with a small coaching team and a big belief that archery belongs in the heart of the city. Over the years we have earned recognition for excellence in instruction, community impact, and competition support.',
                    'image' => SiteImage::url(SiteImage::ABOUT_US, 'history'),
                    'reverse' => false,
                    'milestones' => [
                        '2012 — Archery Adventures opens its first urban training range',
                        '2016 — Regional Coach Excellence Award for youth development',
                        '2019 — City Community Sports Program of the Year',
                        '2022 — National Range Safety & Instruction Merit recognition',
                        '2024 — 1,000+ students coached across all skill levels',
                    ],
                ],
            ],
        ]);
    }
}
