iainspad-theme
==============

A wordpress theme for iainspad.

**Currently undergoing a theme cleanup.** Feel free to contribute any help if you see fit; could always use some input!

##Contributing

First, make a pull request and clone the theme into the `wp-content/themes/` directory.

```
git clone git@github.com:iainspad/iainspad-theme.git
git checkout feature/theme-improvements
```

Then install all the Gulp packages.

```
npm install
gulp watch
```

You're now ready to add changes to the repository and put in changes.

##TODO

- [ ] Convert CSS to SCSS
- [x] Add Gulp and Gulp Packages
- [ ] Remove images used as backgrounds
- [ ] Replace raster graphics (i.e. the logo) with SVGs
- [ ] Clean up HTML
- [ ] Remove Portfolio and Portfolio coding
- [ ] Add a Responsive Image method (may need a lot of testing, will do this myself)
- [ ] Clean up CSS
	- [ ] Split SCSS into multiple files
	- [ ] Add variables and Mixins
	- [ ] Remove all IDs
	- [ ] Improve Strppd
	- [ ] Add additional commentary
	- [ ] Improve classification
- [ ] Clean up JavaScript
	- [ ] Stick with jQuery
	- [ ] Remove all fade effects: if keeping effect, use CSS instead
	- [ ] Clean up AJAX, test
- [ ] Clean up functions, remove arbitrary functions
- [ ] Remove all arbitrary/unused files
