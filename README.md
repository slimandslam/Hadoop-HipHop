Hadoop-HipHop
=============

An experiment to see if compiling PHP scripts into bytecode, using Facebook's HipHop VM, could increase the performance of a Hadoop Streaming API app.

The answer -- probably not.  

Even though using the HipHop VM will startup a PHP script 5x (or more) faster than using the PHP interpreter,                    
the amount of time saved, compared to the overall execution time, is very tiny even when spread over, say,
1000 slave nodes.

Oh well, it's here for reference anyway.....   :-D
