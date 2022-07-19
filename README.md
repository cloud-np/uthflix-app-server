## Start with docker containers
```sh
./vendor/bin/sail up
```
## **Troubleshooting**

If there is problem running `composer update` do the following:

1. Create/find these are must have files/folders: 
```shell
uthflix-app-server/
├── bootstrap
│   ├── cache/
│   └── app.php
└── storage
│   └── framework
│       ├── cache/
│       ├── sessions/
│       └── views/
└── phpunit.xml 
```
2. Then remove cache and update everything.
```sh
sudo rm -rf vendor/
sudo rm composer.lock
sudo composer self-update
sudo composer update
sudo php artisan config:clear
```
3. Install your db with sail.
```sh
sudo php artisan sail:install
```
4. Start sail.
```sh
./vendor/bin/sail up
```

### **Changed public folder name**
This is done when using aritsan serve after changing the public folder name

In `app.php` add these lines of codes:
```php
$app->bind('path.public', function() {
    return __DIR__;
});
```
Right after
```php
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
```
