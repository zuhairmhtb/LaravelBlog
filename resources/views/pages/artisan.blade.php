@extends('layouts.app')
@section('content')
    <h1> Using Artisan</h1>
    <p>
    <ul class="list list-group">

        <li class="list-group-item">
            <b>Ceating Database(Model): </b>php artisan make:model ModelName -m<br>
            <i>Here -m is used to create Migration in order to create table for our post.<br>
            The model is added to app/ folder. The SQL code for creating Migration tables<br>
                are added to app/database/migrations/ folder. Fields for the tables can be<br>
            added to the 'up()' function in the migration file before merging the table. 'down()'<br>
            function is used in order to drop the table.</i>
        </li>
        <li class="list-group-item"><b>Creating tables from Migration files: </b> php artisan migrate<br>
            The database credentials should be updated in .env file before using migration files to create tables.</li>

        <li class="list-group-item"><b>Interacting with the database using Tinker: </b> php artisan tinker<br>
            <ul class="list list-group">
                <li class="list-group-item list-group-item-dark">Counting rows in a table: <br>App\ModelName::count() e.g. App\Post::count()</li>
                <li class="list-group-item list-group-item-dark">Creating new instance of a model and storing it in a variable:<br>
                    $model = new App\modelName() e.g. $post = new App\Post()
                </li>
                <li class="list-group-item list-group-item-dark">Adding new data row to the model:<br>
                    $model->field = 'Content'; e.g $post->title = 'Post 1'; $post->body = 'Post body.';
                </li>
                <li class="list-group-item list-group-item-dark">Saving the added fields in the instance:<br>
                    $model->save(); e.g. $post->save();
                </li>
            </ul>
        </li>
        <li class="list-group-item"><b>Resources: </b> Automatically adding resource functions like View Post(Index, Show), Edit Post(sedit and update),<br>
            Destroy Post(destroy), Create Post(Create and Store) while creating a controller for a model can be accomplished<br>
            by using the '--resource' command while creating the Controller using Artisan.<br>
            e.g. php artisan make:controller PostsController --resource
        </li>
        <li class="list-group-item"><b>Viewing available routes from Artisan: </b> php artisan route:list</li>
        <li class="list-group-item"><b>Adding multiple routes from a controller: </b> It is useful when all the newly created<br>
        resources in a controller needs to be added to the route. Instead of adding each and every function, we can do it<br>
        in one line using Route::resource('routeName', 'ControllerName') e.g. Route::resource('posts', 'PostsController')</li>
        <li class="list-group-item">Forms packages can be downloaded from Laravel Collectives in order to create, display and post forms using:<br>
            <i>composer require "laravelcollective/html":"^5.2.0"</i><br>
            If the composer returns constraint error then LaravelCollective needs to be added to the composer dependency using:<br>
            <i>"laravelcollective/html": "5.2.*"</i>
            This is needs to be added in composer.json under <i>"laravel/framework": "5.2.*"</i>, in require and then<br>
            <i>composer update</i><br>
            will update the Laravel Collective dependency. Then the first command is not required any more.
        </li>
        <li class="list-group-item">Add new Text Editor Package for text inputs using composer and ckeditor by:<br>
        <i>composer require unisharp/laravel-ckeditor</i>
            This can be added to inut fields in order to provide options for text editing and the result will be saved<br>
            in HTML format.
        </li>
        <li class="list-group-item">TO enable user authentication, controllers, model, etc. run<br>
            <i>php artisan make:auth</i>
        </li>
        <li class="list-group-item">In order to create migrations for updating the schema of a database table run:<br>
            <i>php artisan make:migration migration_file_name e.g. php artisan make:migration add_user_id_to_posts</i>
        </li>
        <li class="list-group-item">In order to create symlink for storage/ folder in public/ folder so that uploaded contents in storage can<br>
            be accessed by the application from public directory, run the following command:<br>
            <i>php artisan storage:link</i><br>
            For Laravel version 5.2 and less, the symbolic links need to be created manually. In linux terminal:<br>
            <i>ln -s /path/to/laravel/storage/app/public /path/to/laravel/public/storage</i>
        </li>
        <li class="list-group-item">
            Symlinks need to be created for storing files in Laravel 5.3 or higher as by default all files are stored in storage/app/public<br>
            folder. In order to access the file from public/ directory symlinks need to be created first and then the file can be stored using<br>
            <i>$request->file('key')->move('public/folder/', $fileNameToStore);</i><br>
            In case of versions less than 5.3, symlinks are not required and the files can be directly stored using:<br>
            <i>$request->file('key')->move('folder', $fileNameToStore);</i>
        </li>
        <li class="list-group-item">In order to create symlink using PHP run this line in a file:<br>
            <i>symlink('/path/to/folder/storage/app/public', '/path/to/folder/public/storage');</i>
        </li>
    </ul>
    </p>
@endsection
