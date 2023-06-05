start_front:
	npm run dev-server

start_backend:
	symfony serve

fix_local_problems:
	-bin/console do:da:dr --force
	bin/console do:da:cr
	bin/console do:mi:mi -n
	bin/console do:fi:lo -n

local_deploy:
	sudo rm -rf /var/www/zood.fun
	sudo cp -r ./ /var/www/zood.fun
	cd /var/www/zood.fun && \
	sudo npm run build && \
	composer install --no-dev --no-interaction && \
	sudo bin/console cache:clear && \
	composer dump-env prod && \
	sudo bash /var/www/prepareDir.sh