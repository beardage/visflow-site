visflow-site
============
Repo for the website and visualization code for Visflow (Visflow.info)
Note: Passwords sent in plaintext because ssl is assumed for actual use.

The website is essentially a web app that uses your iRODS credentials to 
check for the initialization of the scripts on a server.
When imake.sh asks for the login credentials, it adds a folder and file 
(which simply contains the name of the table in the database) to the iRODS 
directory. When you login on the website with those same credentials, it 
finds that file with PRODS, the PHP IRODs library, and uses that table 
name to populate the status page. We did this in order to make sure the 
script is running before the table is created and it removed the need for
a user database and password security.

Since there is no user database, we wanted to minimize the amount of times
we’d have to hit the iRODS server so we decided to go with AJAX to load 
updates from our status database in ‘real time.’

update.php links
============
The basic idea is that imake.sh curls specific urls in order to pass data to a mysql database as workers are created and finish. These are some example links if you are writing your own script:

create table - update.php?mode=create&table=[tablename]
add worker - update.php?mode=add&table=[tablename]&id=[workerid]&status=1
update worker (complete) - update.php?mode=update&table=[tablename]&id=[workerid]&status=2
update worker (error) - update.php?mode=update&table=[tablename]&id=[workerid]&status=3
reset table - update.php?mode=reset&table=[tablename]


