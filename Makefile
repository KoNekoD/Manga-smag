start_front:
	npm run dev-server

start_backend:
	symfony serve

fix_local_problems:
	-bin/console do:da:dr --force
	bin/console do:da:cr
	bin/console do:mi:mi -n
	bin/console do:fi:lo -n

SITE_DIR_NAME=manga-smag.nekochan.space
local_deploy:
	-sudo rm -rf /var/www/${SITE_DIR_NAME}
	sudo cp -r ./ /var/www/${SITE_DIR_NAME}
	cd /var/www/${SITE_DIR_NAME} && \
	sudo npm run build && \
	sudo bin/console cache:clear && \
	composer install --no-dev --no-interaction && \
	sudo bin/console cache:clear && \
	composer dump-env prod && \
	sudo bash /var/www/prepareDir.sh