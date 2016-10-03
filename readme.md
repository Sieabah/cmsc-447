## CMSC 447 Team 5

Steps to start on the team

1. Clone the repo
2. Add your name to contributers.txt

## Contributing

### Getting Laravel Running
1. [Install virtualbox](https://www.virtualbox.org/wiki/Downloads)
2. Also install [Vagrant](https://www.vagrantup.com)
3. Add [hostsupdater extension](https://github.com/cogitatio/vagrant-hostsupdater) to vagrant
4. Copy `.env.example` to `.env`, adjust for production and development environments.
5. Start the VM from the root app diretory and run `vagrant up`.

This will start the VM and you can connect to it after it's done by running `vagrant ssh`. This web directory will
be found in `/srv/web`. Run `php artisan key:generate` and try to access your application from [itracker.dev](itracker.dev).

As of right now it should be a page that doesn't look quite right, but it shouldn't fail outright. (Other than missing assets)

### Getting everything built
This environment heavily uses npm and node to build our dependencies.
1. Connect to the VM with `vagrant ssh` and navigate to `/srv/web`. 
2. From this directory you can run `npm install` and it will install all of our dependencies.
3. After we have installed that we need to install gulp globally to run the command `gulp`.
    1. Run `sudo npm install -g gulp`
4. Gulp should now be installed and you can run `gulp build` to build a development copy of the assets or `gulp` to have
it continually watch the directory for changes and rebuild. (Alternative: `npm dev`)
5. Production builds will be minified and optimized and can be generated by `gulp prod` or the alias `npm prod`

Now you can visit [itracker.dev](itracker.dev) and see the websites' current state.

## Notes about building

With the way it is setup we can leverage _most_ of the [ES2015(ES6)](http://es6-features.org/#Constants) features with [babel](https://babeljs.io/)

Any `*.js` files in the `resources/assets/angular/` folder will be compiled after `core.js` is loaded.

Any `*.scss` files mentioned or imported in `resources/assets/sass/core.scss` will be compiled, everything else **is ignored**