<?php
//helper create by Dennys

use App\Role;

function gen_route($area)
{
    $routes = [
        ['name' => 'List', 'route' => 'index', 'method' => 'get', 'url' => '/'],
        ['name' => 'New', 'route' => 'new', 'method' => 'get', 'url' => 'new'],
        ['name' => 'Edit','route' => 'edit', 'method' => 'get', 'url' => 'edit/{##camelcase##}'],
        ['name' => 'Store', 'route' => 'store', 'method' => 'post', 'url' => 'store/{##camelcase##?}'],
        ['name' => 'Delete','route' => 'delete', 'method' => 'get', 'url' => 'delete/{##camelcase##}']
    ];

    $roles = [];

    $lowerArea = str_replace(' ','_', strtolower($area['name']));
    $upperArea = str_replace(' ', '', ucwords($area['name']));
    $camelcase = \Str::camel($area['name']);

    foreach ($routes as $route) {
        $roles[] = [
            'area_id' => $area['id'],
            'name' => ucfirst($route['name']),
            'route' => str_replace('##camelcase##', $camelcase, $route['url']),
            'alias' => "sysadmin.{$lowerArea}.{$route['route']}",
            'method' => $route['method'],
            'protected' => 'Y'
        ];
    }

    $newRoles = Role::insert($roles);

    if($newRoles) {


        $txtRoutes = "
    Route::group(['prefix' => '##area##'], function() {

        Route::get('/', [
            'as' => 'sysadmin.##area##.index',
            'uses' => 'Sysadmin\##upperArea##Controller@index'
        ]);

        Route::get('new', [
            'as' => 'sysadmin.##area##.new',
            'uses' => 'Sysadmin\##upperArea##Controller@new'
        ]);

        Route::get('edit/{##camelcase##}', [
            'as' => 'sysadmin.##area##.edit',
            'uses' => 'Sysadmin\##upperArea##Controller@edit'
        ]);

        Route::post('store/{##camelcase##?}', [
            'as' => 'sysadmin.##area##.store',
            'uses' => 'Sysadmin\##upperArea##Controller@store'
        ]);

        Route::get('delete/{##camelcase##}', [
            'as' => 'sysadmin.##area##.delete',
            'uses' => 'Sysadmin\##upperArea##Controller@delete'
        ]);

    });
";

        $search = ['##area##', '##upperArea##', '##camelcase##'];
        $replace = [$lowerArea, $upperArea, $camelcase];
        $txtRoutes = str_replace($search, $replace, $txtRoutes);

        $file = fopen(base_path('routes/routes_' . $lowerArea . '.txt'), 'w+');

        fwrite($file, $txtRoutes);
        fclose($file);


        dump('File generated in ' . base_path('/routes/routes_' . $lowerArea . '.txt'));
    } else {
        dump('Error!');
    }
}
