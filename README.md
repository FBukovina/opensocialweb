# the opensocial



replacement for X you've been waiting for.

## Status

### What's working
#### nothing right now, lol
- [x] account creation
- [x] posting
- [x] replying
- [x] liking
- [x] account editing
- [x] drafts

### What isn't working
- [ ] reposts
- [ ] viewing likes and reposts on accounts

### What's planned
- [ ] Post editing(needs + subscription)
- [ ] Post deletion
- [ ] Following
- [ ] Search
- [ ] Trends
- [ ] "For you" timeline
- [ ] the opensocial+ subscription - no ads, + badge, colour customisation
- [ ] ADS platform


## Contributing to the opensocial
the opensocial source code(originally forked from Chirp) is open source. You can freely fork this repo, make changes and then create a pull request.

### Dealing with code

#### Using PHPs built-in server

_clone this git repo and put it where you like it and `cd` into it_

```sh
php -S localhost:port
```

#### Using Apache/XAMPP

_have `PHP` and `PDO` with SQLite support installed_

```sh
git clone https://github.com/actuallyaridan/chirp
mv chirp /var/www/
# Or other place your Apache or XAMPP install uses for hosting coontent
```

**BTW that folder should be empty - if it's something like `/htdocs/chirp` it will 99% break**

#### Database

This project is currently using SQLite. the opensocial database is not included in GitHub, as it contains sensntive information that will not be shared publicly. There are however refereces in the PHP files, so you can create an empty replica if you'd like to.

## Forking the opensocial

You can freely made copies of the opensocial and use the opensocial code as a base for your procject. However, in order to be cool, please follow these guidelines:

• Rebrand your project: Please refrain from using any Chirp and the opensocial branding in your project

• Credit us: You should provide credit to the people who have contibuted to this project, or link this repo. the opensocial is forked from Chirp and now using some Chirp features, so please credit Chirp and the opensocial. 

Other than that, the opensocial uses the MIT license.



