install:
	composer install
validate:
	composer validate
lint:
	composer run-script phpcs -- --standard=PSR12 src2022
fix_lint:
	composer run-script phpcbf -- --standard=PSR12 src2022