# Symfony Site

## Docker Images

Environment variables keep Dockerfiles and shell scripts in sync. Edit and source the setenv.sh to change those values.

For now, the site uses 3 layers of images.

### pixelshaded/symfony-environment
The idea here is tevelopmenthis image could support any Symfony 2.1 project.

Installs LAMP and composer.

Enables apache2 rewrite.

### pixelshaded/symfony-dependencies
Composer needs an auth token to get files from git. It takes a build arg which will populate the COMPOSER_AUTH environment
variable in an intermediate image so the access token doesn't leak.

The build script passes your own COMPOSER_AUTH as a build arg. An example env var:

`{"github-oauth":{"github.com":"XXXXX"}}`

This process takes a sec and since it uses the intermediate image, it will not cache. This is the main reason it was 
separated out as another image so dependencies wouldn't have to be rebuilt each time we want to update source code.

Its main purpose is to get vendor files for the site image, so it's tightly coupled with it.

It also includes vendor tweaks - usually fixes to vendor files that couldn't easily be updated via composer.

### pixelshaded/symfony-site
The symfony site src and any tweaks that need to be made to apache configs etc to make it run.

This image builds quickly to make code changes painless. 

## Making Changes
  
You don't need the LAMP stack installed locally to develop / add content to the site. The main focus with containerizing
this site was not to change the underlying functionality of the site, but to make it feasible and painless (i.e. not require
extensive dev/prod environmental setup) to update the site's content, html, styling, etc.
Debugging php in the container hasn't been figured out for instance. You can accomplish most things using the shell scripts.

`setenv.sh` should be sourced to provide env variables to the other scripts

`build.sh` will build the docker image.

`run.sh` runs the image with a friendly name, usually binding to port 8888.

`redeploy.sh` will rebuild and rerun the site image. Mainly used when you want to test a code change. 
Ideally, we would just use docker cp to push files directly to the running container, but the site
currently has issues running the cache:clear commands after doing this, preventing us from seeing
the change.

`publish.sh` will publish the image to docker hub. The root publish script calls child publish scripts.

`getdb.sh` will mysqldump the database to a file in the git repo

### Database Changes

The database is versioned simply using mysqldumps.

If you need to add data to the db, run the container and use the admin portal. You can pull down those changes locally 
to source code running `getdb.sh`. This will run mysqldump and update the portfolio-site-dump.sql file.

### Gallery Images

Images get stored in web/img/uploads. If you need to add a new gallery for a new project, you will need to cp those image
files from the container along with the db changes.

## Container Analysis

This site was built back in 2012, well before containers were mainstream. In that sense, the containerization has some flaws.

### Database and Apache2 Share a Container

This means we can't currently scale the website without duplicating the data it relies on. While
not horrendous (honestly just talking 30kb here, but a single source of truth is ideal), we are missing a clean separation where we can update the source code of the site
without touching the database. It also means we cannot scale the database separately from the apache server. This would be a concern
in an enterprise application, but this portfolio site won't really get the traffic
to justify this separation. It's not serving content to thousands of users and therefore doesn't need to scale much. It also
costs more to have the db and site run in separate containers because each container will reserve a cloudlet. We could feasibly
handle all traffic with a single cloudlet, so this is a main reason the database remains local.

### Site Generates Resized Images at Runtime

The liip imagine bundle is a really cool tool, but is somewhat out of place in a container. Currently, you upload images to the site
via the admin panel and they get stored in www/img/uploads. However thumbnails and resized images are used throughout, but these are generated
at request time and stored in a media/cache folder. While convenient for the admin user, this hurts the user experience
if those images aren't in cache yet because they have to be generated, delaying how long it takes for the client to get them.
One advantage of containers is that they can be volatile. If it gets unhealthy, we just kill it and start another one. The problem
here is that there is a user experience cost to starting up a new one - the cache has to be recreated, usually by a user.
This means I either need to write a script that will crawl the site on start up and generate these images, or I need to generate them
ahead of time and include them in the source for building the image. This is a strange workflow, to have to run the image
to update the image. Database updates are handled the same way. The spirit of the original site is really a server 
which never goes down.

