# NASA APOD

> One of the most popular websites at NASA is the Astronomy Picture of the Day. 
In fact, this website is one of the most popular websites across all federal agencies. It has the popular appeal of a Justin Bieber video. 
This endpoint structures the APOD imagery and associated metadata so that it can be repurposed for other applications. 
In addition, if the concept_tags parameter is set to True, then keywords derived from the image explanation are returned. 
These keywords could be used as auto-generated hashtags for twitter or instagram feeds; but generally help with discoverability of relevant imagery.

Well this repo is only for test doctrine odm with laminas/mezzio, The infrastructure is in docker simulating a pod, it only contains PHP-FPM-7.3 and NGINX Alphine 
because the microservice runs as the only one. Through a proxy it is possible to test it locally or by adding more containers to the yml file.