# CakePHP 4 with CakeDC/auth RBAC

This is an implementation example of Role Based Access Control with `vendor\cakephp\authorization\src\Middleware\UnauthorizedHandler\CakeRedirectHandler.php` extended to redirect back to the page where the user clicked the denied action and flash an error message to let the user know they have been denied access.

After creating a DB and adding database config to `config/app_local.php` run migrations to create tables

```sh
bin/cake migrations migrate

# Warning this will truncate the users & posts table
bin/cake migrations seed
```

User | Password | Description
---------|----------|---------
admin | 123 | Superuser/admin role
user | 123 | Standard user role


Very useful information in CakePHP Tutorials
- [https://book.cakephp.org/4/en/tutorials-and-examples/cms/authentication.html](https://book.cakephp.org/4/en/tutorials-and-examples/cms/authentication.html)
- [https://book.cakephp.org/4/en/tutorials-and-examples/cms/authentication.html](https://book.cakephp.org/4/en/tutorials-and-examples/cms/authorization.html)

## Features
- Use of `RequestAthorizationMiddleware`
- `src\Middleware\UnauthorizedHandler\RedirectWhenDenied.php` custom redirect & Flash Message
- Example of use of Owner Rule (`vendor\cakedc\auth\src\Rbac\Rules\Owner.php`)
- `src\Policy\AllowDebugKitPolicy.php` Allow DebutKit to work
- RBAC configuration `config/permissions.php`
- CakeDC/Auth RBAC & Redirect `src/Application.php`, 





