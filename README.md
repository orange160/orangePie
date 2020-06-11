## 启动
前端编译代码 ```npm run dev```

前端监听代码变化 ```npm run watch```

启动Laravel开发服务
```php artisan serve```


## 其他操作说明
编辑了app\helper.php文件后需要执行
```composer dump-autoload```

清除视图缓存 
```php artisan view:clear```

清除运行缓存
```php artisan cache:clear```

清除配置缓存
```php artisan config:clear```

生成Key
```php artisan generate:key```