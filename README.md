# Set up docker
### Clone by ssh:
```
git@github.com:duy-pham-saltovn/demo-vue-api.git
```

### Clone by  https:
```
https://github.com/duy-pham-saltovn/demo-vue-api.git
```
# demo

## How to set up Back-End

### Build docker
```
cd demo-vue-api
docker-compose build
docker-compose up -d
```

### install vendor and migrate database
```html
docker exec -it vue_web_api bash
cd src
composer install
php artisan migrate:fresh --seed
```

## How to start front-end

```
cd demo-vue-api
yarn install
```

### Compiles and hot-reloads for development
```
yarn serve
```

### Compiles and minifies for production
```
yarn build
```

### Lints and fixes files
```
yarn lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).
