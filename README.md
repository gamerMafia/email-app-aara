
## Bespoke



### Commands for setup

- Cloning git repo
`git clone -b v8 git@github.com:abhiguess/aara-shopify.git .`


Install all vendor files
`composer i`

- Copy sample .env.example file 
`cp .env.example .env`

- For generating app key in .env file
`php artisan key:generate`

- Update mail section in .env with below creds replace password with actual password
```
MAIL_MAILER=smtp
MAIL_HOST=smtppro.zoho.in
MAIL_PORT=587
MAIL_USERNAME=info@aarajewelryco.com
MAIL_PASSWORD="password"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@aarajewelryco.com
MAIL_FROM_NAME="${APP_NAME}"
```

- Also update APP_URL & APP_ENV fields in .env
```
APP_URL=https://email-app.aarajewelryco.com
APP_ENV=production
```

- Add write permission to storage & bootstrap/cache folder & storage link
```
sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache
php artisan storage:link
```

