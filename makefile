test: phpunit phpcs

build: phpunit-coverage phpcs

phpunit:
	vendor/bin/phpunit --no-coverage

phpunit-coverage:
	vendor/bin/phpunit

phpcs:
	vendor/bin/phpcs -p --encoding=utf-8 --standard=PSR2 src

phpcbf:
	vendor/bin/phpcbf -p --encoding=utf-8 --standard=PSR2 src
