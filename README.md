## Poll control example
##### Used technologies
- Nette framework
- AJAX realized with pure Nette resources (snippets & subrequests)
- Designed using Bootstrap 3
- Assets downloaded & installed with npm, bower & gulp

##### Obtaining repository
Clone repository first

Install PHP libraries using Composer
```shell
composer install
```
Install Node.js modules & plugins by npm
```shell
npm install
```
Install bower components by bower
```shell
bower install
```
Compile assets by gulp
```shell
gulp
```
##### Setup
Copy sample config file to new local config
```shell
cd src/app/config/
cp config.local.sample.neon config.local.neon
```
Edit config file and fill Your credentials and change database name, if necessary.
```neon
doctrine:
	# for local mysql database
	user: root
	password: root
	dbname: db
```
For testing purposes is defaultly disabled checking of **IP uniqueness**.
You can turn on this in main config file `config.neon`:
```neon
parameters:
	international: true
	checkIp: false
```
changing the **checkIp** parameter to value **true**.
