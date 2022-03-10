# Welcome to (SPM) Simple PHP MVC, just what you need!
This is a simple PHP MVC framework without extra files and codes that you don't need.

- This is open source, feel free to contribute.
- For small to mid sized projects.
- No need to use composer.
- No dependencies.
- No need to configure web server.
- Easy to deploy alongside other SPM projects on same server.
- Easy to work with database.

## Supports:
1. PHP 5.3.1
2. MYSQL
3. MSSQL

## Getting Started
1. Download or clone the repo.
2. Configure your database to app/Libraries/Database.php.
3. Rename the root folder with your project name.
4. Now you can create Controllers,Views and Models.

## Routing
Creating routes is easy in SPM. 

Open index.php.

Add your new route inside the switch statement.
```php
//index.php
switch($path){
    case "home"://route name
        new Home();//your controller
        break;
    default:
        echo "<h1> Page not found </h1>";
    break;
}
```

To get data from POST request, add parameter to your controller function
```php
//index.php
case "post"://route name
    Home::samplePost($_POST);//add parameter to get POST data
    break;
```

To get data from GET request, add parameter to your controller function
```php
//index.php
case "get"://route name
    Home::sampleGet($_GET);//add parameter to get GET data
    break;
```
## Controllers
Controllers responds to hyperlinks,form actions and url inputs.

- Controllers are stored in app/Controller
- Controllers class name must be the same as the file name.
- Controllers extends app/Libraries/Controller.php

Lets create the function for the "post" route in Home controller.
```php
public static function samplePost($post_data){
    //now you can get values from POST request
    //sample: $username = $post_data["username"];
}
```

And for our "get" route.
```php
public static function sampleGet($get_data){
    //now you can get values from GET request
    //sample: $id = $get_data["user_id"];
}
```

## Views
Views shows information to the user.

- Views are stored in app/Views
- Use snake case for naming views (sample: main_page.php)
- You can create subfolders to organize your view files.

Let's use our view for Home controller(home route)
```php
$this->view("section/header");
$this->view("home");
$this->view("section/footer");
```

You can pass data to view. (Must be an associative array)
```php
$data = ["header" => "Simple MVC Framework",
        "sub_header" => "Just what you need!"];
$this->view("section/header");
$this->view("home",$data);
$this->view("section/footer");
```

Keys from the array will be converted into variables that you can use in the views
```html
//Views/home.php
<div class="full-screen column center">
    <h1 class="text-banner center-text"> <?= $header ?> </h1>
    <h1 class="text-header"> <?= $sub_header ?> </h1>
</div>
```
## Models
Models are used for CRUD(Create,Update,Delete) operations and SPM made that easy.

- SPM currently supports Transactional Databases (MySql and MsSql).
- Models are stored in app/Model
- Model class names must be same as the file name.
- Model class names must be PascalCase and have Model at the end(sample: HomeModel)
- Model extends app/Libraries/Model.php

Initialize our model

When we don't place parameter, our model will use the default database.
```php
//app/Controller/Home.php
$home_model = new HomeModel();
```

Use other database that is configured in app/Libraries/Database.php
```php
//app/Controller/Home.php
$home_model = new HomeModel("ms");
```

We can also use other database even it is not declared in Database.php
```php
//app/Controller/Home.php
$home_model = new HomeModel(null,$host,$user,$pass,$dbname,$driver(mysq;/mssql));
```

Select single item
```php
//returns object and false on error
$query = "SELECT * FROM table WHERE id = 1";
$item = $home_model->getItem($query);
```

Select multiple items
```php
//returns array and false on error
$query = "SELECT * FROM table";
$items = $home_model->getItems($query);

//Cast each item to object for easier coding.
foreach($items as $item){
  $item = (object)$item;
}
```

To INSERT,UPDATE or DELETE data
```php
//returns boolean
$query = "INSERT FROM table VALUES('1','Juan Dela Cruz')";
$result = $home_model->exec($query);
```

We can use parepared statement.
```php
$params = ["id" => $value];
$item = $home_model->getItem("SELECT * FROM table WHERE id = :id",$params);
$delete = $home_model->exec("DELETE FROM table WHERE id = :id",$params);

$params = ["id"=>$value,"name"=>$name];
$update = $home_model->("UPDATE table SET name=:name WHERE id = :id",$params);
```

Start Transaction
```php
$home_model->startTrans();
```

Commit
```php
$home_model->commit();
```

Rollback
```php
$home_model->rollback();
```

Everytime we use our Model functions and it fails, we can get the error
```php
$home_model->getError();
```

We can also see what is the database driver we are currently using.
```php
$home_model->getDriver();
```

And we can also get the last inserted id
```php
$home_model->lastId();
```
