start_front:
	npm run dev-server

start_backend:
	symfony serve

fix_local_problems:
	-bin/console do:da:dr --force
	bin/console do:da:cr
	bin/console do:mi:mi -n
	bin/console do:fi:lo -n