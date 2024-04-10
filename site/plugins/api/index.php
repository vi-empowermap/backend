<?php
Kirby\Cms\App::plugin('my/api', [
  'api' => [
    'routes' => function ($kirby) {
      return [
        [
          'pattern' => 'my-endpoint',
          'action'  => function () use ($kirby) {
            return [
              'users' => $kirby->users()->count(),
              'test' => "dain"
            ];
          }
        ],
        [
          'pattern' => 'dain',
          'action'  => function () use ($kirby) {
            return [
              'users' => $kirby->page('home')->content()->hometitle(),
              'test' => "dain2"
            ];
          }
        ],
        [
          'pattern' => 'test',
          'method' => "POST",
          'action'  => function () use ($kirby) {
            $gettitle = get('title');
            $kirby->page('home')->update([
              'homeTitle' => $gettitle
            ]);
            return [
              'users' => $kirby->page('home')->content()->hometitle(),
              'test' => "dain2"
            ];
          }
        ]
      ];
    }
  ]
]);