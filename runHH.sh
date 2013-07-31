
# Remove the old HipHop repository and Hadoop OUTPUT folder
rm -rf REPO
hadoop fs -rmr /user/training/OUTPUT

# Compile the PHP programs into byte code.
# HipHop places the bytecode into a single archive
# file which just happens to be an SQlite 3.x database.
# HipHop creates a directory named "REPO" and puts the
# archive file in there.
hhvm --hphp -thhbc -l0 -k1 -o REPO map.php reduce.php

# Process the sample data using the streaming API and the PHP map/reduce scripts.
# Change the /home/training/Desktop/HH path to the place where you store your scripts.
# You also might need to change the hadoop-streaming library from CDH4.2 to
# whatever version of Hadoop you're using.

hadoop jar /usr/lib/hadoop-0.20-mapreduce/contrib/streaming/hadoop-streaming-2.0.0-mr1-cdh4.2.1.jar \
 -input appfirewall.log \
 -output OUTPUT \
 -mapper 'hhvm -v Repo.Authoritative=true -v Repo.Central.Path=hhvm.hhbc map.php' \
 -reducer 'hhvm -v Repo.Authoritative=true -v Repo.Central.Path=hhvm.hhbc reduce.php' \
 -file /home/training/Desktop/HH/map.php \
 -file /home/training/Desktop/HH/reduce.php \
 -file /home/training/Desktop/HH/REPO/hhvm.hhbc 

