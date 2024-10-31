<br/>
<h1 align="center">BREVITY</h2>
<br/> 
A lightweight open-source twitter clone!

# Core Project Roadmap:

* [x] Prototypes
* [x] Main Page
* [x] User Login\Registration
* [x] Posting Tweets
* [x] Editing\Removing Tweets
* [x] Tweet Feed
* [x] User Profile Page
* [x] User Profile Page Edit
* [x] User Avatar Upload
* [x] Build and Run Guide

### Extra Features TO-DO

* [ ] Handling Hash Tags
* [ ] Proper Emoji Menu
* [ ] Embed Media to Tweets
* [ ] Like Tweets

# Installation Guide

### Prerequisites

-   **Docker**
-   _(Optional)_ NPM + Webpack (for the development server)

### Installation Steps

1.  **Create a Project Directory**  
    Start by creating a directory for the application files:
    ```bash 
    mkdir YOUR_PATH/brevityapp
    cd YOUR_PATH/brevityapp
    ``` 
    
2.  **Pull the Docker LAMP Image**  
    Pull the mattrayner's [Docker LAMP](https://github.com/mattrayner/docker-lamp) image with PHP 8:
    ```bash
    docker pull mattrayner/lamp:latest-2004-php8
    ``` 
 
3.  **Clone the Brevity Repository**  
    Clone the repository into your project folder:
    ```bash
    git clone https://github.com/dustedge/brevity.git
    ``` 
    
4.  **Run the Docker Image in Detached Mode**  
    Launch the Docker container in the background:
    ```bash
    docker run -p "80:80" -v ${PWD}/brevity:/app mattrayner/lamp:latest-2004-php8 --detach
    ```
> [!WARNING]
> Wait for the container to start before proceeding
    
5.  **Locate the Container ID**  
    Use the following command to obtain your container ID:
    ```bash 
    docker ps
    ``` 
    
    Your container ID will appear in the `CONTAINER ID` column, similar to:
    ```
         \/
    CONTAINER ID   IMAGE...                           
    4101a29f688a   mattr...
    ``` 
    
6.  **Run the MySQL Commands**  
    Connect to MySQL inside the Docker container to execute the setup commands:
    ```bash 
    docker exec -it {YOUR_CONTAINER_ID} mysql
    ``` 
    Then, run the MySQL commands:
    ```sql 
    mysql> source /app/src/mysql_commands.sql;
    ```  
    Exit MySQL:
    ```sql
    mysql> exit
    ``` 
    

### Accessing the Application

The basic installation is now complete, and by default Brevity is accessible via:

-   `http://localhost/`
-   `http://127.0.0.1/`

> [!NOTE] 
> The Docker image for Brevity includes phpMyAdmin, accessible at `http://YOUR_CONTAINER_IP/phpmyadmin`.

> [!WARNING] 
> Database credentials for the application are located in `/src/db.php`.

### (Optional) Enable reCAPTCHA

> [!NOTE] 
> If no reCAPTCHA key is provided, CAPTCHA check will be ignored by default.

To enable reCAPTCHA:

1.  **Add the Public reCAPTCHA Key**  
    Open `/src/views/register.php` and replace the following: 
    `data-sitekey="6LeQ42wqAAAAAA6wPEaeCQT0U0-i3VDVc22ToQbG"` 
    with:
    `data-sitekey="YOUR_PUBLIC_RECAPTCHA_KEY"` 
    
2.  **Add the Secret reCAPTCHA Key**  
    Create a new file at `/src/recaptcha.key` and insert your secret key.

