### Thoughts:

There are some crucial points to consider in this task. firstly because Excel files can be large importing from these can lead to two problems.
1. it can take so long that it must be run in a queue and we need to configure a special queue so that It allows running longer than usual queues and doesn't block other queues.
2. there can be some memory limit problems due to high-row numbers so we need to batch the rows and process them in groups.

using queues brings up another problem: notifying users of their file problems. because it runs in a queue we can not simply put that in response.
so I implemented an event-broadcasting system so that the front end could connect to the WebSocket, listen for these events, and show proper error messages.
Because this wasn't a real project I did not configure WebSocket otherwise I would install Laravel Reverb to handle websockets.

If this was a real project it probably had some authorization with Laravel passport and some authority check with token abilities or permissions. 
Ideally, this would have a remote storage system like minio running on docker where the user first uploads the excel there so this does not take resources on the main service and just sends a storage service link in the import service.
with the implementation of WebSockets and broadcasting, we can even use some progress bar to the user so he/she can know how much time is remaining.

without websocket we can implement a job checking service with job uuid where the front end stores the job uuid and asks about the progress every 10 seconds for example. 

### Installation guide

#### Docker
```shell
git clone https://github.com/Amirmtsh/employee-import.git
```
```shell
cd employee-import
```
```shell
cp .env.example .env
```
```shell
docker network create app
```
```shell
docker compose up -d
```

### Direct
```shell
git clone https://github.com/Amirmtsh/employee-import.git
```
```shell
cd employee-import
```
```shell
cp .env.example .env
```
Remember to install MySQL and Redis and put the configuration in .env file

```shell
composer install
```
```shell
php artisan key:generate
```
```shell
php artisan migrate
```
```shell
php artisan serve
```

And in another terminal run this for the queue 
```shell
php artisan horizon
```

The app should be run at [127.0.0.1:8000](http://127.0.0.1:8000).
You can check the APIs on Postman. You can find the file in root of the project.

PHPMyAdmin is available if you use docker at [127.0.0.1:5050](http://127.0.0.1:5050).
- Username: root
- Password: password

You can check Queues and Requests from [127.0.0.1:8000/telescope](http://127.0.0.1:8000/telescope)

