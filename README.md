# Welcome to (SPM) Simple PHP MVC, just what you need!
This is a simple PHP MVC framework without too much dependencies that you don't need.

## Supports:
1. PHP 7^
2. MYSQL
3. MSSQL
4. SQLite

## Getting Started
1. Download the [latest release] or install via composer [composer create-project vgalvoso/spm].
2. Configure your database in app/Config/Database.php.
3. Make sure the project is located inside your web server's root directory.
4. Now you can create Controllers,Views and Models.

## Routing
Creating routes is easy in SPM. 

Open routes.php.

Add your new route.
```php
//routes.php
use App\Controller\Home;

get('',Home::class,"index");
```

To get data from POST request, use post() function
```php
//routes.php
use App\Controller\Home;

//post(route name,class,static function to call)
post('post',Home::class,"samplePost");
```

To get data from GET request, use getI() function
```php
//routes.php
use App\Controller\Home;

//get(route name,class,static function to call)
get('get',Home::class,"sampleGet");
```
## Controllers
Controllers responds to hyperlinks,form actions and url inputs.

- Controllers are stored in app/Controller
- Controllers class name must be the same as the file name.

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
//app/Controller/Home.php
public static function index()
{
    view("section/header");
    view("home");
    view("section/footer");
}
```

You can pass data to view. (Must be an associative array)
```php
//app/Controller/Home.php
public static function index()
{
    $data = ["header" => "Simple MVC Framework",
            "sub_header" => "Just what you need!"];
    view("section/header");
    view("home",$data);
    view("section/footer");
}
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
- Model extends app/Libraries/Model.php

Initialize our model

When we don't place parameter, our model will use the default database.
```php
//app/Controller/Home.php
$home_model = new HomeModel();
```

Use other database that is configured in app/Config/Database.php
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
//app/Model/HomeModel.php
public function getUser(){
    $query = "SELECT * FROM users WHERE id = 1";
    return $this->getItem($query);
}
```

Select multiple items
```php
//app/Model/HomeModel.php
public function getAllUsers(){
    $query = "SELECT * FROM users";
    return $this->getItems($query);
}
```

Anti SQL Injection
```php
//app/Model/HomeModel.php
public function validateUser($username,$password){
    $query = "SELECT * FROM users WHERE username = :uname AND pass = :pass";
    $params = ["uname" => $username, "pass"=>$password];
    return $this->getItem($query,$params);
}
```

To Insert data create an assoc array and use table field names as array keys
```php
//app/Model/HomeModel.php
public function addUser($username,$password,$firstname){
    $params = ["u_username"=>$username,
            "u_password"=>password_hash($password,PASSWORD_DEFAULT),
            "firstname"=>$firstname];
    if($this->insert("users",$params))
        return true;
    return false;
}
```

To Delete data use exec() function
```php
//app/Model/HomeModel.php
public function deleteUser($userId){
    $params = ["id" => $userId];
    $query = "DELETE FROM users WHERE id = :id";
    $this->exec($query,$params);
}
```

To Update data use exec() function
```php
//app/Model/HomeModel.php
public function updateUser($firstname,$userId){
    $query = "UPDATE users SET firstname = :firstname WHERE id = :userId";
    $params = ["firstname" => $firstname,"userId"=>$userId];
    return $this->exec($query,$params);
}
```

Start Transaction
```php
//inside your model
$this->startTrans();
```

Commit
```php
$this->commit();
```

Rollback
```php
$this->rollback();
```

Everytime we use our Model functions and it fails, we can get the error
```php
$this->getError();
```

We can also see what is the database driver we are currently using.
```php
$this->getDriver();
```

And we can also get the last inserted id
```php
$this->lastId();
```
[latest release]: https://github.com/vgalvoso/spm/releases