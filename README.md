
# Promotional Products REST API  
  
This is a simple API for getting product List By Promotion!  
  
# Configuration  

Create a database and set access parameters in **.env** file  
>DB_HOST= **add mysql host name here**  

>DB_PORT=**add mysql port name here** 

>DB_DATABASE= **add mysql database name here** 

>DB_USERNAME=**add mysql database user here** 

>DB_PASSWORD=**add mysql database password here**   

# Run  
 
 For runing,  you need to run this command
>sh start.sh 
  
  This command run some artisan command to prepare product and also lunch webserver in this host:
  >localhost:8000
  
# Test  
For Testing 
> sh test.sh
  
 # Get Result 
 >http://localhost:8000/products
 
 >http://localhost:8000/products?category=boots
 
 >http://localhost:8000/products?priceLessThan=71000
 
 >http://localhost:8000/products?priceLessThan=71000&category=boots

