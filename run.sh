# Delete the Hadoop output directory (if it exists)
hadoop fs -rmr /user/training/OUTPUT

# Process the sample data using the streaming API and the PHP map/reduce scripts.
# Change the /home/training/Desktop/HH path to the place you store your scripts.
# You also might need to change the hadoop-streaming library from CDH4.2 to
# whatever version of Hadoop you're using.

hadoop jar /usr/lib/hadoop-0.20-mapreduce/contrib/streaming/hadoop-streaming-2.0.0-mr1-cdh4.2.1.jar \
-input appfirewall.log \
-output OUTPUT \
-mapper map.php \
-reducer reduce.php \
-file /home/training/Desktop/HH/map.php \
-file /home/training/Desktop/HH/reduce.php


