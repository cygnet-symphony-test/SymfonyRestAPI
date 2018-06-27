symfony-blog
============

How to setup project.

[ Step :- 1]
	Change DB value as per your suite under bellow file.
		~
			app/config/parameters.yml
		~
[ Step :- 2]				
	Run a make file from the project root folder using bellow command.
	
~~~bash
	./bin/MAKEFILE.sh
~~~
The above command do following things.
1. - Fetch latest binary of  composer   
2. - Fetch all vendor library
3. - Run database migration based on [ Step:-1 ] configuration
4. - Generate private and public key 
		- This step will ask for the passphrase
5. - Run phpunit test case
6. - Run webserver at `127.0.0.1:8090` 

[ Step :- 3]
	- Whatever the passphrase you have entered into [Step:2] , Assign that passphrase into `app/config/config.yml` to `pass_phrase:` key.
	- In current project I have used `vallabh` as a passphrase.
[ Step :- 4]
	Import postman collection using `SymfonyRestApi.postman_collection.json`


[ Note:- ]
	- If you want to host a dynamic server take reference of nginx conf from `bin/nginx.conf` file.
	- Be careful with `./bin/MAKEFILE.sh` this command.

[Developer Note:- ]
	 I have tested this project using following methods.
	 (1) Manual testing using Postman collection.
	 (2) Using phpunit test case.
