# Hello project

This is a default webpage to put on your server that can replace the regular
nginx or Apache welcome page. It just says hello, really.

## License

The project is licensed under the [General Public License v3](LICENSE.md),
without any modifications.

## Installation

There are two common ways of installing this project.

### Download a release

There's a pre-built release available for each version, which can be found in
the releases tab.

Just download the release, extract it and point your server to the `web/`
directory. Make sure it can process PHP.

### Compile it yourself

If you want to compile it yourself, install Yarn (or NPM) and run the following

```bash
yarn install
yarn run prod
```

That's it, now point your webserver to the `web/` directory and make sure it can
parse PHP.

## Configure server

Please see the configuration of your server of choice. If you're missing your
server but have set it up yourself successfully, please make a PR :smile:.

 - [Nginx config](config/nginx.conf)
