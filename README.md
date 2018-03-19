# Mitä-verkosto: Ehkäisytalkoot

Working copy of [ehkaisytalkoot.mitaverkosto.fi](https://ehkaisytalkoot.mitaverkosto.fi).

![mita-screenschot-web](https://user-images.githubusercontent.com/9577084/37613160-ffa1289e-2baf-11e8-9618-216f72c5b5ec.jpg)

## Features

* Users can leave anonymous stories
* Users can add reactions to stories
* Information about campaign in Finnish and English

## Key technologies

* CMS: [WordPress](https://wordpress.org/)
* Environment: [Seravo/wordpress](https://github.com/Seravo/wordpress)
* Theme: [Aucor Starter](https://github.com/aucor/aucor-starter)
* Forms: [WP Libre Form](https://wordpress.org/plugins/wp-libre-form/)
* Multilingual: [Polylang](https://wordpress.org/plugins/polylang/)

## How to use

* It's GPL 2
* The config.yml is missing to protect some server credentials. Make your own [from example](https://github.com/Seravo/wordpress).
* Clone this repo and run `vagrant up`.
* In theme's directory run `yarn install` and `gulp watch` to make changes to css, images or js. More info on theme's README.md.

## History

* Built pro bono in February 2018.
* Development and visual design by Teemu Suoranta.
* Building the site took around two working days.