<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Site image folders (under public/images/)
    |--------------------------------------------------------------------------
    |
    | Upload your files into these folders. Supported formats: svg, jpg, jpeg, png, webp.
    | If a file is missing, the UI shows a placeholder until you add it.
    |
    */

    'folders' => [
        'homepage' => 'homepage_image',
        'class' => 'class_image',
        'instructor' => 'instructor_image',
        'about' => 'about_us_image',
    ],

    'homepage_hero' => ['1', '2', '3', '4'],

    'about_hero' => ['aboutus_1', 'aboutus_2', 'aboutus_3', 'aboutus_4'],

    'homepage_image' => [
        '1',
        '2',
        '3',
        '4',
    ],

    'class_image' => [
        'beginner-lessons' => ['ba_1', 'ba_2', 'ba_3', 'ba_4'],
        'advanced-training' => ['at_1', 'at_2', 'at_3', 'at_4'],
        'group-events' => ['ge_1', 'ge_2', 'ge_3', 'ge_4'],
        'range-rental' => ['rr_1', 'rr_2', 'rr_3'],
    ],

    'instructor_image' => [
        'riley-hart',
        'alex-wong',
        'maya-chen',
        'leo-nguyen',
        'sofia-martinez',
    ],

    'about_us_image' => [
        'hero' => ['aboutus_1', 'aboutus_2', 'aboutus_3', 'aboutus_4'],
        'team' => ['ceo', 'om', 'dp'],
        'sections' => ['mission', 'vision', 'goals', 'history'],
    ],

];
