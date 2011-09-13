# run ZAP
cd resources/ZAP_1.3.2/
sh zap.sh&

# set ZAP as proxy
export http_proxy=http://localhost:8080

# run selenium server
cd ../
java -jar selenium-server-standalone-2.5.0.jar
