Hadoop-HipHop
=============

An experiment to see if compiling PHP scripts into bytecode, using Facebook's HipHop VM, could increase the performance of a Hadoop Streaming API app.

The answer -- not really. 

Even though using the HipHop VM will startup a PHP script 5x (or more) faster than using the PHP interpreter,                    
the amount of time saved, compared to the overall execution time, is very tiny even when spread over, say,
1000 slave nodes.

Oh well, it's here for reference anyway.....   :-D

The included streaming API app is a quickie I wrote to parse
the application firewall logs from MacOSX 10.8.x.  Those
logs are stored in /private/var/log/appfirewall.log.X .
It only looks for a couple of common hits on the firewall and
counts the number of times attempts are made from a given IP address.

Of course, to run these tests, you'll need to install HipHop:
https://github.com/facebook/hiphop-php
